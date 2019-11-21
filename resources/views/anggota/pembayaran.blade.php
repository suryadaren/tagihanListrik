@extends('anggota.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Pembayaran Kepada Admin</h1>
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
              <h3 class="card-title">Daftar Data Pembayaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                
                <div class="col-lg-4 col-6">
                  <!-- small card -->
                  <div class="small-box bg-info">
                    <div class="inner">

                      <p>Total Tagihan</p>
                      <h3>Rp. 20.000.000,-</h3>
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
                      <h3>Rp. 15.000.000,-</h3>
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
                      <h3>Rp. 5.000.000,-</h3>
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
                  <th>Jumlah Pembayaran</th>
                  <th>Tanggal Pembayaran</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Rp. 1000.000,-</td>
                  <td>12/12/2019</td>
                  <td><span class="badge badge-success">Verifikasi</span></td>
                  <td>
                    <a onclick="hapus('id')" class="btn btn-danger"><abbr title="Hapus"><i class="fa fa-trash"></i> </abbr></a>
                  </td>
                </tr>
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
              <form action="/admin/kolektor/setujui">
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