<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class tagihan_anggota_kolektor extends Authenticatable
{
    use Notifiable;

    protected $table = 'tagihan_anggota_kolektor';

    protected $fillable = [
        'anggota_kolektor_id', 'jumlah_tagihan', 'jumlah_dibayar', 'waktu_tenggat_pembayaran', 'status_tagihan', 'created_at', 'updated_at'
    ];
}
