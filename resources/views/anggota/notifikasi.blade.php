@extends('anggota.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Notifikasi</h1>
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
              <h3 class="card-title">Daftar Notifikasi</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Pengirim</th>
                  <th>Tanggal</th>
                  <th>Deskripsi</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($notifikasis as $notif)
                @if($notif->status == "belum dibaca")
                  <tr style="background-color: #f4f6f9">
                    <td>
                      Kolektor
                    </td>
                    <td>{{$notif->created_at}}</td>
                    <td>{{$notif->deskripsi}}</td>
                    <td>
                      <a onclick="lihat('nama','foto','jumlah_pembayaran','tanggal_pembayaran')" class="btn btn-primary"><abbr title="Lihat"><i class="fa fa-eye"></i> </abbr></a>
                      <a onclick="hapus('id')" class="btn btn-danger"><abbr title="Hapus"><i class="fa fa-trash"></i> </abbr></a>
                    </td>
                  </tr>
                @else
                  <tr style="background-color: white">
                    <td>
                      Kolektor
                    </td>
                    <td>{{$notif->created_at}}</td>
                    <td>{{$notif->deskripsi}}</td>
                    <td>
                      <a onclick="lihat('nama','foto','jumlah_pembayaran','tanggal_pembayaran')" class="btn btn-primary"><abbr title="Lihat"><i class="fa fa-eye"></i> </abbr></a>
                      <a onclick="hapus('id')" class="btn btn-danger"><abbr title="Hapus"><i class="fa fa-trash"></i> </abbr></a>
                    </td>
                  </tr>
                @endif
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
              <p>Apakah Anda yakin ingin menghapus notifikasi ini ?</p>
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


<script>
  function lihat(nama, foto, jumlah_pembayaran, tanggal_pembayaran){
    $('#lihat').modal();
  }
  function hapus(id){
    $('#hapus').modal();
  }
  function setujui(id){
    $('#setujui').modal();
  }
</script>

@stop