<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class kolektor extends Authenticatable
{
    use Notifiable;

    protected $table = 'kolektor';

    protected $fillable = [
        'nama', 'email', 'password', 'foto', 'telepon', 'nomor_ktp', 'foto_ktp', 'region', 'status', 'remember_token', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
