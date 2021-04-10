<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Antri;
use App\Models\LoketLogin;
use App\Models\SubscriptionUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class AntrianApi extends Controller{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('auth_antri');
    }
    public function index(){
        $hari = Carbon::now()->format("Y-m-d 00:00:00");
        $hariEnd = Carbon::now()->addDays(1)->format("Y-m-d 00:00:00");
        $antri = Antri::where("status",'0')->whereBetween('created_at',[$hari,$hariEnd])->limit(10)->get();
        $cnt=Antri::where("status",'0')->whereBetween('created_at',[$hari,$hariEnd])->count();
        $json = [];
        foreach ($antri as $key => $value) {
            $f = $value->getLoketLogin();
            $f = $f==NULL ? 0 : $f->getLoket();
            $json[$key]=$value->toArray();
            $json[$key]['pasien']=$value->getPasien();
            $json[$key]['loket']=$f;
        }
        return response()->json(['result'=>$json,'count'=>$cnt]);
    }
    public function create(){
        $request = $this->request;
        $header = explode(' ',$request->header('Keyauth'));
        $authe = $header[1];
        $user = User::where("remember_token",$authe)->first();
        $user = LoketLogin::where('user_id',$user->id)->first(); 
        $iduser = $user->id;
        Antri::where("diproses_oleh",$iduser)->update(['status'=>'2']);
        $hari = Carbon::now()->format("Y-m-d 00:00:00");
        $hariEnd = Carbon::now()->addDays(1)->format("Y-m-d 00:00:00");
        $antri = Antri::whereBetween('created_at',[$hari,$hariEnd])->where('status','0')->orderBy('nomor','asc')->first();
        $antri->status='1';
        $antri->diproses_oleh=$iduser;
        $antri->save();
        return response()->json(['message'=>'done']);
    }
    public function store(){
        $request = $this->request;
    }
    public function show($id){
        $request = $this->request;
        $betwen = [
            Carbon::now()->format("Y-m-d"),
            Carbon::now()->addDays(1)->format("Y-m-d"),
        ];
        $user = LoketLogin::where('user_id',$id)->whereBetween('created_at',$betwen)->first();
        if($user==NULL):
            $data = [
                'nomor'=>'-'
            ];
            return $data;
        endif;
        $uid  = $user->id;
        $data = Antri::where('status','1');
        if($user->level!=='antrian'):
            $data = $data->where("diproses_oleh",$uid);
        endif;
        $data = $data->first();
        if($data===NULL){
            $data = [
                'nomor'=>'no number'
            ];
        }

        return response()->json($data);
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