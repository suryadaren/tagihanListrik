<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{

    public function notifikasi(){
        return view('admin.notifikasi');
    }

    public function kolektor(){
    	return view('admin.kolektor');
    }

    public function tagihan(){
    	return view('admin.tagihan');
    }

    public function edit($id){
        return view('admin.edit');
    }
    
    public function pembayaran(){
    	return view('admin.pembayaran');
    }
    
    public function laporan(){
    	return view('admin.laporan');
    }
}
