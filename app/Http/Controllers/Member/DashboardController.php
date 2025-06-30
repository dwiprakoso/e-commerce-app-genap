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

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

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
}
