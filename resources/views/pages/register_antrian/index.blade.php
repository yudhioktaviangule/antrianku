@extends('content')
@section('content')
    <div class="col-lg-4 col-sm-6 col-md-6 col-10">
        <form class="card" method='POST' >
            @csrf
            <div class="card-header">
                <h3 class="card-title">Register Nomor Antrian</h3>
            </div>
            <div class="card-body">
                <div class='form-group'>
                    <label for='name'>Nama</label>
                    <input required placeholder='Input Nama' type='type' class='form-control' id='name' name='name'>
                </div>
                <div class='form-group'>
                    <label for='alamat'>Alamat</label>
                    <input required placeholder='Input Alamat' type='text' class='form-control' id='alamat' name='alamat'>
                </div>
                <div class='form-group'>
                    <label for='telepon'>No. Telepon</label>
                    <input required maxlength="15" placeholder='Input No. Telepon' type='text' class='form-control' id='telepon' name='telepon'>
                </div>
                <div class='form-group'>
                    <label for='telepon'>Keperluan</label>
                    <input required maxlength="15" placeholder='Input Keperluan' type='text' class='form-control' id='telepon' name='keperluan'>
                </div>
                
                <div class='form-group'>
                    <button class="btn btn-sm btn-primary btn-block">Buat Antrian</button>
                </div>

            </div>
        </form>
    </div>
@endsection