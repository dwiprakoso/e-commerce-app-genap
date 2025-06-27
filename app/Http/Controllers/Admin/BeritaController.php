<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->get();
        return view('admin.page.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.page.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('berita', 'public');
            $data['image_url'] = $imagePath;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.page.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($berita->image_url && Storage::disk('public')->exists($berita->image_url)) {
                Storage::disk('public')->delete($berita->image_url);
            }

            $imagePath = $request->file('image')->store('berita', 'public');
            $data['image_url'] = $imagePath;
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Delete image if exists
        if ($berita->image_url && Storage::disk('public')->exists($berita->image_url)) {
            Storage::disk('public')->delete($berita->image_url);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}
