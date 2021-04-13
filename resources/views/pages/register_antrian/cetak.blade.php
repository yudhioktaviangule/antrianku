@php
    $uMod  = \App\Models\User::class;
    
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
@extends('content')
@section('content')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomor Antrian</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        body{
            font-family:Arial, Helvetica, sans-serif;
            padding:0;
            margin:0;
        }
        .container{
            width:20%;
        }
        .text-center{
            text-align:center;
            width:100%;
            padding:.2em;
        }
    </style>
    <div class="col-md-3 col-lg-3 col-8">
        <div class="card">
                <token_antri style='display:none' token="{{$join}}"></token_antri>
            <div class="card-body" id='s'>
                <div style="display:block;width:100%">
                    <div class="text-center">
                        {{env('APP_NAME')}}
                    </div>
                    <div class="text-center">
                        <strong>
                            NOMOR ANTRIAN ANDA
                        </strong>
                    </div>
                    <div class="text-center">
                        <h1>{{$antrien->nomor}}</h1>
                    </div>
                    <div class="text-center">
                        <strong>
                            {{\Carbon\Carbon::parse($antrien->created_at)->format('d/m/Y')}}
                        </strong>
                    </div>
                    <div class="text-center">
                        {{$pasien->name}}<br>
                        {{$antrien->keperluan}}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    <a id='btn-cetak' href="#" onclick="cetaks()" style='display:none' class="btn btn-info btn-block">
                        <i class="fas fa-print"></i> Cetak
                    </a>
                </div>
            </div>
        </div>
        
    </div>        
@endsection
@section('js')

    <script src="{{asset('js/app.js')}}"></script>
    <script>
        window.cetaks= ()=>{
                try{
                    let elemen = document.querySelector('#s');
                    toCanvas(elemen,renderContent)
                }catch(e){
                    alert("DOCUMENT is not ready yet")
                }
                
            }
        
        $(document).ready(async()=>{
            let ival = setInterval(() => {
                if(canvasReady){
                    $('#btn-cetak').show(500);
                    clearInterval(ival);
                }
            }, 1);
            const antri = antrianClass();
            await antri.sender();
            window.toCanvas=(element,callback) =>{
               
                    htmltoCanvas(element).then(canvas=>{
                        const context = canvas.toDataURL("image/webp");
                        callback(context); 
                    });

               
                
            }
            window.renderContent = (data)=>{
                let content = `
                    <html>
                        <head>
                            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
                            <link rel="stylesheet" href="{{asset('antrian2/plugins/fontawesome-free/css/all.min.css')}}">
                            <link rel="stylesheet" href="{{asset('antrian2/dist/css/adminlte.min.css')}}">
                            <link rel="stylesheet" href="{{asset('css/app.css')}}">                    
                        </head>
                        <body>
                            <div class='col' style='margin-top:10px;'>
                                <img style='width:240px' src="_BODI_" alt=""></img>
                            </div>
                        </body>
                    </html>
                    
                `;
                let shtml = data;
                let scontent = content.replace(/_BODI_/g,shtml);
                let swid = window.screen.width, shei=window.screen.height;
                let myWindow=window.open('','',`width=${swid},height=${shei}`);
                myWindow.document.write(scontent);
                myWindow.document
                setTimeout(() => {
                    myWindow.focus();
                    myWindow.print();
                }, 2000);
               
            }
            
        });
        
    </script>

@endsection