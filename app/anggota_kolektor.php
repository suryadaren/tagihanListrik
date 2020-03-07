<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class anggota_kolektor extends Authenticatable
{
    use Notifiable;

    protected $table = 'anggota_kolektor';

    protected $fillable = [
        'kolektor_id', 'nama', 'email', 'password', 'foto', 'telepon', 'nomor_ktp', 'foto_ktp', 'region', 'remember_token', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
