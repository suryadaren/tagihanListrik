@extends('admin.layout')

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
                  <th>Kategori</th>
                  <th>Deskripsi</th>
                  <th>Tanggal</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($notifikasis as $notifikasi)
                  @if($notifikasi->status == "belum dibaca")
                      <tr style="background-color: #f4f6f9">
                        <td>{{$notifikasi->kategori}}</td>
                        <td>{{$notifikasi->deskripsi}}</td>
                        <td>{{$notifikasi->created_at->format('d M Y')}}</td>
                        <td>
                          <a href="admin/lihat_notifikasi/{{$notifikasi->kategori}}/{{$notifikasi->id}}" class="btn btn-primary"><abbr title="Lihat"><i class="fa fa-eye"></i> </abbr></a>
                          <a onclick="hapus('{{$notifikasi->id}}')" class="btn btn-danger"><abbr title="Hapus"><i class="fa fa-trash"></i> </abbr></a>
                        </td>
                      </tr>
                    @else
                      <tr style="background-color: white">
                        <td>{{$notifikasi->kategori}}</td>
                        <td>{{$notifikasi->deskripsi}}</td>
                        <td>{{$notifikasi->created_at->format('d M Y')}}</td>
                        <td>
                          <a href="admin/lihat_notifikasi/{{$notifikasi->kategori}}/{{$notifikasi->id}}" class="btn btn-primary"><abbr title="Lihat"><i class="fa fa-eye"></i> </abbr></a>
                          <a onclick="hapus('{{$notifikasi->id}}')" class="btn btn-danger"><abbr title="Hapus"><i class="fa fa-trash"></i> </abbr></a>
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
              <form name="form" action="/admin/hapus_notifikasi" method="post">
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
  function hapus(id){
    document.forms['form']['id'].value=id;
    $('#hapus').modal();
  }
</script>

@stop