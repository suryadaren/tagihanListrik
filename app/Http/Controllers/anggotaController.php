<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class anggotaController extends Controller
{

    public function notifikasi(){
        return view('anggota.notifikasi');
    }

    public function pembayaran(){
        return view('anggota.pembayaran');
    }

}
