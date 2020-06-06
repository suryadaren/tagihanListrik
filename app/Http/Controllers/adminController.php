<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notifikasi;
use App\kolektor;
use App\tagihan_kolektor;
use App\pembayaran_kolektor;
use Carbon\Carbon;
use PDF;

class adminController extends Controller
{

    public function notifikasi(){

        // ngambil data notifikasi dan di simpan di variable notifikasis
        $notifikasis = notifikasi::where('penerima','admin')->orderBy('created_at','desc')->get();

        // pergi ke view
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
        return redirect(url('admin/tagihan'))->with($notif);
    }
    
    public function pembayaran(){
        $tagihans = tagihan_kolektor::get();
        $total_tagihan = 0;
        $total_dibayar = 0;
        $sisa = 0;
        foreach ($tagihans as $tagihan) {
            $jumlah_tagihan = str_replace(".", "", $tagihan->jumlah_tagihan);
            $jumlah_dibayar = str_replace(".", "", $tagihan->jumlah_dibayar);

            $total_tagihan += $jumlah_tagihan;
            $total_dibayar += $jumlah_dibayar;
        }
        $sisa = $total_tagihan-$total_dibayar;
        $total_tagihan = $this->convert_to_rupiah($total_tagihan);
        $total_dibayar = $this->convert_to_rupiah($total_dibayar);
        $sisa = $this->convert_to_rupiah($sisa);

        $pembayarans = pembayaran_kolektor::orderby('created_at','desc')->get();

    	return view('admin.pembayaran',compact('pembayarans','total_tagihan','total_dibayar','sisa'));
    }
    
    public function setujui_pembayaran(Request $request){
        $pembayaran = pembayaran_kolektor::find($request->id);
        $pembayaran->status_pembayaran = "verifikasi";
        $pembayaran->save();

        $tagihan = tagihan_kolektor::where('kolektor_id',$pembayaran->kolektor_id)->first();

        $jumlah_dibayar = str_replace(".", "", $pembayaran->jumlah_pembayaran);
        $jumlah_sebelum = str_replace(".", "", $tagihan->jumlah_dibayar);

        $jumlah_pembayaran_terbaru = $jumlah_dibayar+$jumlah_sebelum;
        $jumlah_pembayaran_terbaru = $this->convert_to_rupiah($jumlah_pembayaran_terbaru);

        $tagihan->jumlah_dibayar = $jumlah_pembayaran_terbaru;
        $tagihan->save();

        $data_notif = [
                "pengirim" => "admin",
                "penerima" => $pembayaran->kolektor_id,
                "kategori" => "verifikasi pembayaran",
                "id_kategori" => $pembayaran->id, 
                "deskripsi" => "pembayaran anda telah diverifikasi", 
                "status" => "belum dibaca" 
            ];
        notifikasi::create($data_notif);


        $notif = [
            "message" => "Berhasil memverifikasi pembayaran kolektor",
            "alert-type" => "success",
        ];
        return back()->with($notif);
        
    }
    
    public function laporan(){
    	return view('admin.laporan');
    }
    
    public function download_laporan(){
        $now = Carbon::now();
        $pembayarans = pembayaran_kolektor::where('status_pembayaran','verifikasi')->orderBy('created_at','desc')->get();

        $pdf = PDF::loadview('admin.berkas_laporan', ['pembayarans' => $pembayarans]);
        return $pdf->download('Laporan Pembayaran '.$now);
    }

    function convert_to_rupiah($angka){
        $hasil_rupiah = number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
    
    public function logout(){
        auth()->guard('admin')->logout();
        return redirect(url('/'));
    }
}
