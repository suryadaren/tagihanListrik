@extends('kolektor.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Laporan Pembayaran</h1>
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
              <h3 class="card-title">Berkas Laporan Pembayaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <label>Silahkan tekan tombol dibawah untuk mendownload laporan</label> <br>
              <a href="/kolektor/download_laporan" target="_blank" class="btn btn-primary">Download Laporan</a>
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