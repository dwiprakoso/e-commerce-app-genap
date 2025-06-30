<?php

use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PaketWisataController;
use App\Http\Controllers\Admin\PemesananController;
use App\Http\Controllers\Admin\VideoController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [DashboardController::class, 'index'])->name('admin.index');

Route::prefix('paket-wisata')->group(function () {
    Route::get('/', [PaketWisataController::class, 'index'])->name('admin.paket-wisata.index');
    Route::get('/create', [PaketWisataController::class, 'create'])->name('admin.paket-wisata.create');
    Route::post('/store', [PaketWisataController::class, 'store'])->name('admin.paket-wisata.store');
    Route::get('/edit/{id}', [PaketWisataController::class, 'edit'])->name('admin.paket-wisata.edit');
    Route::put('/update/{id}', [PaketWisataController::class, 'update'])->name('admin.paket-wisata.update');
    Route::delete('/delete/{id}', [PaketWisataController::class, 'destroy'])->name('admin.paket-wisata.destroy');
});
Route::prefix('gallery')->group(function () {
    Route::get('/', [GalleryController::class, 'index'])->name('admin.gallery.index');
    Route::get('/create', [GalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('/store', [GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::get('/edit/{id}', [GalleryController::class, 'edit'])->name('admin.gallery.edit');
    Route::put('/update/{id}', [GalleryController::class, 'update'])->name('admin.gallery.update');
    Route::delete('/delete/{id}', [GalleryController::class, 'destroy'])->name('admin.gallery.destroy');
});
Route::prefix('video')->group(function () {
    Route::get('/', [VideoController::class, 'index'])->name('admin.video.index');
    Route::get('/create', [VideoController::class, 'create'])->name('admin.video.create');
    Route::post('/store', [VideoController::class, 'store'])->name('admin.video.store');
    Route::get('/edit/{id}', [VideoController::class, 'edit'])->name('admin.video.edit');
    Route::put('/update/{id}', [VideoController::class, 'update'])->name('admin.video.update');
    Route::delete('/delete/{id}', [VideoController::class, 'destroy'])->name('admin.video.destroy');
});
Route::prefix('berita')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('admin.berita.index');
    Route::get('/create', [BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('/store', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('/edit/{id}', [BeritaController::class, 'edit'])->name('admin.berita.edit');
    Route::put('/update/{id}', [BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/delete/{id}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');
});
Route::prefix('pemesanan')->group(function () {
    Route::get('/', [PemesananController::class, 'index'])->name('admin.pemesanan.index');
    Route::get('/edit/{id}', [PemesananController::class, 'edit'])->name('admin.pemesanan.edit');
    Route::put('/update/{id}', [PemesananController::class, 'update'])->name('admin.pemesanan.update');
});
Route::prefix('member')->group(function () {
    Route::get('/', [MemberController::class, 'index'])->name('admin.member.index');
});
