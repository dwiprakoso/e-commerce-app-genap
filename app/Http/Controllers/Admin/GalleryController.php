<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.page.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.page.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'required|string|max:255',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery', 'public');
        }

        Gallery::create([
            'image_url' => $imagePath,
            'caption' => $request->caption,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.page.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'required|string|max:255',
        ]);

        $imagePath = $gallery->image_url;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($gallery->image_url && Storage::disk('public')->exists($gallery->image_url)) {
                Storage::disk('public')->delete($gallery->image_url);
            }

            $imagePath = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update([
            'image_url' => $imagePath,
            'caption' => $request->caption,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil diupdate!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Hapus file gambar jika ada
        if ($gallery->image_url && Storage::disk('public')->exists($gallery->image_url)) {
            Storage::disk('public')->delete($gallery->image_url);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil dihapus!');
    }
}
