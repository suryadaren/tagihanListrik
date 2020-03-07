<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notifikasi;

class kolektorController extends Controller
{
    public function __construct()
    {
        $this->middleware('kolektor');
    }

    public function lihat_notifikasi($kategori,$id){
        if ($kategori == "update tagihan") {
            notifikasi::find($id)->update([
                "status" => "sudah dibaca"
            ]);
            return redirect(url('kolektor/pembayaran_kepada_admin'));
        }
    }

    public function hapus_notifikasi(Request $request){
        notifikasi::find($request->id)->delete();
        $notif = [
            "message" => "Berhasil menghapus notifikasi",
            "alert-type" => "success"
        ];
        return back()->with($notif);
    }

    public function notifikasi(){
        $notifikasis = notifikasi::where('penerima',auth()->guard('kolektor')->id())->orderBy('created_at','desc')->get();
        return view('kolektor.notifikasi',compact('notifikasis'));
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
    
    public function logout(){
        auth()->guard('kolektor')->logout();
        return redirect(url('/'));
    }
}
