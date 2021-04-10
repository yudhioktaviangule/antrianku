<?php
    namespace App\Http\Controllers\Api;

use App\Models\Antri;
use App\Models\Loket;
use Carbon\Carbon;
use Illuminate\Http\Request;
   use Illuminate\Support\Str;
   use Illuminate\Support\Facades\View;
   class AntrianViewApi extends AntrianApi{
       private $request;
       public function __construct(Request $request) {
           parent::__construct($request);
           $this->request = $request;
           
       }
       public function index(){
           $request = $this->request;
           $h = [
               Carbon::now()->format('Y-m-d'),
               Carbon::now()->addDays(1)->format('Y-m-d'),
           ];
           $antri = Antri::whereBetween('created_at',$h)->where('status','1')->get();
           $antriOne = Antri::whereBetween('created_at',$h)->where('status','1')->orderBy('id','desc')->first();
           $antriNext = Antri::whereBetween('created_at',$h)->where('status','0')->orderBy('id','asc')->first();
           $json = [];
           $xloket = Loket::get();
           foreach ($antri as $key => $value) {
               $f = $value->getLoketLogin();
               $f = $f ==NULL?0: $f->getLoket();
               $json[$key]['antri'] = $value->toArray();
               $json[$key]['loket'] = $f;
               
           }
           
           return response()->json([
               'result'=>$json,
               'loket'=>$xloket,
               'antriNow'=>$antriOne,
               'antriNext'=>$antriNext,
               ]);
       }
       public function create(){
           $request = $this->request;
       }
       public function store(){
           $request = $this->request;
       }
       public function show($id){
           $request = $this->request;
       }
       public function edit($id){
           $request = $this->request;
       }
       public function update($id){
           $request = $this->request;
       }
       public function destroy($id){
           $request = $this->request;
       }
   }