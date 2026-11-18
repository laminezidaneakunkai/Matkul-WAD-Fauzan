<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AkunRental extends Authenticatable
{
    protected $table = 'akun_rental';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'nik',
        'alamat',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
}