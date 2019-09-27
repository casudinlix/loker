@extends('admin.layouts.app')

@section('content')
  <div class="login-container lightmode">

            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Log In</strong> to your account</div>
                    <form method="POST" action="{{ route('admin.login') }}" aria-label="{{ __('Login') }}" class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}"/>
                        </div>
                        <div class="col-md-6">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}"/>
                        </div>
                        <div class="col-md-6">
@csrf
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                          @if (Route::has('admin.password.request'))
                            <a href="{{ route('admin.password.request') }}" class="btn btn-link btn-block">Forgot your password?</a>

                          @endif
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block">Log In</button>
                        </div>
                    </div>



                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; {{date('Y')}} {{ config('app.name') }}
                    </div>
                    <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            </div>

        </div>

@endsection
