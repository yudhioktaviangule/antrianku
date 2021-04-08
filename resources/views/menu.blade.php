@extends("template.app")

@section("mmenu")
<div class="sb-sidenav-menu-heading">Core</div>
<a class="nav-link" href="index.html">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> Beranda
</a>
<a class="nav-link" href="#" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
    <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div> Logout
</a>
@endsection
