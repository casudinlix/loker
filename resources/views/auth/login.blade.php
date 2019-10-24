<!--A Design by W3layouts
   Author: W3layout
   Author URL: http://w3layouts.com
   License: Creative Commons Attribution 3.0 Unported
   License URL: http://creativecommons.org/licenses/by/3.0/
   -->
   <!DOCTYPE html>
   <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="robots" content="noindex,nofollow">
        <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon" />
      <head>
            <title>{{ config('app.name', 'Laravel') }} :: Login</title>
            <!-- Meta tags -->
         <meta name="viewport" content="width=device-width, initial-scale=1" />
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
         <link rel="stylesheet" href="{{asset('alert/css/alertify.min.css')}}">
         <script src="{{ asset('js/app.js') }}" defer></script>
         <meta name="csrf-token" content="{{ csrf_token() }}">
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">

         <script>
            addEventListener("load", function () { setTimeout(hideURLbar, 0); }, false); function hideURLbar() { window.scrollTo(0, 1); }
         </script>
         <!-- Meta tags -->
         <!--stylesheets-->
         <link href="{{asset('mhs/css/style.css')}}" rel='stylesheet' type='text/css' media="all">
         <!--//style sheet end here-->
         <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
      </head>
      <body id="app">
         <div class="mid-class">
            <div class="art-right-w3ls">
               <h2>Selamat Datang</h2>
               <form method="post" action="{{ route('login') }}">
                @csrf
                  <div class="main">
                     <div class="form-left-to-w3l">
                     <input type="text" name="email" placeholder="Email" required="" value="{{old('email')}}" autocomplete="false">
                     </div>
                     <div class="form-left-to-w3l ">
                        <input type="password" name="password" placeholder="Password" required="">
                        <div class="clear"></div>
                     </div>

                  </div>
                  <div class="left-side-forget">
                     <input type="checkbox" class="checked">
                     <span class="remenber-me">Remember me </span>
                  </div>
                  <div class="right-side-forget">
                    @if (Route::has('password.request'))
                                    <a class="btn btn-link for" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                  </div>
                  <div class="clear"></div>
                  <div class="btnn">
                     <button type="submit">Sign In</button>
                  </div>
               </form>


            </div>
            <div class="art-left-w3ls">
               <h1 class="header-w3ls">
                  {{config('app.name')}} V1.0.0
               </h1>
            </div>
         </div>
         <footer class="bottem-wthree-footer">
            <p>
               © {{date('Y')}} {{config('app.name')}}. All Rights Reserved | Design by
               <a href="http://www.W3Layouts.com" target="_blank">W3Layouts</a>
            </p>
         </footer>
         <script src="{{asset('alert/alertify.min.js')}}"></script>
         @error('email')

         <script type="text/javascript">
            alertify.error('Email / username / Password Salah !')
            </script>
     @enderror
     @error('password')
     <script type="text/javascript">
        alertify.error('Email / username / Password Salah !')
        </script>
    @enderror
      </body>
   </html>


