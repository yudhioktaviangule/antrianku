@extends('index')
@section("title","Beranda")
@php 
    $level = Auth::user()->level;
@endphp
@section('content')

    <div class="row">
            
        
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="far fa-calendar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Sisa Antrian</span>
                    <span class="info-box-number" name='jml-antrian'>0</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="far fa-calendar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Antrian Sekarang</span>
                    <span name='at-aktif' class="info-box-number">-</span>
                </div>
            </div>
            
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="far fa-calendar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Antrian Selanjutnya</span>
                    <span name='at-next' class="info-box-number">-</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
        <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header" style="background: url('{{asset('antrian2/dist/img/photo1.png')}}') center center;">
                <h3 class="widget-user-username text-white text-right">{{Auth::user()->name}}</h3>
                <h5 class="widget-user-desc text-white text-right">{{Auth::user()->level}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{('antrian2/dist/img/user-logo.png')}}" alt="User Avatar">
              </div>
              <div class="card-footer">
                <ul class="nav flex-column">
                    <li class="nav-item ">
                        <i class="far fa-envelope "></i> {{Auth::user()->email}}
                    </li>
                    <li class="nav-item " id='pilih-loket-head'>
                        Pilih Loket
                    </li>
                    <li class="nav-item " id='pilih-loket'>

                    </li>
                </ul>
                <p>
                    <br>
                    <small id='jam'>Login Sebagai: {{Auth::user()->name}}</small>  
                </p>
              </div>
            </div>
        </div>
        
        <div class="col-lg-8 col-md-8 col-sm-6 col-12">
                <div class="card"  id='antrian-container'>
                    <div class="card-header">
                        <h3 class='card-title'>Daftar Antrian</h3>
                        <div class="card-tools">
                            <a href="#" onclick='prosesAntrian()' class="btn btn-sm btn-primary">Panggil Antrian Selanjutnya</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div name="lanjutan">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card"  id='antrian-container-alt'>
                    
                    <div class="card-body">
                        <div class="text-center">
                            <i>Anda Belum Memilih Loket</i>
                        </div>
                    </div>
                </div>
        </div>
    </div>


@endsection


@section('js')
    <script>
        $(document).ready(async()=>{
            window.duFs = ()=>{
                let isFullFS = $.fullscreen.isNativelySupported() ? true:false;
                if(!isFullFS){
                    alert("Browser Tidak support Fullscreen");
                }else{
                    $("#antrian").fullscreen();
                    $("#fs-button").hide(100);
                }
            }
            window.idUsr =`{{Auth::id()}}`; 
            window.wedusGembel= async()=>{
                let antri = antrianClass();
                const data = await antri.getAntrian();
                const {result,count} = data;
                let html = `
                    `;
                
                let divHtml = $(`div[name='lanjutan']`);
                let i=1;
                let sisa = count;
                let xr = cekLoketHariIni(`{{Auth::id()}}`);
                if(Array.isArray(result)){
                    
                    result.map((data_i,ix)=>{
                        if(ix==0){
                            $('[name="at-next"]').html(data_i.nomor);
                        }
                        const {pasien} = data_i;
                        
                        html+=`
                           <div class="alert alert-light-primary">
                            ${i}. Antrian No. ${data_i.nomor}
                           </div>
                        `;
                        i++;
                  
                    })
                    
                }else{
                    $('[name="at-next"]').html("-");
                }
                
                html+='';
                getAntrianAktif();
                $('[name="jml-antrian"]').html(sisa);
                divHtml.html(html);
            }

            window.pilih = async (id)=>{
                const antri = antrianClass();
                const rst   = await antri.pilihLoket(id,idUsr)
                $("#antrian-container").show(500);
                $("#antrian-container-alt").hide(500);
                $("#pilih-loket").hide(500);
                $("#pilih-loket-head").hide(500);
            }

            window.cekLoketHariIni = async(id)=>{
                $("#antrian-container").hide();
                $("#antrian-container-alt").show();
                let antri = antrianClass();
                const rst = await antri.cekLoket(id);
                //console.log("RST",rst)
                const {isPilihLoket,isUser,result} = rst;
                let html  = ``;
                if(!isPilihLoket){
                    if(Array.isArray(result.loket)){
                        result.loket.map(value=>{
                            html+=`
                            <div  onclick="pilih(${value.id})" class="alert alert-light-primary">
                                <span>
                                    <i class="far fa-address-card"></i>&nbsp;Masuk ke ${value.name}
                                </span>
                            </div>
                            `
                        })
                        $("#pilih-loket").html(html);
                    }else{

                    }

                    
                }else{
                    $("#antrian-container").show();
                    $("#antrian-container-alt").hide();
                    $("#pilih-loket").hide(500);
                    
                    $("#pilih-loket-head").html(` <i class="fas fa-lock"></i> ${result.loket.name}`);
                }
            }
            window.getAntrianAktif = async()=>{
                let antri = antrianClass();
                let {nomor} = await antri.get("{{Auth::id()}}");
                //console.log("nomor",nomor);
                $("[name='at-aktif']").html(nomor);                
            }

            initFirebase(()=>{
                messaging.onMessage((payload)=>{
                  //  console.log("message",payload)
                    wedusGembel();
                });
                wedusGembel();
            });
            window.prosesAntrian=async()=>{
                let antri = antrianClass();
                await antri.prosesAntrian();
                
            }
            wedusGembel();
            
        });

    </script>
    
    
@endsection
