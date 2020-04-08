@extends('kolektor.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Pembayaran</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Masukan Data Pembayaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <form action="/kolektor/simpan_pembayaran" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-md-6">

                    <div class="input-group mb-3">
                      <input type="text" id="jumlah_pembayaran" name="jumlah_pembayaran" class="form-control" placeholder="Jumlah yang Dibayar (Rp)" value="{{old('jumlah_pembayaran')}}">
                    </div>
                    @if($errors->has('jumlah_pembayaran'))
                      <div class="alert alert-danger" role="alert"> {{$errors->first('jumlah_pembayaran')}} 
                      </div>
                    @endif

                    <div class="input-group mb-3">
                      <input type="text" id="nama_bank" name="nama_bank" class="form-control" placeholder="Nama Bank Pengirimnan" value="{{old('nama_bank')}}">
                    </div>
                    @if($errors->has('nama_bank'))
                      <div class="alert alert-danger" role="alert"> {{$errors->first('nama_bank')}} 
                      </div>
                    @endif


                  <div class="input-group mb-3">
                    <input type="file"class="custom-file-input" id="exampleInputFile" name="bukti_pembayaran">
                      <label class="custom-file-label" for="exampleInputFile">Bukti Pembayaran</label>
                  </div>
                      @if($errors->has('bukti_pembayaran'))
                        <div class="alert alert-danger" role="alert"> {{$errors->first('bukti_pembayaran')}} </div>
                      @endif

                    <div class="input-group mb-3">
                      <input type="submit" class="btn btn-primary" style="width: 200px" value="Simpan">
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="input-group mb-3">
                      <input type="text" id="nama_pemilik" name="nama_pemilik" class="form-control" placeholder="Nama Pemilik Rekening" value="{{old('nama_pemilik')}}">
                    </div>
                    @if($errors->has('nama_pemilik'))
                      <div class="alert alert-danger" role="alert"> {{$errors->first('nama_pemilik')}} 
                      </div>
                    @endif

                    <div class="input-group mb-3">
                      <input type="text" id="nomor_rekening" name="nomor_rekening" class="form-control" placeholder="Nomor Rekening" value="{{old('nomor_rekening')}}">
                    </div>
                    @if($errors->has('nomor_rekening'))
                      <div class="alert alert-danger" role="alert"> {{$errors->first('nomor_rekening')}} 
                      </div>
                    @endif

                  </div>
                  <!-- /.col -->
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    <script type="text/javascript">
    
    var rupiah = document.getElementById('jumlah_pembayaran');
    rupiah.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah.value = formatRupiah(this.value, '');
    });
 
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
 
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }
  </script>


    <script type="text/javascript">
    
    var rupiahB = document.getElementById('jumlah_dibayar');
    rupiahB.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiahB() untuk mengubah angka yang di ketik menjadi format angka
      rupiahB.value = formatRupiahB(this.value, '');
    });
 
    /* Fungsi formatRupiahB */
    function formatRupiahB(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiahB        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiahB += separator + ribuan.join('.');
      }
 
      rupiahB = split[1] != undefined ? rupiahB + ',' + split[1] : rupiahB;
      return prefix == undefined ? rupiahB : (rupiahB ? '' + rupiahB : '');
    }
  </script>
  
@stop