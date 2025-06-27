<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $fillable = [
        'image_url',
        'caption',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Accessor untuk mendapatkan URL gambar lengkap
    public function getImageUrlAttribute($value)
    {
        return $value;
    }

    // Accessor untuk mendapatkan URL gambar lengkap dengan storage path
    public function getFullImageUrlAttribute()
    {
        if ($this->image_url) {
            return asset('storage/' . $this->image_url);
        }
        return null;
    }
}
