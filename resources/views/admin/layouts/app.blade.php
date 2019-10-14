<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- META SECTION -->
        <title>Loker :: @yield('title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="robots" content="noindex,nofollow">
        <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon" />
        <!-- END META SECTION -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <script type="text/javascript">
        var  url='{{ env('APP_URL') }}';
        </script>
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/theme-default.css')}}"/>
        <!-- EOF CSS INCLUDE -->
        <link href="{{asset('toastr.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('alert/css/alertify.min.css')}}">
         @yield('css')
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top-fixed ">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
              @include('admin.layouts.patial.menuadmin')
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->

            <!-- PAGE CONTENT -->
            <div class="page-content">

                <!-- START X-NAVIGATION VERTICAL -->
              @include('admin.layouts.patial.header')
                <!-- END X-NAVIGATION VERTICAL -->

                <!-- START BREADCRUMB -->
              @yield('atas')
                <!-- END BREADCRUMB -->

                <div class="page-title">
                    <h2><span class="fa fa-arrow-circle-o-left"></span> @yield('title')</h2>
                </div>

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap animated fadeIn">

                  @yield('content')


                </div>
                <!-- END PAGE CONTENT WRAPPER -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
@yield('modal')
        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="{{asset('audio/alert.mp3')}}" preload="auto"></audio>
        <audio id="audio-fail" src="{{asset('audio/fail.mp3')}}" preload="auto"></audio>
        <!-- END PRELOADS -->

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{{asset('js/plugins/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/jquery/jquery-ui.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{ asset('alert/alertify.min.js') }}" charset="utf-8"></script>
         <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->

        <script type="text/javascript" src="{{asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
        @yield('js')
        <script type="text/javascript">
        function angka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode > 31 && (charCode < 48 || charCode > 57))

          return false;
          return true;
        };
        $(".money").on("keydown", function(e) {
var keycode = (event.which) ? event.which : event.keyCode;
if (e.shiftKey == true || e.ctrlKey == true) return false;
if ([8, 110, 39, 37, 46].indexOf(keycode) >= 0 || // allow tab, dot, left and right arrows, delete keys
(keycode == 190 && this.value.indexOf('.') === -1) || // allow dot if not exists in the value
(keycode == 110 && this.value.indexOf('.') === -1) || // allow dot if not exists in the value
(keycode >= 48 && keycode <= 57) || // allow numbers
(keycode >= 96 && keycode <= 105)) { // allow numpad numbers
// check for the decimals after dot and prevent any digits
var parts = this.value.split('.');
if (parts.length > 1 && // has decimals
  parts[1].length >= 2 && // should limit this
  (
    (keycode >= 48 && keycode <= 57) || (keycode >= 96 && keycode <= 105)
  ) // requested key is a digit
) {
  return false;
} else {
  if (keycode == 110) {
    this.value += ".";
    return false;
  }
  return true;
}
} else {
return false;
}
}).on("keyup", function() {
var parts = this.value.split('.');
parts[0] = parts[0].replace(/,/g, '').replace(/^0+/g, '');
if (parts[0] == "") parts[0] = "0";
var calculated = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
if (parts.length >= 2) calculated += "." + parts[1].substring(0, 2);
this.value = calculated;
if (this.value == "NaN" || this.value == "") this.value = 0;
});
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        });

        </script>
        <script src="{{asset('toastr.min.js')}}"></script>


        @toastr_render
        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/actions.js')}}"></script>
        <script type="text/javascript">

        </script>
        @yield('script')
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>
