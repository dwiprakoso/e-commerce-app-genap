<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('member.auth.login');
    }

    public function showRegisterForm()
    {
        return view('member.auth.register');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('member')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('member.home'));
        }

        return redirect()->back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput();
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $member = Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('member')->login($member);

        return redirect()->route('member.home')->with('success', 'Registrasi berhasil!');
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('member.home');
    }

    // Social Login Methods
    public function redirectToProvider($provider)
    {
        try {
            // Validasi provider yang didukung
            if (!in_array($provider, ['google', 'facebook', 'github'])) {
                throw new Exception('Provider tidak didukung: ' . $provider);
            }

            // Set scope khusus untuk setiap provider
            if ($provider === 'facebook') {
                return Socialite::driver($provider)
                    ->scopes(['public_profile']) // Hanya public_profile untuk Facebook
                    ->redirect();
            }

            if ($provider === 'google') {
                return Socialite::driver($provider)
                    ->scopes(['profile', 'email']) // Google masih bisa pakai email
                    ->redirect();
            }

            // Default untuk provider lain
            return Socialite::driver($provider)->redirect();
        } catch (Exception $e) {
            Log::error('Social Login Redirect Error: ' . $e->getMessage(), [
                'provider' => $provider,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('member.login')
                ->withErrors(['social' => 'Terjadi kesalahan saat menghubungkan ke ' . ucfirst($provider) . ': ' . $e->getMessage()]);
        }
    }

    public function handleProviderCallback($provider)
    {
        try {
            // Validasi provider yang didukung
            if (!in_array($provider, ['google', 'facebook', 'github'])) {
                throw new Exception('Provider tidak didukung: ' . $provider);
            }

            // Ambil data user dari provider
            $socialUser = Socialite::driver($provider)->user();

            // Log untuk debugging
            Log::info('Social Login Callback', [
                'provider' => $provider,
                'social_user_id' => $socialUser->getId(),
                'social_user_email' => $socialUser->getEmail(),
                'social_user_name' => $socialUser->getName()
            ]);

            // Cari user berdasarkan provider + provider_id
            $existingMember = Member::where('provider', $provider)
                ->where('provider_id', $socialUser->getId())
                ->first();

            if ($existingMember) {
                // Login existing user
                Auth::guard('member')->login($existingMember);
                return redirect()->intended(route('member.home'))
                    ->with('success', 'Berhasil login dengan ' . ucfirst($provider) . '!');
            }

            // Jika belum ada, cek berdasarkan email (jika email tersedia)
            $email = $socialUser->getEmail();
            if ($email) {
                $existingMember = Member::where('email', $email)->first();

                if ($existingMember) {
                    // Link social account ke existing user (jika belum punya provider)
                    if (!$existingMember->provider) {
                        $existingMember->update([
                            'provider' => $provider,
                            'provider_id' => $socialUser->getId(),
                        ]);
                    }

                    Auth::guard('member')->login($existingMember);
                    return redirect()->intended(route('member.home'))
                        ->with('success', 'Berhasil login dengan ' . ucfirst($provider) . '!');
                }
            }

            // Buat user baru
            $member = Member::create([
                'name' => $socialUser->getName() ?: $socialUser->getNickname() ?: 'User',
                'email' => $email, // Bisa null untuk Facebook, ada value untuk Google
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);

            Auth::guard('member')->login($member);
            return redirect()->intended(route('member.home'))
                ->with('success', 'Berhasil registrasi dan login dengan ' . ucfirst($provider) . '!');
        } catch (Exception $e) {
            // Log error detail untuk debugging
            Log::error('Social Login Callback Error: ' . $e->getMessage(), [
                'provider' => $provider,
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('member.login')
                ->withErrors(['social' => 'Terjadi kesalahan saat login dengan ' . ucfirst($provider) . '. Silakan coba lagi.']);
        }
    }
}
