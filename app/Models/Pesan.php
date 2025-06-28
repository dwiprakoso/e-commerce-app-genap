<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesan extends Model
{
    protected $table = 'pesan';

    protected $fillable = [
        'member_id',
        'paketwisata_id',
        'jumlah_orang',
        'total_harga',
        'status',
        'bukti_bayar',
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
        'jumlah_orang' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke Member (Many to One)
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    // Relasi ke PaketWisata (Many to One)
    public function paketwisata(): BelongsTo
    {
        return $this->belongsTo(PaketWisata::class, 'paketwisata_id');
    }
    // Accessor untuk format rupiah
    public function getTotalHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }
}
