<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Lang | @yield('title')</title>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('template-admin-lte')}}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{asset('template-admin-lte')}}/dist/css/adminlte.min.css">
  @yield('css')
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="{{asset('template-admin-lte')}}/index3.html" class="navbar-brand">
          <!-- <img src="{{asset('template-admin-lte')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
          <span class="brand-text font-weight-light">E-Lang</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Pelelangan</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="{{route('lelang.index')}}" class="dropdown-item">Barang dilelang</a></li>
                <li><a href="#" class="dropdown-item">Pencarian Barang Dilelang</a></li>
              </ul>
            </li>
            <a href="{{route('barangku.index')}}" class="nav-link">Barangku</a>
          </ul>

          <!-- SEARCH FORM -->
          <form class="form-inline ml-0 ml-md-3">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          @guest
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
              <i class="fas fa-sign-in-alt"></i>
              Login
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar-register" data-slide="true" href="register" role="button">
              <i class="fas fa-user-plus"></i>
              Register
            </a>
          </li>
          @endguest
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"> @yield('title') </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                @yield('breadcrumb')
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container">
          @yield('main')
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside id="control-sidebar-login" class="control-sidebar control-sidebar-dark" style="max-height: 300px;">
      <!-- Control sidebar content goes here -->
      <div class="menu" style="padding: 15px; padding-bottom: 10px;">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div style="margin: 10px;">
            <input id="email" class="form-control login" type="text" name="email" placeholder="Email.." />
          </div>
          <div style="margin: 10px;">
            <input id="password" class="form-control login" type="password" name="password" placeholder="Password.." />
          </div>
          <div style="margin: 10px;">
            <input class="btn btn-primary" type="submit" name="submit" value="login" />
          </div>
        </form>
      </div>
    </aside>

    <!-- <aside id="control-sidebar-register" class="control-sidebar control-sidebar-dark" style="max-height: 300px;"> -->
    <!-- Control sidebar content goes here -->
    <!-- <div class="menu" style="padding: 15px; padding-bottom: 10px;">
        <form class="form-horizontal" method="post" accept-charset="UTF-8">
          <div style="margin: 10px;">
            <input id="sp_uname" class="form-control login" type="text" name="sp_uname" placeholder="Username.." />
          </div>
          <div style="margin: 10px;">
            <input id="sp_pass" class="form-control login" type="password" name="sp_pass" placeholder="Password.." />
          </div>
          <div style="margin: 10px;">
            <input class="btn btn-primary" type="submit" name="submit" value="login" />
          </div>
        </form>
      </div>
    </aside> -->
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2021 E-Lang</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{asset('template-admin-lte')}}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('template-admin-lte')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('template-admin-lte')}}/dist/js/adminlte.min.js"></script>
  <script>
    function openRegis() {
      document.getElementById("control-sidebar-register").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
    }
  </script>
  @yield('js')
</body>

</html>