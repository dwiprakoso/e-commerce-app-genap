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
});
Route::prefix('gallery')->group(function () {
    Route::get('/', [GalleryController::class, 'index'])->name('admin.gallery.index');
});
Route::prefix('video')->group(function () {
    Route::get('/', [VideoController::class, 'index'])->name('admin.video.index');
});
Route::prefix('berita')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('admin.berita.index');
});
Route::prefix('pemesanan')->group(function () {
    Route::get('/', [PemesananController::class, 'index'])->name('admin.pemesanan.index');
});
Route::prefix('member')->group(function () {
    Route::get('/', [MemberController::class, 'index'])->name('admin.member.index');
});
