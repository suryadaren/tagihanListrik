<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\kolektor;
use App\admin;
use App\anggota_kolektor;
use App\notifikasi;

class homeController extends Controller
{
    public function index(){
    	return view('login');
    }
    public function checkLogin(Request $request){
        if(auth()->guard('kolektor')->attempt(array('email' => $request->email, 'password' => $request->password))){
            if (auth()->guard('kolektor')->user()->status == "aktif") {
                $notif = [
                    "message" => "Selamat datang ".auth()->guard('kolektor')->user()->nama,
                    "alert-type" => "success"
                ];
                return redirect(url('kolektor'))->with($notif);
            }else{
                auth()->guard('kolektor')->logout();
                return view('newUser');
            }
        }if(auth()->guard('admin')->attempt(array('email' => $request->email, 'password' => $request->password))){
            $notif = [
                "message" => "Selamat datang ".auth()->guard('admin')->user()->nama,
                "alert-type" => "success"
            ];
            return redirect(url('admin'))->with($notif);
        }if(auth()->guard('anggota_kolektor')->attempt(array('email' => $request->email, 'password' => $request->password))){
            $notif = [
                "message" => "Selamat datang ".auth()->guard('anggota_kolektor')->user()->nama,
                "alert-type" => "success"
            ];
            return redirect(url('/anggota'))->with($notif);
        }else{
            $notif = [
                "message" => "Email/Password yang anda masukan salah",
                "alert-type" => "error"
            ];
            return back()->with($notif);
        }
    }
    public function register(){
    	return view('register');
    }
    public function inputRegister(Request $request){
    	 $validator = Validator::make($request->all(),[
    		'email' => 'required',
    		'password' => 'required',
    		'nama' => 'required',
    		'telepon' => 'required',
    		'region' => 'required',
    		'nomor_ktp' => 'required',
    		'foto' => 'required',
    		'foto_ktp' => 'required',
    	],
    	[
    		'email.required' => 'email tidak boleh kosong',
    		'password.required' => 'password tidak boleh kosong',
    		'nama.required' => 'nama tidak boleh kosong',
    		'telepon.required' => 'telepon tidak boleh kosong',
    		'region.required' => 'region tidak boleh kosong',
    		'nomor_ktp.required' => 'nomor ktp tidak boleh kosong',
    		'foto.required' => 'foto tidak boleh kosong',
    		'foto_ktp.required' => 'foto ktp tidak boleh kosong'
    	]);
    	 if ($validator->fails()) {
    	 	return back()
    	 		->withErrors($validator)
    	 		->withInput();
    	 }else{
    	 	$pathFoto = $request->foto->store('public/data/foto');
    	 	$pathFotoKtp = $request->foto_ktp->store('public/data/fotoKtp');
    	 	$data = [
	    		'email' => $request->email,
	    		'password' => bcrypt($request->password),
	    		'nama' => $request->nama,
	    		'telepon' => $request->telepon,
	    		'region' => $request->region,
	    		'nomor_ktp' => $request->nomor_ktp,
                'status' => 'register',
	    		'foto' => $pathFoto,
	    		'foto_ktp' => $pathFotoKtp,
    	 	];
            $kolektor = kolektor::create($data);

            $data_notif = [
                "pengirim" => $kolektor->id,
                "penerima" => "admin",
                "kategori" => "kolektor baru",
                "id_kategori" => $kolektor->id, 
                "deskripsi" => "pendaftaran akun kolektor", 
                "status" => "belum dibaca" 
            ];
            notifikasi::create($data_notif);
            $notif = [
                "message" => "Selamat. anda berhasil mendaftar",
                "alert-type" => "success"
            ];
            return back()->with($notif);
    	 }
    }
}
