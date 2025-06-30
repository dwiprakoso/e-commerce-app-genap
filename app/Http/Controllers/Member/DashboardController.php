<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\PaketWisata;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $paketWisata = PaketWisata::where('status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        $berita = Berita::orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('member.page.home', compact('paketWisata', 'berita'));
    }

    public function paketWisata(Request $request)
    {
        $query = PaketWisata::query();

        // Filter hanya yang berstatus publish
        $query->where('status', 'publish');

        // Filter berdasarkan tanggal mulai
        if ($request->has('start_date') && $request->start_date != '') {
            $query->where('start_date', '>=', $request->start_date);
        }

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $paketWisata = $query->orderBy('created_at', 'desc')->get();

        return view('member.page.paket-wisata.index', compact('paketWisata'));
    }

    public function detailPaketWisata($id)
    {
        $paket = PaketWisata::findOrFail($id);

        // Ambil paket wisata lain yang serupa (excluding current)
        $paketLainnya = PaketWisata::where('id', '!=', $id)
            ->where('status', 'publish')
            ->take(3)
            ->get();

        return view('member.page.paket-wisata.detail', compact('paket', 'paketLainnya'));
    }

    // Fungsi untuk halaman index berita
    public function berita(Request $request)
    {
        $query = Berita::query();

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $berita = $query->orderBy('created_at', 'desc')->get();

        return view('member.page.berita.index', compact('berita'));
    }

    // Fungsi untuk detail berita
    public function detailBerita($id)
    {
        $berita = Berita::findOrFail($id);

        // Ambil berita lain (excluding current)
        $beritaLainnya = Berita::where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('member.page.berita.detail', compact('berita', 'beritaLainnya'));
    }
}
