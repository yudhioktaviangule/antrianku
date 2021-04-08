<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{config('app.name')}}</title>
        <link href="{{asset('antrian/css/styles.css')}}" rel="stylesheet" />
        <link href="{{asset('css/app.css')}}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header bg-primary text-light"><h3 class="text-center font-weight-light my-4">Register Nomor Antrian</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Nama Lengkap</label>
                                                        <input class="form-control py-4" id="inputFirstName" name="name" type="text" placeholder="Nama Lengkap" />
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Alamat</label>
                                                        <input class="form-control py-4" id="inputFirstName" name="alamat" type="text" placeholder="Alamat" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputFirstName">Telepon</label>
                                                <input class="form-control py-4" maxlength=12 id="inputFirstName" name="telepon" type="text" placeholder="+62" />
                                            </div>

                                            <div class="form-group">
                                                <div class='form-group'>
                                                    <label for='keperluan'>Keperluan</label>
                                                    <input required placeholder='Input Keperluan' type='text' class='form-control' id='keperluan' name='keperluan'>
                                                </div>
                                            </div>
                               
                                            <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" href="login.html">Buat Antrian</button></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('antrian/js/scripts.js')}}"></script>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
