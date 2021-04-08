<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Antri;
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
        
        $antri = Antri::where("status",'0')->limit(10)->get();
        $json = [];
        foreach ($antri as $key => $value) {
            $json[$key]=$value->toArray();
            $json[$key]['pasien']=$value->getPasien();
        }
        return response()->json(['result'=>$json]);
    }
    public function create(){
        $request = $this->request;
        $header = explode(' ',$request->header('Keyauth'));
        $authe = $header[1];
        $user = SubscriptionUser::where("subscription_token",$authe)->first();
        $user = $user->user_id; 
        Antri::where("diproses_oleh",$user)->update(['status'=>'2']);
        $hari = Carbon::now()->format("Y-m-d 00:00:00");
        $hariEnd = Carbon::now()->addDays(1)->format("Y-m-d 00:00:00");
        $antri = Antri::whereBetween('created_at',[$hari,$hariEnd])->where('status','0')->orderBy('nomor','asc')->first();
        $antri->status='1';
        $antri->diproses_oleh=$user;
        $antri->save();
        return response()->json(['message'=>'done']);
    }
    public function store(){
        $request = $this->request;
    }
    public function show($id){
        $request = $this->request;
        $user = User::find($id);
        if($user->level!=='antrian'):
            $data = Antri::where("diproses_oleh",$id);
        else:
            $data = Antri::select('*');
        endif;
        $data = $data->where('status','1')->first();
        if($data===NULL){
            $data = [
                'nomor'=>'-'
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