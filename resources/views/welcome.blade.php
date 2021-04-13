@extends('content')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-8 col-12">
                <h4 class='text-light text-center' style='margin-top:15%;margin-bottom:25px'>Antrian Online</h4>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="{{route('register_antrian.index')}}" class="info-box bg-primary">
                            <span class="info-box-icon"><i class="far fa-calendar"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Register Antrian</span>
                                <span class="info-box-number" name='jml-antrian'>Register Antrian Anda</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6">
                        <a href="{{route('login')}}" class="info-box bg-success">
                            <span class="info-box-icon"><i class="fas fa-lock"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Login</span>
                                <span class="info-box-number" name='jml-antrian'>Login Admin</span>
                            </div>
                        </a>
                    </div>
                    
                </div>        
            </div>
        </div>
    </div>
@endsection