<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link id="LinkIcon" href="" type="image/x-icon" rel="shortcut icon"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>KOBIJI System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/summernote/summernote-bs4.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/fullcalendar/main.css') }}">

  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">ホームページ</a>
      </li>
      @if (Auth::user()->role == 'student')
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('users.show', Auth::user()->id) }}" class="nav-link">About me</a>
        </li>
      @endif
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('users.edit', Auth::user()->id) }}" class="nav-link">プロフィル編集</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('users.edit.password', Auth::user()->id) }}" class="nav-link">パスワード変更</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('logout') }}" class="nav-link">ログアウト</a>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('bower_components/admin-lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">KOBIJI System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="image">
          <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle elevation-2" style="width: 35px; height: 35px;" alt="User Image">
        </div>
        <div class="info">
          @if (Auth::user()->role == 'student')
            <a href="{{ route('users.show', Auth::user()->id) }}" class="d-block">{{ Auth::user()->name }}</a>
          @else
            <a href="javascript:void(0)" class="d-block">{{ Auth::user()->name }}</a>
          @endif
        </div>
      </div>

      @if (Auth::user()->role !== 'student')
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link">
                <i class="fas fa-user"></i>
                <p>
                  ユーザー
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('users.index', ['role' => 'student']) }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>学生</p>
                  </a>
                </li>
                @if (Auth::user()->role === 'admin')
                  <li class="nav-item">
                    <a href="{{ route('users.index', 'admin') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>管理者</p>
                    </a>
                  </li>
                @endif
                <li class="nav-item">
                  <a href="{{ route('users.index', 'manager') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>マネジャー</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('users.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>追加</p>
                  </a>
                </li>
              </ul>
            </li>


            <li class="nav-item menu-open">
              <a href="#" class="nav-link">
                <i class="fas fa-book"></i>
                <p>
                  コース
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('subjects.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>追加</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('subjects.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>管理</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('subjects.registration') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>学生の追加</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('subjects.grading') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>グレーディング</p>
                  </a>
                </li>
              </ul>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      @endif
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('bower_components/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('bower_components/admin-lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('bower_components/admin-lte/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('bower_components/admin-lte/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('bower_components/admin-lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('bower_components/admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('bower_components/admin-lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('bower_components/admin-lte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/admin-lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('bower_components/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('bower_components/admin-lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('bower_components/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('bower_components/admin-lte/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('bower_components/admin-lte/dist/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('js/script.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('bower_components/admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>

@stack('script')

</body>
</html>
