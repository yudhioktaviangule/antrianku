<?php

namespace App\Http\Middleware\Api;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AntrianApiMdw
{

    public function handle(Request $request, Closure $next)
    {
        $vheader = $request->headers->has("Keyauth");
        if($vheader){
            $header = $request->header("Keyauth");
            $headerg = explode(' ',$header);
            $data = User::where("remember_token",$headerg[1])->first();
            if($data==NULL):
                return response()->json(['message'=>'Unauthorized'],401);
            else:
                return $next($request);
            endif;
        }else{
            return response()->json(['message'=>'No Auth Key'],403);
        }
    }
}
