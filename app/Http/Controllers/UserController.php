<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class UserController extends Controller{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index(){
        $request = $this->request;
        $user = User::get(); 
        return view('pages.user.index',compact('user'));
    }
    public function create(){
        $request = $this->request;
        return view('pages.user.add');
    }
    public function store(){
        $request = $this->request;
        $post = $request->only('name','email','password','level');
        $post['password'] = Hash::make($post['password']);
        try{
            $user = new User();
            $user->fill($post);
            $user->save();
            return redirect(route('user.index'));

        }catch(\Exception $e ){
            return redirect()->back();
        }
    }
    public function show($id){
        $request = $this->request;
    }
    public function edit($id){
        $request = $this->request;
        $data = User::find($id);
        return view('pages.user.edit',compact('data'));
    }
    public function update($id){
        $request = $this->request;
        $user = User::find($id);
        if(!$user==NULL){
            $user->name=$request->name;
            $user->level=$request->level;
            $user->email=$request->email;
            $user->save();
        }

        return redirect(route('user.index'));

    }
    public function destroy($id){
        $request = $this->request;
    }
}