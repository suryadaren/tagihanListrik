<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notifikasi;
use App\kolektor;
use App\tagihan_kolektor;
use Carbon\Carbon;

class adminController extends Controller
{

    public function notifikasi(){
        $notifikasis = notifikasi::where('penerima','admin')->orderBy('created_at','desc')->get();
        return view('admin.notifikasi',compact('notifikasis'));
    }

    public function lihat_notifikasi($kategori,$id){
        if ($kategori == "kolektor baru") {
            notifikasi::find($id)->update([
                "status" => "sudah dibaca"
            ]);
            return redirect(url('admin/kolektor'));
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

    public function kolektor(){
        $kolektors = kolektor::orderBy('created_at','desc')->get();
    	return view('admin.kolektor',compact('kolektors'));
    }

    public function setujui(Request $request){
        kolektor::find($request->id)->update([
            "status" => "aktif"
        ]);

        $tenggat = Carbon::now()->addMonths()->format('Y-m-d');
        $data_tagihan = [
            "kolektor_id" => $request->id,
            "jumlah_tagihan" => "0",
            "jumlah_dibayar" => "0",
            "waktu_tenggat_pembayaran" => $tenggat,
            "status_tagihan" => "new"
        ];
        tagihan_kolektor::create($data_tagihan);
        $notif = [
            "message" => "Berhasil menyetujui akun kolektor",
            "alert-type" => "success",
        ];
        return back()->with($notif);
    }

    public function hapus(Request $request){
        kolektor::find($request->id)->delete();
        $notif = [
            "message" => "Berhasil menghapus akun kolektor",
            "alert-type" => "success",
        ];
        return back()->with($notif);
    }

    public function tagihan(){
        $tagihan_kolektors = tagihan_kolektor::orderBy('updated_at','desc')->get();
    	return view('admin.tagihan',compact('tagihan_kolektors'));
    }

    public function edit($id){
        $tagihan = tagihan_kolektor::find($id);
        return view('admin.edit',compact('tagihan'));
    }

    public function update_tagihan(Request $request, $id){
        $status = "lunas";

        $tagihan = str_replace(".", "", $request->jumlah_tagihan);
        $bayar = str_replace(".", "", $request->jumlah_dibayar);
        if ($tagihan > $bayar) {
            $status = "belum lunas";
        }else{
            $status = "lunas";
        }
        tagihan_kolektor::where('id',$id)->update([
            "jumlah_tagihan" => $request->jumlah_tagihan,
            "jumlah_dibayar" => $request->jumlah_dibayar,
            "waktu_tenggat_pembayaran" => $request->waktu_tenggat_pembayaran,
            "status_tagihan" => $status
        ]);
        
        $tagihan = tagihan_kolektor::find($id);
        $data_notif = [
                "pengirim" => "admin",
                "penerima" => $tagihan->kolektor_id,
                "kategori" => "update tagihan",
                "id_kategori" => $id, 
                "deskripsi" => "tagihan telah diperbarui", 
                "status" => "belum dibaca" 
            ];
        notifikasi::create($data_notif);

        $notif = [
            "message" => "Berhasil mengupdate tagihan kolektor",
            "alert-type" => "success",
        ];
        return redirect(url('admin/tagihan'));
    }
    
    public function pembayaran(){
    	return view('admin.pembayaran');
    }
    
    public function laporan(){
    	return view('admin.laporan');
    }
}
