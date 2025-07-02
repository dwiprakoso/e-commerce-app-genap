<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketWisataController extends Controller
{
    public function index()
    {
        $paketwisatas = PaketWisata::orderBy('created_at', 'desc')->get();
        return view('admin.page.paket-wisata.index', compact('paketwisatas'));
    }

    public function create()
    {
        return view('admin.page.paket-wisata.create');
    }

    public function store(Request $request)
    {
        // Clean price input before validation
        $request->merge([
            'price' => preg_replace('/[^\d]/', '', $request->price)
        ]);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:draft,publish'
        ], [
            'title.required' => 'Judul paket wisata wajib diisi.',
            'title.max' => 'Judul paket wisata maksimal 255 karakter.',
            'description.required' => 'Deskripsi paket wisata wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'price.required' => 'Harga paket wisata wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga minimal 0.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.after_or_equal' => 'Tanggal mulai tidak boleh kurang dari hari ini.',
            'end_date.required' => 'Tanggal berakhir wajib diisi.',
            'end_date.after' => 'Tanggal berakhir harus setelah tanggal mulai.',
            'status.required' => 'Status paket wisata wajib dipilih.',
            'status.in' => 'Status harus draft atau publish.'
        ]);


        try {
            $imageUrl = null;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imageUrl = $image->storeAs('paket-wisata', $imageName, 'public');
            }

            // Create paket wisata
            PaketWisata::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => $imageUrl,
                'price' => $request->price,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status
            ]);

            return redirect()->route('admin.paket-wisata.index')
                ->with('success', 'Paket wisata berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan paket wisata: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $paketwisata = PaketWisata::findOrFail($id);
        return view('admin.page.paket-wisata.edit', compact('paketwisata'));
    }

    public function update(Request $request, $id)
    {
        $paketwisata = PaketWisata::findOrFail($id);

        // Clean price input before validation
        $request->merge([
            'price' => preg_replace('/[^\d]/', '', $request->price)
        ]);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:draft,publish'
        ], [
            'title.required' => 'Judul paket wisata wajib diisi.',
            'title.max' => 'Judul paket wisata maksimal 255 karakter.',
            'description.required' => 'Deskripsi paket wisata wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'price.required' => 'Harga paket wisata wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga minimal 0.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'end_date.required' => 'Tanggal berakhir wajib diisi.',
            'end_date.after' => 'Tanggal berakhir harus setelah tanggal mulai.',
            'status.required' => 'Status paket wisata wajib dipilih.',
            'status.in' => 'Status harus draft atau publish.'
        ]);


        try {
            $imageUrl = $paketwisata->image_url;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($paketwisata->image_url && Storage::disk('public')->exists($paketwisata->image_url)) {
                    Storage::disk('public')->delete($paketwisata->image_url);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imageUrl = $image->storeAs('paket-wisata', $imageName, 'public');
            }

            // Update paket wisata
            $paketwisata->update([
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => $imageUrl,
                'price' => $request->price,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status
            ]);

            return redirect()->route('admin.paket-wisata.index')
                ->with('success', 'Paket wisata berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengupdate paket wisata: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $paketwisata = PaketWisata::findOrFail($id);

            // Validasi: cek apakah paket wisata memiliki data di tabel pesan
            if ($paketwisata->pesan()->exists()) {
                return redirect()->route('admin.paket-wisata.index')
                    ->with('error', 'Paket wisata tidak dapat dihapus karena masih memiliki data pemesanan!');
            }

            // Delete image if exists
            if ($paketwisata->image_url && Storage::disk('public')->exists($paketwisata->image_url)) {
                Storage::disk('public')->delete($paketwisata->image_url);
            }

            // Delete paket wisata
            $paketwisata->delete();

            return redirect()->route('admin.paket-wisata.index')
                ->with('success', 'Paket wisata berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.paket-wisata.index')
                ->with('error', 'Terjadi kesalahan saat menghapus paket wisata: ' . $e->getMessage());
        }
    }
}
