<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class pembayaran_kolektor extends Authenticatable
{
    use Notifiable;

    protected $table = 'pembayaran_kolektor';

    protected $fillable = [
        'kolektor_id', 'jumlah_pembayaran', 'bukti_pembayaran', 'status_pembayaran', 'created_at', 'updated_at'
    ];
}
