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
        Schema::create('paketwisata', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul paket wisata
            $table->text('description'); // Deskripsi lengkap
            $table->decimal('price', 12, 2); // Harga paket
            $table->date('start_date')->nullable(); // Tanggal mulai
            $table->date('end_date')->nullable(); // Tanggal selesai
            $table->enum('status', ['draft', 'publish'])->default('draft'); // Status tayang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paketwisata');
    }
};
