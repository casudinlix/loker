<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <!-- META SECTION -->
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/theme-default.css')}}"/>
        <!-- EOF CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" href="{{asset('alert/css/alertify.min.css')}}"/>

    </head>
    <body>

        <div class="login-container">

            <div class="login-box animated fadeInDown">
                <div class="" ><h1 style="color: #b3c4e4;   width: 100%;height: 50px;  float: center; margin-bottom: 10px;">Loker MIC</h1></div>
                <div class="login-body">
                    <div class="login-title"><strong>Selamat Datang</strong></div>
                    <form action="{{ route('admin-login') }}" class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="email" name="email" value="{{ old('email') }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" placeholder="Password" name="password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                          @if (Route::has('admin.password.request'))
                            <a href="{{ route('admin.password.request') }}" class="btn btn-link btn-block">Lupa Password?</a>
                          @endif
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block" type="submit">Log In</button>
                        </div>
                    </div>
                    @csrf
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; {{ date('Y') }} {{ env('APP_NAME') }}
                    </div>

                </div>
            </div>

        </div>
<script src="{{asset('alert/alertify.min.js')}}"></script>

 @if ($errors->has('email') || $errors->has('username'))
	<script type="text/javascript">
	alertify.error('Email / username / Password Salah !')
	</script>
	@endif
  <script type="text/javascript">

  </script>
    </body>
</html>
