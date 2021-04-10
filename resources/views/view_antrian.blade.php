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
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{env('APP_NAME')}}</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('antrian2/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset('antrian2/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <style>
           .background-image {
                position: absolute;
                
                top:0;
                left:0;
                right:0;
                bottom:0;
                margin-top:-40px;
                margin-left:-20px;
                z-index: 1;
                display: block;
                background: rgb(255,255,255) url('{{asset("antrian2/dist/img/estock.jpg")}}') no-repeat center center;
               
                width: 150vw;
                height: 150vh;
                -webkit-filter: blur(15px);
                -moz-filter: blur(15px);
                -o-filter: blur(15px);
                -ms-filter: blur(15px);
                filter: blur(15px);
            }

            .mcontent {
                position: absolute;
                left: 0;
                right: 0;
                z-index: 9999;
                

            }

            .fullsc-container{
                overflow-x:hidden;
                overflow-y: hidden;
            }

  </style>
</head>

<body class='fullsc-container'>
    <div id="fullsc-container" >
            <div class="background-image"></div>
            <div class="mcontent" id='mcontent'>
                <nav class="navbar navbar-expand-sm bg-light">

                <!-- Links -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" style="color:#2b4f60";>{{env('APP_NAME')}}</a>
                        </li>
                        
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a onclick='openFullscreen()' class="nav-link" href="#" id='fscreen' style="color:#2b4f60";></a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#" id='tanggal' style="color:#2b4f60";>18:01</a>
                        </li>
                    </ul>

                </nav>      
                <div class="container-fluid" style='margin-top:20px'>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-box bg-purple elevation-2">
                                <div class="container-fluid">
                                    <div class="text-center">
                                        <p>ANTRIAN</p>
                                        <h3 name="at-aktif">-</h3>
                                    </div>

                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-box bg-red elevation-2">
                            <div class="container-fluid">
                                    <div class="text-center">
                                        <p>ANTRIAN SELANJUTNYA</p>
                                        <h3 name="at-next">-</h3>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12" style="margin-top:15px">
                            <div class="row">
                                <div class="col-12 col-md-6" id='md-loket'>
                                    <div class="small-box bg-primary">
                                        <div class="inner">
                                            <p>ANTRIAN</p>
                                            <h3>A0001</h3>

                                            <p>Loket 1</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        
                                    </div>
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <p>ANTRIAN</p>
                                            <h3>A0001</h3>

                                            <p>Loket 1</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        
                                    </div>
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <p>ANTRIAN</p>
                                            <h3>A0001</h3>

                                            <p>Loket 1</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">{{env('APP_NAME')}}</h3>
                                        </div>
                                        <div class="card-body">
                                        <iframe width="100%" height="315" 
                                            src="https://www.youtube.com/embed/3ooqLbCdVug?autoplay=1&version=3&loop=1&playlist=3ooqLbCdVug" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        <auth></auth>
    </form>
    <level class='d-none'>{{Auth::user()->level}}</level>
    <tok style='display:none' authtoken="{{$auths->remember_token}}" token='{{$auths->getToken()===NULL?"0":$auths->getToken()->subscription_token}}'></tok>
    <vapid style='display:none'>{{env('VAPID_PUBLIC_KEY')}}</vapid>
    <token_antri style='display:none' token="{{$join}}"></token_antri>
    <script src="{{asset('antrian2/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
    <script src="{{asset('antrian2/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-analytics.js"></script>
    <script src="{{asset('antrian2/dist/js/adminlte.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        $(document).ready(()=>{
            const warna = [
                'success',
                'primary',
                'purple',
            ];
            const defaultView = `
                <div class="small-box bg-_WARNA_">
                    <div class="inner">
                        <p>ANTRIAN</p>
                        <h3>_NOANTRI_</h3>
                        <p>_LOKET_</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>            
            `;
            moment.locale('id')
            window.isFs = false;
            const iconia ={
                    isNotFScreen:`<i class="fas fa-expand"></i>`,
                    isFScreen:`<i class="fas fa-compress"></i>`
                }
            const elem = $("body")[0];
            const fs = $("#fscreen");
            fs.html(iconia.isNotFScreen)
            setInterval(() => {
                $("#tanggal").html(moment().format('LLLL'))
            }, 1000);
            setInterval(() => {
                $("auth").html(`@csrf`);
                $("edit").html(`<input type='hidden' name='_method' value='put'>`);
                $("delete").html(`<input type='hidden' name='_method' value='delete'>`);
            }, 1);
            window.idUsr = `{{Auth::id()}}`;
            window.loket = [];
            window.openFullscreen=()=>{
                if(!isFs){
                    if (elem.requestFullscreen) {
                        elem.requestFullscreen();
                    } else if (elem.webkitRequestFullscreen) { /* Safari */
                        elem.webkitRequestFullscreen();
                    } else if (elem.msRequestFullscreen) { /* IE11 */
                        elem.msRequestFullscreen();
                    }
                    isFs=true;
                    fs.html(iconia.isFScreen);
                }else{
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.webkitExitFullscreen) { /* Safari */
                        document.webkitExitFullscreen();
                    } else if (document.msExitFullscreen) { /* IE11 */
                        document.msExitFullscreen();
                    }
                    isFs=false;
                    fs.html(iconia.isNotFScreen);
                }
               
            };
            window.exitFullscreen=()=>{
                const elem = $("body")[0];   
            };
            
            
            window.antrianku = async ()=>{
                let antri =antrianClass();
                const daat = await antri.antrianView();
                
                window.loket =  daat.loket;
                window.result = daat.result;
               let antriNow = daat.antriNow;
                let antriNext = daat.antriNext;
                $('[name="at-aktif"]').html(antriNow.nomor);
                $('[name="at-next"]').html(antriNext.nomor);
            }
            window.renderLoket=()=>{            
                const result = window.result;

                if(Array.isArray(result)){
                    let html='';
                    result.map(v=>{
                        if(v.loket!=0){
                            let max = 2;
                            let min = 0;
                            let nwarna = Math.floor(Math.random() *warna.length)
                            let warnaSekarang = warna[nwarna];
                            html+=defaultView.replace(/_WARNA_|_NOANTRI_|_LOKET_/gi,match=>{
                                const xmatch ={
                                    _WARNA_:warnaSekarang,
                                    _LOKET_:v.loket.name,
                                    _NOANTRI_:v.antri.nomor,
                                }
                                return xmatch[match];
                            })
                        }
                    })
                    $("#md-loket").html(html);

                }
            }
            window.refreshData = async()=>{
                await antrianku();
                renderLoket();
            }


            initFirebase(async ()=>{
                messaging.onMessage(async (payload)=>{
                    await refreshData();
                });
                
                await refreshData();
            });

            
        })
    </script>
</body>
</html>

