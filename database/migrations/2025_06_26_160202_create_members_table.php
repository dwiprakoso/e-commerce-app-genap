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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    // Nama lengkap user
            $table->string('email')->nullable();       // Email opsional (untuk Facebook)
            $table->string('password')->nullable();    // Password (di-hash)
            $table->string('provider')->nullable();    // Google / Facebook (opsional)
            $table->string('provider_id')->nullable(); // ID dari provider (opsional)
            $table->timestamps();

            // Index untuk performa
            $table->index(['provider', 'provider_id']);
            $table->unique(['email'], 'members_email_unique')->nullable(); // Email tetap unique tapi bisa null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
