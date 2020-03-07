<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class pembayaran_anggota_kolektor extends Authenticatable
{
    use Notifiable;

    protected $table = 'pembayaran_anggota_kolektor';

    protected $fillable = [
        'anggota_kolektor_id', 'jumlah_pembayaran', 'bukti_pembayaran', 'status_pembayaran', 'created_at', 'updated_at'
    ];
}
