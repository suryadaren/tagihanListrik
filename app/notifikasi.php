<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class notifikasi extends Authenticatable
{
    use Notifiable;

    protected $table = 'notifikasi';

    protected $fillable = [
        'pengirim', 'penerima', 'kategori', 'id_kategori', 'deskripsi', 'status', 'created_at', 'updated_at', 'level_penerima'
    ];
}
