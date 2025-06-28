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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:draft,publish'
        ], [
            'title.required' => 'Judul paket wisata wajib diisi.',
            'title.max' => 'Judul paket wisata maksimal 255 karakter.',
            'description.required' => 'Deskripsi paket wisata wajib diisi.',
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

            // Create paket wisata
            PaketWisata::create([
                'title' => $request->title,
                'description' => $request->description,
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

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:draft,publish'
        ], [
            'title.required' => 'Judul paket wisata wajib diisi.',
            'title.max' => 'Judul paket wisata maksimal 255 karakter.',
            'description.required' => 'Deskripsi paket wisata wajib diisi.',
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

            // Update paket wisata
            $paketwisata->update([
                'title' => $request->title,
                'description' => $request->description,
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
