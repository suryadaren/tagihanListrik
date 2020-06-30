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
              <h3 class="card-title">Edit Data Anggota kolektor</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <form action="/kolektor/update_anggota" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{@method_field('put')}}
                <input type="hidden" name="id" value="{{$anggota->id}}">
                <div class="row">
                  <div class="col-md-12">

                  <div class="form-group-inner mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{$anggota->email}}">
                    @if($errors->has('email'))
                      <div class="alert alert-danger" role="alert"> {{$errors->first('email')}} </div>
                    @endif
                  </div>

                  <div class="form-group-inner mb-3">
                    <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{$anggota->nama}}">
                    @if($errors->has('nama'))
                      <div class="alert alert-danger" role="alert"> {{$errors->first('nama')}} </div>
                    @endif
                  </div>

                  <div class="form-group-inner mb-3">
                    <input type="text" name="nomor_ktp" class="form-control" placeholder="Nomor KTP" value="{{$anggota->nomor_ktp}}">
                    @if($errors->has('nomor_ktp'))
                      <div class="alert alert-danger" role="alert"> {{$errors->first('nomor_ktp')}} </div>
                    @endif
                  </div>

                  <div class="form-group-inner mb-3">
                    <input type="text" name="telepon" class="form-control" placeholder="Telepon" value="{{$anggota->telepon}}">
                    @if($errors->has('telepon'))
                      <div class="alert alert-danger" role="alert"> {{$errors->first('telepon')}} </div>
                    @endif
                  </div>

                  <div class="form-group-inner mb-3">
                    <input type="text" name="region" class="form-control" placeholder="region" value="{{$anggota->region}}">
                    @if($errors->has('region'))
                      <div class="alert alert-danger" role="alert"> {{$errors->first('region')}} </div>
                    @endif
                  </div>


                

                  <div class="form-group-inner mb-3">
                    <label>Kosongkan Data dibawah jika tidak diupdate</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    @if($errors->has('password'))
                      <div class="alert alert-danger" role="alert"> {{$errors->first('password')}} </div>
                    @endif
                  </div>

                  <div class="form-group-inner mb-3">
                    <div class="custom-file">
                      <input type="file" name="foto" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Pilih File Foto</label>
                    </div>
                  </div>

                  <div class="form-group-inner mb-3">
                    <div class="custom-file">
                      <input type="file" name="foto_ktp" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Pilih File Foto KTP</label>
                    </div>
                  </div>

                  </div>


                  <div class="col-md-12">
                    <input type="submit" class="btn btn-primary" style="width: 100%" value="SIMPAN">
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

    
  
@stop