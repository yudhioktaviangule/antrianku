<?php

namespace App\Http\Controllers;

use App\Models\Loket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class LoketController extends Controller{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index(){
        $request = $this->request;
        $loket = Loket::get();
        return view('pages.loket.index',compact('loket'));
    }
    public function create(){
        $request = $this->request;
        return view('pages.loket.add');
    }
    public function store(){
        $request = $this->request;
        $post = $request->only('name');
        $lk = new Loket();
        $lk->fill($post);
        $lk->save();
        return redirect(route('loket.index'));
    }
    public function show($id){
        $request = $this->request;
    }
    public function edit($id){
        $request = $this->request;
        $data = Loket::find($id);
        return view('pages.loket.edit',compact('data'));
    }
    public function update($id){
        $request = $this->request;
        $data = Loket::find($id);
        if($data==NULL){
            return "NOT FOUND";
        }
        $name = $request->name;
        $data->name=$name;
        $data->save();
        return redirect(route("loket.index"));
    }
    public function destroy($id){
        $request = $this->request;
        $data = Loket::find($id);
        if($data!==NULL){
            $data->delete();

        }
        return redirect(route('loket.index'));
    }
}
