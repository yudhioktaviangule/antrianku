<?php

namespace App\Http\Controllers;

use App\Models\Antri;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class RegisterAntrian extends PasienDataController{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        
    }
    public function index(){
        $request = $this->request;
        return view('pages.register_antrian.index');
    }
    public function create(){
        $request = $this->request;
    }
    public function store(){
        $request = $this->request;
        $ppasien = $request->only("name",'alamat','telepon');
        $antri = $request->only("keperluan");
        $antri['nomor'] = $this->generateAntri();
        $pasien  = new Pasien();
        $ppasien['nomor_rekam'] = "mengantri";
        $pasien->fill($ppasien);
        $pasien->save();
        $antri['pasien_id'] = $pasien->id;
        $antri['status'] = '0';
        $antri['diproses_oleh'] = 0;
        $antrien = new Antri();
        $antrien->fill($antri);
        $antrien->save();
        return view("pages.register_antrian.cetak",compact("pasien","antrien"));


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
