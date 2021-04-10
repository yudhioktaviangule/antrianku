
@php
    $uMod  = \App\Models\User::class;
    $auths = Auth::user(); 
    $tokens  = $uMod::whereIn('id',function($q){
        $q->select("user_id")
            ->from("subscription_users");
    })->get();
    $dtoken = [];
    foreach($tokens as $key => $value):
        $dtoken[] = $value->getToken()->subscription_token;
    endforeach;
    $join = implode("_ANTRIAN_",$dtoken);
@endphp

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{env('APP_NAME')}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('antrian2/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('antrian2/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i> Fullscreen
        </a>
      </li>      
    </ul>

    
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <a class="nav-link" href="#" role="button">
          <i class="fas fa-calendar"></i>&nbsp;&nbsp;{{ \Carbon\Carbon::now()->format('d M Y') }}
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('antrian2/dist/img/AdminLTELogo.png')}}" alt="Antrian" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">NTRIAN ONLINE</span>
    </a>

    <!-- Sidebar -->
    @yield("mmenu")
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
  </div>

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>

<level class='d-none'>{{$auths->level}}</level>
<tok style='display:none' authtoken="{{$auths->remember_token}}" token='{{$auths->getToken()===NULL?"0":$auths->getToken()->subscription_token}}'></tok>
<vapid style='display:none'>{{env('VAPID_PUBLIC_KEY')}}</vapid>
<token_antri style='display:none' token="{{$join}}"></token_antri>
<script src="{{asset('antrian2/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('antrian2/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-analytics.js"></script>
<script src="{{asset('antrian2/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
@yield("mjs")
@yield("js")
</body>
</html>



