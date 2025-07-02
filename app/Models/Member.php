<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        //
    ];

    // Jika menggunakan guard khusus
    protected $guard = 'member';
    // Di Model Member.php
    public function pesan()
    {
        return $this->hasMany(Pesan::class, 'member_id');
    }
}
