@extends('index')
@php 
    $level = Auth::user()->level;
@endphp
@section('content')
@if($level!=='antrian')
<div class="row">
        
    <div class="col-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <p>Helpdesk</p>
                <h3>{{Auth::user()->name}}</h3>
                <p></p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                {{Auth::user()->level}}
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card bg-primary text-white ">
            <div class="card-body">
                <p>Antrian</p>
                <h3 name='at-aktif'>-</h3>
                <p></p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#" onclick="prosesAntrian()">Antrian Selanjutnya</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-12">
            <p>Daftar Antrian</p>
            <div name="lanjutan">
                
            </div>
    </div>
</div>

@else
    <div class="row" id='antrian' style='background:white;padding-top:15px'>
        <div class="col-12">
            <h4 class='text-center'>
                {{env('APP_NAME')}}
            </h4>
            <div class="text-center" style="margin-top:10px;margin-bottom:15px">
                <a href="#" class="btn btn-sm btn-primary" onclick="duFs()" id='fs-button'>
                    Fullscreen
                </a>
            </div>
        </div>
        <div class="col-6">
            <div class="col-12" >
                <div class="card bg-primary text-white" >
                    <div class="card-body">
                        <p>Nomor Antrian</p>
                        <h3 name='at-aktif'>-</h3>
                        
                    </div>
                </div>
            </div>
           
        </div>
        <div class="col-6">
            <p>Antrian Selanjutnya</p>
            <div name="lanjutan">
                <h4>A002</h4>
                <h4>A003</h4>
                <h4>A003</h4>
            </div>
        </div>
    </div>

@endif
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
                const {result} = data;
                let html = `<table class='table table-bordered'>
                    <tr>
                        <th>#</th>
                        <th>Antrian</th>
                        <th>Nama</th>
                    </tr>
                    `;
                
                let divHtml = $(`div[name='lanjutan']`);
                let i=1;
                if(Array.isArray(result)){
                    result.map(data_i=>{
                        const {pasien} = data_i;
                        console.log(pasien);
                        html+=`
                           <tr>
                                <td class='text-center' style='width:50px'>${i}.</td>
                                <td>${data_i.nomor}</td>
                                <td>${pasien.name}</td>
                           </tr>
                        `;
                        i++;
                    })
                }
                html+='</table>';
                getAntrianAktif();
                divHtml.html(html);
            }
            window.getAntrianAktif = async()=>{
                let antri = antrianClass();
                let {nomor} = await antri.get("{{Auth::id()}}");
                console.log("nomor",nomor);
                $("[name='at-aktif']").html(nomor);                
            }

            initFirebase(()=>{
                messaging.onMessage((payload)=>{
                    console.log("message",payload)
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
