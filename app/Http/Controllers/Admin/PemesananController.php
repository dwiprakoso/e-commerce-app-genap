<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pesan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pesan::with(['member', 'paketwisata'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.page.pemesanan.index', compact('pemesanans'));
    }

    public function edit($id)
    {
        $pemesanan = Pesan::with(['member', 'paketwisata'])->findOrFail($id);
        return view('admin.page.pemesanan.edit', compact('pemesanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,dibayar,diverifikasi,selesai,dibatalkan'
        ]);

        $pemesanan = Pesan::findOrFail($id);
        $pemesanan->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.pemesanan.index')
            ->with('success', 'Status pemesanan berhasil diperbarui.');
    }
}
