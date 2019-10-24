@extends('admin.layouts.app')
@section('title')
Realisasi Mengajar
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/responsive.jqueryui.min.css') }}">

<link rel="stylesheet" href="{{asset('clockpicker.css')}}">
<link rel="stylesheet" href="{{asset('alert/css/alertify.min.css')}}">
@endsection
@section('atas')

@endsection
@section('content')

@endsection
@section('modal')
<div class="modal" id="tambah" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">

       </div>
    </div>
    </div>
@endsection
@section('js')

<script type="text/javascript" src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/datatables/dataTables.responsive.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-select.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('select2/dist/js/select2.full.min.js') }}" charset="utf-8"></script>

 <script type="text/javascript" src="{{asset('js/plugins/tableexport/tableExport.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/tableexport/jquery.base64.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/tableexport/html2canvas.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/tableexport/jspdf/libs/sprintf.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/tableexport/jspdf/jspdf.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/tableexport/jspdf/libs/base64.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-select.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-timepicker.min.js')}}"></script>
<script src="{{ asset('select2/dist/js/select2.full.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('alert/alertify.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('clockpicker.js') }}" charset="utf-8"></script>
@endsection
@section('script')
<script>
$("#tambah").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-content").load(link.attr("href"));
});
</script>
@endsection
