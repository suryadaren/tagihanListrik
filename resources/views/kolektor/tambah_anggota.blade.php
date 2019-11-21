@extends('kolektor.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Anggota Kolektor</h1>
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
              <h3 class="card-title">Tambah Data Anggota</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <div class="row">
                <div class="col-md-6">

                <div class="input-group mb-3">
                  <input type="email" class="form-control" placeholder="Email">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                </div>

                <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="password">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                </div>

                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Pilih File Foto KTP</label>
                  </div>
                </div>

                <div class="input-group mb-3">
                  <input type="submit" class="btn btn-primary" style="width: 200px" value="SIMPAN">
                </div>

                </div>
                <!-- /.col -->
                <div class="col-md-6">

                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Telepon">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@</span>
                    </div>
                  </div>

                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nomor KTP">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@</span>
                    </div>
                  </div>

                  <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Pilih File Foto Anggota</label>
                    </div>
                  </div>

                </div>
                <!-- /.col -->
              </div>
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
                      <h5>Jumlah Tagihan</h5>
                      <p style="font-size: 12px" id="jumlah_tagihan">Rp. 25.000.000,-</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="callout callout-info">
                      <h5>Jumlah dibayar</h5>
                      <p style="font-size: 12px" id="jumlah_dibayar">Rp. 20.000.000,-</p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="callout callout-info">
                      <h5>Waktu Tenggat</h5>
                      <p style="font-size: 12px" id="waktu_tenggat">26 Feb 2020</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="callout callout-danger">
                      <h5>Status</h5>
                      <p style="font-size: 12px" id="statu">belum lunas</p>
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
              <p>Apakah Anda yakin ingin menghapus data ini ?</p>
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
  function lihat(nama,foto,jumlah_tagihan,jumlah_dibayar,waktu_tenggat,status){
    $('#lihat').modal();
  }
  function hapus(id){
    $('#hapus').modal();
  }
</script>

@stop