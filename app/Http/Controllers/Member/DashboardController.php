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
        $paketWisata = PaketWisata::all();
        $berita = Berita::all();
        return view('member.page.home', compact('paketWisata', 'berita'));
    }

    public function dashboard()
    {
        return view('member.page.dashboard');
    }
}
