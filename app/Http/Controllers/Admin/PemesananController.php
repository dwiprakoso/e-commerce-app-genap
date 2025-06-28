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
}
