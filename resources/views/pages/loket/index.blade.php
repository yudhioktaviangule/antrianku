@extends("index")
@section("title","Data Loket")
@section("content")
    <div class="row">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Loket Antrian</h3>
                    <div class="card-tools">
                        <a href="{{route('loket.create')}}" class="btn btn-sm btn-primary">Buat Loket</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Loket Antrian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($loket as $key => $value)
                                        <tr>
                                            <td>{{$value->name}}</td>
                                            <td>
                                                <form id='dlid{{$value->id}}' action="{{route('loket.destroy',['loket'=>$value->id])}}" method="POST">
                                                    <delete></delete>
                                                    <auth></auth>
                                                </form>
                                                <a href="{{route('loket.edit',['loket'=>$value->id])}}" title='edit' class="btn btn-sm btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" onclick='
                                                    if(confirm("ingin menghapus data?")){
                                                        $("#dlid{{$value->id}}").submit()
                                                    }
                                                ' title='Hapus' class="btn btn-sm btn-danger">
                                                    <i class="fas fa-minus"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
@section("js")
@endsection
