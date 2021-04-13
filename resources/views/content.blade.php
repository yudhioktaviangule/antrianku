<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{config('app.name')}}</title>
        <link rel="stylesheet" href="{{asset('antrian2/plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('antrian2/dist/css/adminlte.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <style>
            .background-image {
                position: absolute;
                
                top:0;
                left:0;
                right:0;
                bottom:0;

                z-index: 1;
                display: block;
                background: rgba(0,0,0,0.3) url('{{asset("antrian2/dist/img/photo4.jpg")}}') center center;
                background-blend-mode: darken;
                background-size: cover;
                width: 100vw;
                height: 100vh;
 
            }

            .mcontent {
                position: absolute;
                left: 0;
                right: 0;
                z-index: 9999;
                top:10%;

            }

        </style>
    </head>
    <body style='overflow-x: hidden;'>
            <div class="container-fluid">
                <div class="background-image"></div>
                <div class="mcontent row justify-content-center" >
                
                    @yield('content')
                </div>
            </div>
        
        <script src="{{asset('antrian2/plugins/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('antrian2/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('antrian/js/scripts.js')}}"></script>
        @yield('js')
    </body>
</html>
