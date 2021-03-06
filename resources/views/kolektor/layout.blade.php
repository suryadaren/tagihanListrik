<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tagihan Listrik | Kolektor Pages</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/lte/dist/img/icon.png" type="image/x-icon">

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
<body class="hold-transition sidebar-mini">
<div class="wrapper">


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{Storage::url(auth()->guard('kolektor')->user()->foto)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->guard('kolektor')->user()->nama}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="/kolektor" class="nav-link {{ (request()->is('kolektor')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Notifikasi 
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/kolektor/anggota" class="nav-link {{ (request()->is('kolektor/anggota*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Anggota Kolektor
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/kolektor/tagihan_anggota" class="nav-link {{ (request()->is('kolektor/tagihan_anggota*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-cart-arrow-down"></i>
              <p>
                Tagihan Anggota
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/kolektor/pembayaran_anggota" class="nav-link {{ (request()->is('kolektor/pembayaran_anggota*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Pembayaran Anggota
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/kolektor/pembayaran_kepada_admin" class="nav-link {{ (request()->is('kolektor/pembayaran_kepada_admin*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Pembayaran Ke Admin
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/kolektor/laporan" class="nav-link {{ (request()->is('kolektor/laporan*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/kolektor/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout 
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>DataTables</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    @yield('content')

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
</html>
