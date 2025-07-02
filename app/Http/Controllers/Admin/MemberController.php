<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pesan;
use App\Models\Member;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('admin.page.member.index', compact('members'));
    }

    public function destroy($id)
    {
        try {
            $member = Member::findOrFail($id);

            // Cek apakah member memiliki data di tabel pesan
            if ($member->pesan()->exists()) {
                return redirect()->route('admin.member.index')
                    ->with('error', 'Member tidak dapat dihapus karena masih memiliki data pemesanan!');
            }

            $member->delete();

            return redirect()->route('admin.member.index')
                ->with('success', 'Member berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.member.index')
                ->with('error', 'Gagal menghapus member!');
        }
    }
    // Tambahkan method ini di MemberController

    public function formPesan($id)
    {
        $paket = PaketWisata::findOrFail($id);

        // Pastikan paket wisata berstatus publish
        if ($paket->status !== 'publish') {
            return redirect()->route('member.paket-wisata.index')
                ->with('error', 'Paket wisata tidak tersedia untuk dipesan.');
        }

        return view('member.page.paket-wisata.pesan', compact('paket'));
    }

    public function storePesan(Request $request, $id)
    {
        $paket = PaketWisata::findOrFail($id);

        // Validasi input
        $request->validate([
            'jumlah_orang' => 'required|integer|min:1|max:50',
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'jumlah_orang.required' => 'Jumlah orang harus diisi.',
            'jumlah_orang.integer' => 'Jumlah orang harus berupa angka.',
            'jumlah_orang.min' => 'Jumlah orang minimal 1 orang.',
            'jumlah_orang.max' => 'Jumlah orang maksimal 50 orang.',
            'bukti_bayar.required' => 'Bukti bayar harus diupload.',
            'bukti_bayar.image' => 'File bukti bayar harus berupa gambar.',
            'bukti_bayar.mimes' => 'Format file bukti bayar harus jpeg, png, atau jpg.',
            'bukti_bayar.max' => 'Ukuran file bukti bayar maksimal 2MB.',
        ]);

        // Hitung total harga
        $totalHarga = $paket->price * $request->jumlah_orang;

        // Upload bukti bayar ke storage
        $buktiPayarName = null;
        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            // Simpan ke folder storage/app/public/bukti_bayar
            $buktiPayarName = $file->store('bukti_bayar', 'public'); // 'public' adalah disk storage yang diatur di config/filesystems.php
        }

        // Simpan data pesanan
        $pesan = new Pesan();
        $pesan->member_id = auth()->id();
        $pesan->paketwisata_id = $paket->id;
        $pesan->jumlah_orang = $request->jumlah_orang;
        $pesan->total_harga = $totalHarga;
        $pesan->status = 'pending';
        $pesan->bukti_bayar = $buktiPayarName;
        $pesan->save();

        return redirect()->route('member.pesanan')
            ->with('success', 'Pesanan berhasil dibuat! Pesanan Anda sedang diproses.');
    }


    public function pesananSaya()
    {
        $pesanan = Pesan::with('paketWisata')
            ->where('member_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('member.page.pesanan.index', compact('pesanan'));
    }
}
