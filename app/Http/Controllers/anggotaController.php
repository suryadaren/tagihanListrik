<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\notifikasi;
use App\tagihan_anggota_kolektor;
use App\pembayaran_anggota_kolektor;

class anggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('anggota_kolektor');
    }

    public function notifikasi(){
    	$notifikasis = notifikasi::where('penerima',auth()->guard('anggota_kolektor')->id())->get();
        return view('anggota.notifikasi', compact('notifikasis'));
    }

    public function pembayaran(){
        
        $tagihan = tagihan_anggota_kolektor::where('anggota_kolektor_id',auth()->guard('anggota_kolektor')->id())->first();
        $jumlah_tagihan = str_replace(".", "", $tagihan->jumlah_tagihan);
        $jumlah_dibayar = str_replace(".", "", $tagihan->jumlah_dibayar);
        $sisa_tagihan = $jumlah_tagihan-$jumlah_dibayar;
        $sisa_tagihan = $this->convert_to_rupiah($sisa_tagihan);

        $pembayarans = pembayaran_anggota_kolektor::where('anggota_kolektor_id',auth()->guard('anggota_kolektor')->id())->get();
        return view('anggota.pembayaran',compact('sisa_tagihan','tagihan','pembayarans'));
    }
    
    public function lakukan_pembayaran(){
        return view('anggota.lakukan_pembayaran');
    }
    
    public function simpan_pembayaran(Request $request){
        $validator = Validator::make($request->all(),[
            'jumlah_pembayaran' => 'required',
            'bukti_pembayaran' => 'required'
        ],
        [
            'jumlah_pembayaran.required' => 'jumlah pembayaran tidak boleh kosong',
            'bukti_pembayaran.required' => 'bukti pembayaran tidak boleh kosong'
        ]);
         if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
         }else{
            $buktiPembayaranPath = $request->bukti_pembayaran->store('public/data/buktiPembayaranAnggota');
            $data = [
                "anggota_kolektor_id" => auth()->guard('anggota_kolektor')->id(),
                "jumlah_pembayaran" => $request->jumlah_pembayaran,
                "bukti_pembayaran" => $buktiPembayaranPath,
                "status_pembayaran" => "menunggu verifikasi"
            ];
            $pembayaran = pembayaran_anggota_kolektor::create($data);

            $data_notif = [
                "pengirim" => auth()->guard('anggota_kolektor')->id(),
                "penerima" => auth()->guard('anggota_kolektor')->user()->kolektor_id,
                "kategori" => "pembayaran tagihan",
                "id_kategori" => $pembayaran->id, 
                "deskripsi" => auth()->guard('anggota_kolektor')->user()->name." telah melakukan pembayaran tagihan", 
                "status" => "belum dibaca" 
            ];
            notifikasi::create($data_notif);

            $notif = [
                "message" => "Berhasil melakukan pembayaran, silahkan menunggu verifikasi admin",
                "alert-type" => "success"
            ];
            return redirect(url('/anggota/pembayaran'))->with($notif);
         }
    }

    public function logout(){
        auth()->guard('anggota_kolektor')->logout();
        return redirect(url('/'));
    }
    function convert_to_rupiah($angka){
        $hasil_rupiah = number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
}
