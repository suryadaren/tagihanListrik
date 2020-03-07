@extends('admin.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Kolektor</h1>
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
              <h3 class="card-title">Daftar Nama Kolektor</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No. KTP</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>No. Hp</th>
                  <th>Region</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($kolektors as $kolektor)
                  <tr>
                    <td>{{$kolektor->nomor_ktp}}</td>
                    <td>{{$kolektor->nama}}</td>
                    <td>{{$kolektor->email}}</td>
                    <td>{{$kolektor->telepon}}</td>
                    <td>{{$kolektor->region}}</td>
                    <td>
                      @if($kolektor->status == "aktif")
                      <span class="badge badge-success">Aktif</span>
                      @elseif($kolektor->status == "register")
                      <span class="badge badge-warning">belum diverifikasi</span>
                      @endif
                    </td>
                    <td>
                      <a class="btn btn-primary" onclick="lihat('{{$kolektor->email}}', '{{$kolektor->nama}}', '{{Storage::url($kolektor->foto)}}', '{{$kolektor->telepon}}', '{{$kolektor->nomor_ktp}}', '{{$kolektor->region}}', '{{Storage::url($kolektor->foto_ktp)}}')"><abbr title="Lihat"><i class="fa fa-eye"></i> </abbr></a>
                      <a class="btn btn-danger" onclick="hapus('{{$kolektor->id}}')"><abbr title="Hapus"><i class="fa fa-trash"></i> </abbr></a>

                      @if($kolektor->status == "register")
                      <a onclick="setujui('{{$kolektor->id}}')" class="btn btn-success"><abbr title="Verifikasi"><i class="fa fa-check"></i> </abbr></a>
                      @endif
                    </td>
                  </tr>
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
                      <h5>Email</h5>
                      <p style="font-size: 12px" id="email">Alexander@gmail.com</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="callout callout-info">
                      <h5>No. KTP</h5>
                      <p style="font-size: 12px" id="nomor_ktp">155150201111251</p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="callout callout-info">
                      <h5>Telepon</h5>
                      <p style="font-size: 12px" id="telepon">0852-1234-5678</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="callout callout-info">
                      <h5>Region</h5>
                      <p style="font-size: 12px" id="jakarta">jakarta</p>
                    </div>
                  </div>
                </div>
                <div class="row text-center">
                  <div class="col-md-12">
                    <div class="callout callout-info">
                      <img src="" id="foto_ktp" alt="foto_ktp" width="200px">
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
              <p>Apakah Anda yakin ingin menghapus data kolektor ini ?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <form name="form_hapus" method="post" action="/admin/kolektor/hapus">
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
              <p>Apakah Anda yakin ingin menyetujui data kolektor ini ?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <form name="form_setujui" action="/admin/kolektor/setujui" method="post">
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
  function lihat(email, nama, foto, telepon, nomor_ktp, region, foto_ktp){
    $('#email').text(email);
    $('#nama').text(nama);
    $('#telepon').text(telepon);
    $('#nomor_ktp').text(nomor_ktp);
    $('#region').text(region);
    $('#foto').attr('src',foto);
    $('#foto_ktp').attr('src',foto_ktp);
    $('#lihat').modal();
  }
  function hapus(id){
    document.forms['form_hapus']['id'].value=id;
    $('#hapus').modal();
  }
  function setujui(id){
    document.forms['form_setujui']['id'].value=id;
    $('#setujui').modal();
  }
</script>

@stop