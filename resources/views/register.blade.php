<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tagihan Listrik | Anggota Kolektor Pages</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/lte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/lte/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="">
  <div class="login-logo">
    <h1>Form Register</h1>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body">

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Masukan Data Anda</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/inputRegister" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-md-6">

                  <div class="form-group-inner mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{old('email')}}">
                    @if($errors->has('email'))
                      <div class="alert alert-danger" role="alert"> {{$errors->first('email')}} </div>
                    @endif
                  </div>

                  <div class="form-group-inner mb-3">
                    <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{old('nama')}}">
                    @if($errors->has('nama'))
                      <div class="alert alert-danger" role="alert"> {{$errors->first('nama')}} </div>
                    @endif
                  </div>

                  <div class="form-group-inner mb-3">
                    <select name="region" class="form-control" value="{{old('region')}}">
                      <option value="region">Region</option>
                      <option value="malang">Malang</option>
                      <option value="surabaya">Surabaya</option>
                    </select>
                  </div>

                  <div class="form-group-inner mb-3">
                    <div class="custom-file">
                      <input type="file" name="foto" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Pilih File Foto</label>
                    </div>
                  </div>

                  </div>
                  <!-- /.col -->
                  <div class="col-md-6">


                    <div class="form-group-inner mb-3">
                      <input type="password" name="password" class="form-control" placeholder="Password">
                      @if($errors->has('password'))
                        <div class="alert alert-danger" role="alert"> {{$errors->first('password')}} </div>
                      @endif
                    </div>

                    <div class="form-group-inner mb-3">
                      <input type="text" name="telepon" class="form-control" placeholder="Telepon" value="{{old('telepon')}}">
                      @if($errors->has('telepon'))
                        <div class="alert alert-danger" role="alert"> {{$errors->first('telepon')}} </div>
                      @endif
                    </div>

                    <div class="form-group-inner mb-3">
                      <input type="text" name="nomor_ktp" class="form-control" placeholder="Nomor KTP" value="{{old('nomor_ktp')}}">
                      @if($errors->has('nomor_ktp'))
                        <div class="alert alert-danger" role="alert"> {{$errors->first('nomor_ktp')}} </div>
                      @endif
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
        </div>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


<!-- jQuery -->
<script src="/lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="/lte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="/lte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/lte/dist/js/demo.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
      @if(Session::has('message'))
        var type="{{Session::get('alert-type','success')}}"
      
        switch(type){
          case 'success':
           toastr.info("{{ Session::get('message') }}");
           break;
        case 'error':
          toastr.error("{{ Session::get('message') }}");
          break;
        }
      @endif
    </script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>

</body>
</html>
