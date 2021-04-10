@extends("index")
@section("title","Ubah User")
@section("content")
    <div class="row justify-content-center">
        <div class="col-5">
            <form class="card" method='POST' action="{{route('user.store')}}">
                <auth></auth>
                <div class="card-header">
                    <h3 class="card-title">Ubah Data User</h3>
                    <div class="card-tools">
                        <a href="{{route('user.index')}}" class="btn btn-sm btn-success">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class='form-group'>
                        <label for='mail'>Email</label>
                        <input value='{{ $data->email }}' required placeholder='Input Email' type='email' class='form-control' id='mail' name='email'>
                    </div>
                    <div class='form-group'>
                        <label for='name'>Nama</label>
                        <input value='{{ $data->name }}' required placeholder='Input Nama' type='text' class='form-control' id='name' name='name'>
                    </div>
                    <div class='form-group'>
                        <label for='level'>Hak Akses</label>
                        <select required class='form-control' name='level' id='level'>
                            <option  value=''>Pilih Hak Akses</option>
                            <option {{ $data->level==="kasir"?"selected":"" }} value='kasir'>Kasir/Helpdesk</option>
                            <option {{ $data->level==="antrian"?"selected":"" }} value='antrian'>Display Antrian</option>
                            <option {{ $data->level==="admin"?"selected":"" }} value='admin'>Administrator Sistem</option>

                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>

        </div>
    </div>
@endsection
