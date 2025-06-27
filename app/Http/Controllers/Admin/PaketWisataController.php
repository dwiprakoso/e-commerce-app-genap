<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaketWisata;
use Illuminate\Http\Request;

class PaketWisataController extends Controller
{
    public function index()
    {
        $paketwisatas = PaketWisata::all();
        return view('admin.page.paket-wisata.index', compact('paketwisatas'));
    }
}
