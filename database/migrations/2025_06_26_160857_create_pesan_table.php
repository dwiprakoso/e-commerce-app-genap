<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');        // ID user yang booking
            $table->unsignedBigInteger('paketwisata_id');   // ID paket wisata
            $table->integer('jumlah_orang')->default(1);    // Jumlah orang (default 1)
            $table->decimal('total_harga', 12, 2);          // Total harga
            $table->enum('status', ['pending', 'dibayar', 'diverifikasi', 'selesai', 'dibatalkan'])->default('pending');
            $table->string('bukti_bayar')->nullable();      // Path file bukti transfer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesans');
    }
};
