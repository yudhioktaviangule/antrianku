@extends("index")
@section("title","Tambah Loket")
@section("content")
    <div class="row justify-content-center">
        <div class="col-5">
            <form class="card" method='POST' action="{{route('loket.store')}}">
                <auth></auth>
                <div class="card-header">
                    <h3 class="card-title">Input Data Loket</h3>
                    <div class="card-tools">
                        <a href="{{route('loket.index')}}" class="btn btn-sm btn-success">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class='form-group'>
                        <label for='name'>Loket</label>
                        <input required placeholder='Input Loket' type='text' class='form-control' id='name' name='name'>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>

        </div>
    </div>
@endsection
