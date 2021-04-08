<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class SubscribeToken extends Controller{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
       // $this->middleware('auth');
    }
    public function index(){
        $request = $this->request;
        $user_id = $request->user;
        $token = $request->token;
        $subscribe = SubscriptionUser::find($user_id);
        if($subscribe==NULL):
            $subscribe = new SubscriptionUser();
        endif;
        $subscribe->user_id=$user_id;
        $subscribe->subscription_token=$token;
        $subscribe->save();
        return response()->json(['message'=>'Token has been initialized','_token'=>$token]);
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
