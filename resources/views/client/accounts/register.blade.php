<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin-theme')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('admin-theme')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin-theme')}}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="#"><b>Admin</b>LTE</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name" name="name" value="{{old('name')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('name')
                    <i style="color: red;">{{$message}}</i><br>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="" value="{{old('email')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                    <i style="color: red;">{{$message}}</i><br>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                    <i style="color: red;">{{$message}}</i><br>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Phone" name="phone" id="" value="{{old('phone')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                        </div>
                    </div>
                    @error('phone')
                    <i style="color: red;">{{$message}}</i><br>
                    @enderror
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="avataUpload">
                            <label class="custom-file-label" for="exampleInputFile">Choose avata</label>
                        </div>
                        <!-- <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div> -->
                    </div>
                    @error('avataUpload')
                    <i class="mb-2" style="color: red;">{{$message}}</i><br>
                    @enderror
                    <div class="row">
                        <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div> -->
                        <!-- /.col -->
                        <!-- <div class="col-4"> -->
                        <button type="submit" class="btn btn-primary btn-block text-center">Register</button>
                        <!-- </div> -->
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="login.html" class="text-center">I already have a membership</a>
    </div> -->
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
        <!-- /.register-box -->

        <!-- jQuery -->
        <script src="{{asset('admin-theme')}}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('admin-theme')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('admin-theme')}}/dist/js/adminlte.min.js"></script>
        <!-- bs-custom-file-input -->
        <script src="{{asset('admin-theme')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <script>
            $(function() {
                bsCustomFileInput.init();
            });
        </script>
</body>

</html>