@extends("index")
@section("title","Data User")
@section("content")
    <div class="row">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data user Antrian</h3>
                    <div class="card-tools">
                        <a href="{{route('user.create')}}" class="btn btn-sm btn-primary">Buat user</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>Hak Akses</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user as $key => $value)
                                        <tr>
                                            <td>{{$value->email}}</td>
                                            <td>{{$value->name}}</td>
                                            <td>{{$value->level=='kasir'?'Helpdesk':$value->level}}</td>
                                            <td>
                                                <form id='dlid{{$value->id}}' action="{{route('user.destroy',['user'=>$value->id])}}" method="POST">
                                                    <delete></delete>
                                                    <auth></auth>
                                                </form>
                                                <a href="{{route('user.edit',['user'=>$value->id])}}" title='edit' class="btn btn-sm btn-success">
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
