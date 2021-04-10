<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loket;
use App\Models\LoketLogin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SesiLoginAPI extends Controller
{
    public function sesi($id='')
    {
        $cek = User::find($id);
        $loket = Loket::whereNotIn('id',function($q){
            $c = Carbon::now();
            $h = [$c->format("Y-m-d"),$c->addDays(1)->format("Y-m-d")];
            $q->select("loket_id")->from("loket_logins")
                ->whereBetween('created_at',$h);
        })->get();
        if($cek==NULL):
            
            return response()->json(['isUser'=>false,'isPilihLoket'=>false,'result'=>[]]);
        else:
            $cek2 = LoketLogin::where('user_id',$cek->id)->first();
            if($cek2==NULL){
                return response()->json(['isUser'=>true,'isPilihLoket'=>false,'result'=>['login'=>$cek2,'loket'=>$loket]]);
                
            }else{
                return response()->json(['isUser'=>true,'isPilihLoket'=>true,'result'=>['login'=>$cek2,'loket'=>$cek2->getLoket()]]);

            }
        endif;
    }

    public function pilihLoket($loket,$user)
    {
        $data = [
            'user_id'=>$user,
            'loket_id'=>$loket,
        ];


        $l = new LoketLogin();

        $l->fill($data);
        $l->save();
        $lo = LoketLogin::find($l->id);
        $jsn = [
            'loket_login'=>$lo,
            'loket' => $lo->getLoket()
        ];
        return response()->json($jsn);

    }
}
