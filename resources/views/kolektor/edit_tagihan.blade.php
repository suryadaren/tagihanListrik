@extends('kolektor.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Tagihan</h1>
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
              <h3 class="card-title">Edit Data Tagihan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <form action="/kolektor/tagihan/update_tagihan/{{$tagihan->id}}" method="post">
                {{csrf_field()}}
                {{@method_field('put')}}
                <div class="row">
                  <div class="col-md-6">

                  <div class="input-group mb-3">
                    <label>Jumlah Tagihan : </label>
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" id="jumlah_tagihan" name="jumlah_tagihan" class="form-control" placeholder="Jumlah Tagihan" value="{{$tagihan->jumlah_tagihan}}">
                  </div>

                  <div class="input-group mb-3">
                    <label>Waktu Tenggat :</label>
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="date" class="form-control date" placeholder="Waktu Tenggat Pembayaran" name="waktu_tenggat_pembayaran" value="{{$tagihan->waktu_tenggat_pembayaran}}">
                  </div>

                  </div>
                  <!-- /.col -->
                  <div class="col-md-6">

                    <div class="input-group mb-3">
                      <label>Jumlah Dibayar:</label>
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="jumlah_dibayar" name="jumlah_dibayar" class="form-control" placeholder="Jumlah Dibayar" value="{{$tagihan->jumlah_dibayar}}">
                    </div>

                    <div class="input-group mb-3">
                      <input type="submit" class="btn btn-primary" style="width: 200px" value="Simpan">
                    </div>

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
    
    var rupiah = document.getElementById('jumlah_tagihan');
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