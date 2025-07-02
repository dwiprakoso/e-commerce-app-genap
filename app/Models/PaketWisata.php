<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaketWisata extends Model
{
    use HasFactory;

    protected $table = 'paketwisata';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'price',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    // Di Model PaketWisata.php
    public function pesan()
    {
        return $this->hasMany(Pesan::class, 'paketwisata_id');
    }
}
