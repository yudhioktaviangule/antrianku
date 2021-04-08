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

<!DOCTYPE html>
<html lang="en">
<head>
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
</head>
<body>

    <div class="container">
        
        <token_antri style='display:none' token="{{$join}}"></token_antri>
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
            {{$pasien->name}}
        </div>

    </div>

    <script src="{{asset('js/app.js')}}"></script>
    <script>
        $(document).ready(async()=>{
            window.print();
            const antri = antrianClass();
            await antri.sender();
        });
    </script>
</body>
</html>