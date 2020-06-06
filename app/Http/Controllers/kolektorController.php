<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\notifikasi;
use App\anggota_kolektor;
use App\tagihan_anggota_kolektor;
use App\tagihan_kolektor;
use App\pembayaran_kolektor;
use App\pembayaran_anggota_kolektor;
use Carbon\Carbon;
use PDF;

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
        $anggotas = anggota_kolektor::get();
    	return view('kolektor.anggota',compact('anggotas'));
    }

    // fungsi untuk menampilkan halaman tambah anggota
    public function tambah_anggota(){
        return view('kolektor.tambah_anggota');
    }

    // fungsi untuk menambahkan/fungsi data anggota
    public function simpan_anggota(Request $request){

        // check validasi inputan user
        $validator = Validator::make($request->all(),[

            // syarat email tidak boleh kosong (required->tidak boleh kosong)
            'email' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'telepon' => 'required',
            'nomor_ktp' => 'required',
            'foto' => 'required',
            'foto_ktp' => 'required',
        ],

        // keterangan yang akan tampil jika ada inputan tidak benar
        [
            'email.required' => 'email tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong',
            'nama.required' => 'nama tidak boleh kosong',
            'telepon.required' => 'telepon tidak boleh kosong',
            'nomor_ktp.required' => 'nomor ktp tidak boleh kosong',
            'foto.required' => 'foto tidak boleh kosong',
            'foto_ktp.required' => 'foto ktp tidak boleh kosong'
        ]);

        // pemiliha kondisi jika ada inputan yg salah
         if ($validator->fails()) {

            // kembali ke halaman tambah anggota dengan membawa keterangan error, dan membawa data yang telah di inputkan sebelum nya agar tidak perlu menginputkan data kembali
            return back()
                ->withErrors($validator)
                ->withInput();

        // jika kondisi inputan sudah benar
         }else{

            // menyimpan foto ke folder laravel (posisi folder ada di storage/app/public/data/fotoAnggota)
            $pathFoto = $request->foto->store('public/data/fotoAnggota');

            // menyimpan foto ktp
            $pathFotoKtp = $request->foto_ktp->store('public/data/fotoKtpAnggota');
            
            // menyimpan data inputan ke variable data
            $data = [
                'kolektor_id' => auth()->guard('kolektor')->id(),
                'email' => $request->email,
                'nama' => $request->nama,
                'password' => bcrypt($request->password),
                'telepon' => $request->telepon,
                'nomor_ktp' => $request->nomor_ktp,
                'foto' => $pathFoto,
                'foto_ktp' => $pathFotoKtp,
                'region' => auth()->guard('kolektor')->user()->region,
            ];

            // menyimpan data anggota ke dalam database
            $anggota = anggota_kolektor::create($data);

            // menentukan tanggal tenggat pembayaran
            $tenggat = Carbon::now()->addMonths()->format('Y-m-d');

            // menyimpan data tagihan ke dalam variabel data_tagihan
            $data_tagihan = [
                "anggota_kolektor_id" => $anggota->id,
                "jumlah_tagihan" => "0",
                "jumlah_dibayar" => "0",
                "waktu_tenggat_pembayaran" => $tenggat,
                "status_tagihan" => "new"
            ];

            // menyimpan data tagihan anggota ke dalam database
            tagihan_anggota_kolektor::create($data_tagihan);

            // menyimpan data alert ke dalam variabel notif
            $notif = [
                "message" => "Selamat. anda berhasil mendaftar",
                "alert-type" => "success"
            ];

            // kembali ke halaman tambah data anggota dengan membawa alert yang akan di tampilkan
            return back()->with($notif);
         }
    }

    public function edit_anggota($id){
        $anggota = anggota_kolektor::find($id);
        return view('kolektor.edit_anggota',compact('anggota'));
    }

    public function update_anggota(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'nama' => 'required',
            'telepon' => 'required',
            'nomor_ktp' => 'required'
        ],
        [
            'email.required' => 'email tidak boleh kosong',
            'nama.required' => 'nama tidak boleh kosong',
            'telepon.required' => 'telepon tidak boleh kosong',
            'nomor_ktp.required' => 'nomor ktp tidak boleh kosong'
        ]);
         if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
         }else{
            $anggota = anggota_kolektor::find($request->id);
            if ($request->password) {
                $anggota->password = bcrypt($request->password);
            }
            if ($request->foto) {
                $pathFoto = $request->foto->store('public/data/fotoAnggota');
                $anggota->foto = $pathFoto;
            }
            if ($request->foto_ktp) {
                $pathFotoKtp = $request->foto->store('public/data/fotoKtpAnggota');
                $anggota->foto_ktp = $pathFotoKtp;
            }
            $anggota->email = $request->email;
            $anggota->nama = $request->nama;
            $anggota->telepon = $request->telepon;
            $anggota->nomor_ktp = $request->nomor_ktp;
            $anggota->save();
            $notif = [
                "message" => "Selamat. anda berhasil mengupdate data anggota kolektor",
                "alert-type" => "success"
            ];
            return redirect(url('/kolektor/anggota'))->with($notif);
         }
    }

    public function hapus_anggota(Request $request){
        anggota_kolektor::find($request->id)->delete();
        $notif = [
            "message" => "Berhasil menghapus akun anggota",
            "alert-type" => "success",
        ];
        return back()->with($notif);
    }

    public function tagihan_anggota(){
        $tagihans = tagihan_anggota_kolektor::get();
    	return view('kolektor.tagihan_anggota',compact('tagihans'));
    }

    public function edit_tagihan($id){
        $tagihan = tagihan_anggota_kolektor::find($id);
        return view('kolektor.edit_tagihan',compact('tagihan'));
    }

    // fungsi untuk memperbarui tagihan
    public function update_tagihan(Request $request, $id){

        // mendeklarasikan dan menginisiasi data status
        $status = "lunas";

        // karena jumlah tagihan dalam bentuk angka uang atau memiliki titik (ex: 1000.000) maka perlu di hilangkan titik nya agar dapat di gunakan kedalam operasi atau penentuan kondisi
        
        // menghilangkan titik pada data tagihan yang telah di inputkan
        $tagihan = str_replace(".", "", $request->jumlah_tagihan);

        //menghilangkan titik pada data bayar yang telah di inputkan
        $bayar = str_replace(".", "", $request->jumlah_dibayar);

        // jika tagihan lebih besar dari yang telah di bayar berarti status nya belum lunas
        if ($tagihan > $bayar) {

            // memperbarui data variable status menjadi belum lunas
            $status = "belum lunas";

        // jika tagihan sama atau besar dari pembayaran maka variable status menjadi lunas
        }else{

            // memperbarui data variable status menjadi lunas
            $status = "lunas";
        }

        // memperbarui data tagihan anggota ke dalam datbase
        tagihan_anggota_kolektor::where('id',$id)->update([
            "jumlah_tagihan" => $request->jumlah_tagihan,
            "jumlah_dibayar" => $request->jumlah_dibayar,
            "waktu_tenggat_pembayaran" => $request->waktu_tenggat_pembayaran,
            "status_tagihan" => $status
        ]);
        
        // mencari data tagihan anggota berdasarkan id
        $tagihan = tagihan_anggota_kolektor::find($id);

        // menyimpan data notifikasi ke dalam variable data notif
        $data_notif = [
                "pengirim" => auth()->guard('kolektor')->id(),
                "penerima" => $tagihan->anggota_kolektor_id,
                "kategori" => "update tagihan anggota",
                "id_kategori" => $id, 
                "deskripsi" => "tagihan telah diperbarui", 
                "status" => "belum dibaca" 
            ];

        // menyimpan data notifikasi ke dalam database 
        notifikasi::create($data_notif);

        // menyimpan data alert  kedalam variable notif
        $notif = [
            "message" => "Berhasil mengupdate tagihan kolektor",
            "alert-type" => "success",
        ];

        // menuju halaman tagihan anggota dengan membawa alert notif
        return redirect(url('kolektor/tagihan_anggota'))->with($notif);
    }
    
    public function pembayaran_anggota(){
        $anggotas = anggota_kolektor::where('kolektor_id',auth()->guard('kolektor')->id())
        ->with(['pembayarans'])
        ->get();
        $total_tagihan = 0;
        $total_dibayar = 0;
        $sisa = 0;
        foreach ($anggotas as $anggota) {
            $jumlah_tagihan = str_replace(".", "", $anggota->tagihans->jumlah_tagihan);
            $jumlah_dibayar = str_replace(".", "", $anggota->tagihans->jumlah_dibayar);

            $total_tagihan += $jumlah_tagihan;
            $total_dibayar += $jumlah_dibayar;
        }
        $sisa = $total_tagihan-$total_dibayar;
        $total_tagihan = $this->convert_to_rupiah($total_tagihan);
        $total_dibayar = $this->convert_to_rupiah($total_dibayar);
        $sisa = $this->convert_to_rupiah($sisa);

    	return view('kolektor.pembayaran_anggota',compact('anggotas','total_tagihan','total_dibayar','sisa'));
    }
    
    public function setujui_pembayaran(Request $request){
        $pembayaran = pembayaran_anggota_kolektor::find($request->id);
        $pembayaran->status_pembayaran = "verifikasi";
        $pembayaran->save();

        $tagihan = tagihan_anggota_kolektor::where('anggota_kolektor_id',$pembayaran->anggota_kolektor_id)->first();

        $jumlah_dibayar = str_replace(".", "", $pembayaran->jumlah_pembayaran);
        $jumlah_sebelum = str_replace(".", "", $tagihan->jumlah_dibayar);

        $jumlah_pembayaran_terbaru = $jumlah_dibayar+$jumlah_sebelum;
        $jumlah_pembayaran_terbaru = $this->convert_to_rupiah($jumlah_pembayaran_terbaru);

        $tagihan->jumlah_dibayar = $jumlah_pembayaran_terbaru;
        $tagihan->save();

        $data_notif = [
                "pengirim" => auth()->guard('kolektor')->id(),
                "penerima" => $pembayaran->anggota_kolektor_id,
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
    
    public function pembayaran_kepada_admin(){
        $tagihan = tagihan_kolektor::where('kolektor_id',auth()->guard('kolektor')->id())->first();
        $jumlah_tagihan = str_replace(".", "", $tagihan->jumlah_tagihan);
        $jumlah_dibayar = str_replace(".", "", $tagihan->jumlah_dibayar);
        $sisa_tagihan = $jumlah_tagihan-$jumlah_dibayar;
        $sisa_tagihan = $this->convert_to_rupiah($sisa_tagihan);

        $pembayarans = pembayaran_kolektor::where('kolektor_id',auth()->guard('kolektor')->id())->get();
        return view('kolektor.pembayaran_kepada_admin', compact('tagihan','sisa_tagihan','pembayarans'));
    }
    
    public function lakukan_pembayaran(){
        return view('kolektor.lakukan_pembayaran');
    }
    
    // fungsi untuk melakukan pembayaran ke admin
    public function simpan_pembayaran(Request $request){

        // check validasi inputan user
        $validator = Validator::make($request->all(),[

            // syarat validasi tidak boleh kosong (required)
            'jumlah_pembayaran' => 'required',
            'bukti_pembayaran' => 'required',
            'nama_bank' => 'required',
            'nomor_rekening' => 'required',
            'nama_pemilik' => 'required',
        ],

        // keterangan validasi
        [
            'jumlah_pembayaran.required' => 'jumlah pembayaran tidak boleh kosong',
            'bukti_pembayaran.required' => 'bukti pembayaran tidak boleh kosong',
            'nama_bank.required' => 'nama bank tidak boleh kosong',
            'nomor_rekening.required' => 'nomor rekening tidak boleh kosong',
            'nama_pemilik.required' => 'nama pemilik rekening tidak boleh kosong',
        ]);

        // jika validasi eror atau ada data yang tidak sesuai
         if ($validator->fails()) {

            // kembali ke halaman sebelumnya dengan membawa keterangan error validasi dan membawa inputan user sebelum nya
            return back()
                ->withErrors($validator)
                ->withInput();

        // jika validasi benar atau tidak ada yang salah
         }else{

            // menyimpan bukti pembayaran ke folder laravel (posisi folder : storage/app/public/data/buktiPembayaran)
            $buktiPembayaranPath = $request->bukti_pembayaran->store('public/data/buktiPembayaran');

            // menyimpan data inputan ke dalam variabel data
            $data = [
                "kolektor_id" => auth()->guard('kolektor')->id(),
                "jumlah_pembayaran" => $request->jumlah_pembayaran,
                "bukti_pembayaran" => $buktiPembayaranPath,
                "nama_bank" => $request->nama_bank,
                "nomor_rekening" => $request->nomor_rekening,
                "nama_pemilik" => $request->nama_pemilik,
                "status_pembayaran" => "menunggu verifikasi"
            ];

            // menyimpan data kedalam database
            $pembayaran = pembayaran_kolektor::create($data);

            // menyimpan data notifikasi ke dalam variable data notif
            $data_notif = [
                "pengirim" => auth()->guard('kolektor')->id(),
                "penerima" => 'admin',
                "kategori" => "pembayaran tagihan",
                "id_kategori" => $pembayaran->id, 
                "deskripsi" => auth()->guard('kolektor')->user()->nama." telah melakukan pembayaran tagihan", 
                "status" => "belum dibaca" 
            ];

            // menyimpan data notifikasi ke dalam database
            notifikasi::create($data_notif);

            // menyimpan data alert ke variabel notif
            $notif = [
                "message" => "Berhasil melakukan pembayaran, silahkan menunggu verifikasi admin",
                "alert-type" => "success"
            ];

            // menuju halaman pembayaran kepada admin dengan membawa alert notif
            return redirect(url('/kolektor/pembayaran_kepada_admin'))->with($notif);
         }
    }
    
    public function laporan(){
    	return view('kolektor.laporan');
    }
    
    public function download_laporan(){
        $now = Carbon::now();
        $pembayarans = pembayaran_anggota_kolektor::where('status_pembayaran','verifikasi')->orderBy('created_at','desc')->get();

        $pdf = PDF::loadview('kolektor.berkas_laporan', ['pembayarans' => $pembayarans]);
        return $pdf->download('Laporan Pembayaran '.$now);
    }
    
    public function logout(){
        auth()->guard('kolektor')->logout();
        return redirect(url('/'));
    }
    function convert_to_rupiah($angka){
        $hasil_rupiah = number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
}
