@extends('kolektor.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Tagihan Anggota</h1>
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
              <h3 class="card-title">Daftar Data Tagihan Anggota</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama Anggota</th>
                  <th>Jumlah Tagihan</th>
                  <th>Jumlah Dibayar</th>
                  <th>Tanggal Tenggat</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tagihans as $tagihan)
                  <tr>
                    <td>{{$tagihan->anggota_kolektor->nama}}</td>
                    <td>Rp. {{$tagihan->jumlah_tagihan}},-</td>
                    <td>Rp. {{$tagihan->jumlah_dibayar}},-</td>
                    <td>{{$tagihan->waktu_tenggat_pembayaran}}</td>
                      @if($tagihan->status_tagihan == "lunas")
                      <td><span class="badge badge-success">{{$tagihan->status_tagihan}}</span></td>
                      @elseif($tagihan->status_tagihan == "belum lunas")
                      <td><span class="badge badge-danger">{{$tagihan->status_tagihan}}</span></td>
                      @else
                      <td><span class="badge badge-warning">{{$tagihan->status_tagihan}}</span></td>
                      @endif
                    <td class="center">
                      <a onclick="lihat('{{$tagihan->nama}}','{{Storage::url($tagihan->anggota_kolektor->foto)}}','{{$tagihan->jumlah_tagihan}}','{{$tagihan->jumlah_dibayar}}','{{$tagihan->waktu_tenggat_pembayaran}}','{{$tagihan->status}}')" class="btn btn-primary"><abbr title="Lihat"><i class="fa fa-eye"></i> </abbr></a>
                      <a href="/kolektor/tagihan/edit_tagihan/{{$tagihan->id}}" class="btn btn-warning"><abbr title="Edit"><i class="fa fa-pencil-alt"></i> </abbr></a>
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
    $('#nama').text(nama);
    $('#jumlah_tagihan').text('Rp. '+jumlah_tagihan+',-');
    $('#jumlah_dibayar').text('Rp. '+jumlah_dibayar+',-');
    $('#waktu_tenggat').text(waktu_tenggat);
    $('#status').text(status);
    $('#foto').attr('src',foto);
    $('#lihat').modal();
  }
  function hapus(id){
    $('#hapus').modal();
  }
</script>

@stop