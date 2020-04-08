@extends('kolektor.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Pembayaran Anggota</h1>
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
              <h3 class="card-title">Daftar Data Pembayaran Anggota</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                
                <div class="col-lg-4 col-6">
                  <!-- small card -->
                  <div class="small-box bg-info">
                    <div class="inner">

                      <p>Total Tagihan</p>
                      <h3>Rp. {{$total_tagihan}},-</h3>
                    </div>
                    <div class="icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-6">
                  <!-- small card -->
                  <div class="small-box bg-success">
                    <div class="inner">

                      <p>Total Telah Dibayar</p>
                      <h3>Rp. {{$total_dibayar}},-</h3>
                    </div>
                    <div class="icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-6">
                  <!-- small card -->
                  <div class="small-box bg-danger">
                    <div class="inner">

                      <p>Sisa Pembayaran</p>
                      <h3>Rp. {{$sisa}},-</h3>
                    </div>
                    <div class="icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                  </div>
                </div>


              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama Kolektor</th>
                  <th>Region</th>
                  <th>Jumlah Pembayaran</th>
                  <th>Tanggal Pembayaran</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($anggotas as $anggota)
                  @foreach($anggota->pembayarans as $pembayaran)
                    <tr>
                      <td>{{$anggota->nama}}</td>
                      <td>{{$anggota->region}}</td>
                      <td>Rp. {{$pembayaran->jumlah_pembayaran}},-</td>
                      <td>{{$pembayaran->created_at}}</td>
                      <td>
                        @if($pembayaran->status_pembayaran == "verifikasi")
                        <span class="badge badge-success">Verifikasi</span>
                        @elseif($pembayaran->status_pembayaran == "menunggu verifikasi")
                        <span class="badge badge-warning">Menunggu Verifikasi</span>
                        @else
                        <span class="badge badge-danger">ditolak</span>
                        @endif
                    </td>
                      <td>
                        <a onclick="lihat('{{$pembayaran->anggota_kolektor->nama}}','{{Storage::url($pembayaran->anggota_kolektor->foto)}}','{{$pembayaran->jumlah_pembayaran}}','{{$pembayaran->created_at}}','{{$pembayaran->nama_bank}}','{{$pembayaran->nomor_rekening}}','{{$pembayaran->nama_pemilik}}','{{Storage::url($pembayaran->bukti_pembayaran)}}')" class="btn btn-primary"><abbr title="Lihat"><i class="fa fa-eye"></i> </abbr></a>

                        @if($pembayaran->status_pembayaran == "menunggu verifikasi")
                        <a onclick="setujui('{{$pembayaran->id}}')" class="btn btn-success"><abbr title="Verifikasi"><i class="fa fa-check"></i> </abbr></a>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                @endforeach
                </tbody>
              </table>
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


    <!-- modal lihat -->
      <div class="modal fade" id="lihat">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username" id="nama">Alexander Pierce</h3>
                <h5 class="widget-user-desc">Founder & CEO</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" id="foto" src="/lte/dist/img/user1-128x128.jpg" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-6">
                    <div class="callout callout-info">
                      <h5>Jumlah Pembayaran</h5>
                      <p style="font-size: 12px" id="jumlah_pembayaran">Rp. 10.000.000,-</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="callout callout-info">
                      <h5>Tanggal Pembayaran</h5>
                      <p style="font-size: 12px" id="tanggal_pembayaran">20 Nov 2019</p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="callout callout-info">
                      <h5>Nama Bank</h5>
                      <p style="font-size: 12px" id="nama_bank">Mandiri</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="callout callout-info">
                      <h5>Nomor rekening</h5>
                      <p style="font-size: 12px" id="nomor_rekening">1209121821</p>
                    </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
                    <div class="callout callout-info">
                      <h5>Nama Pemilik</h5>
                      <p style="font-size: 12px" id="nama_pemilik">Kolektor</p>
                    </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-12">
                    <div class="callout callout-info">
                      <h5>Bukti Transfer</h5>
                      <img src="" id="bukti_pembayaran" alt="bukti_pembayaran" width="200px">
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <!-- modal hapus -->
      <div class="modal fade" id="hapus">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Apakah Anda yakin ingin menghapus data pembayaran ini ?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="/admin/kolektor/hapus">
                <input type="hidden" name="id">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" value="Ya" class="btn btn-primary">
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



      <!-- modal setujui -->
      <div class="modal fade" id="setujui">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Setujui Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Apakah Anda yakin ingin menyetujui pembayaran ini ?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <form name="form_setujui" action="/kolektor/setujui_pembayaran" method="post">
                {{csrf_field()}}
                <input type="hidden" name="id">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" value="Ya" class="btn btn-primary">
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<script>
  function lihat(nama, foto, jumlah_pembayaran, tanggal_pembayaran, nama_bank, nomor_rekening, nama_pemilik, bukti_pembayaran){
    $('#nama').text(nama);
    $('#jumlah_pembayaran').text(jumlah_pembayaran);
    $('#tanggal_pembayaran').text(tanggal_pembayaran);
    $('#nama_bank').text(nama_bank);
    $('#nomor_rekening').text(nomor_rekening);
    $('#nama_pemilik').text(nama_pemilik);
    $('#foto').attr('src',foto);
    $('#bukti_pembayaran').attr('src',bukti_pembayaran);
    $('#lihat').modal();
  }
  function hapus(id){
    $('#hapus').modal();
  }
  function setujui(id){
    document.forms['form_setujui']['id'].value=id;
    $('#setujui').modal();
  }
</script>

@stop