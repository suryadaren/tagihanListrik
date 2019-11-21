<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kolektorController extends Controller
{

    public function notifikasi(){
        return view('kolektor.notifikasi');
    }

    public function anggota(){
    	return view('kolektor.anggota');
    }

    public function tambah_anggota(){
        return view('kolektor.tambah_anggota');
    }

    public function edit_anggota($id){
        return view('kolektor.edit_anggota');
    }

    public function tagihan_anggota(){
    	return view('kolektor.tagihan_anggota');
    }

    public function edit_tagihan($id){
        return view('kolektor.edit_tagihan');
    }
    
    public function pembayaran_anggota(){
    	return view('kolektor.pembayaran_anggota');
    }
    
    public function pembayaran_kepada_admin(){
        return view('kolektor.pembayaran_kepada_admin');
    }
    
    public function laporan(){
    	return view('kolektor.laporan');
    }
}
