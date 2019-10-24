@extends('layouts.app')
@section('title')
KRS {{akademikname()}}
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/responsive.jqueryui.min.css') }}">
@endsection
@section('atas')
<ul class="breadcrumb">
    <li><a href="#">Akademik</a></li>
    <li class="active">KRS</li>
</ul>
@endsection
@section('content')
<div class="col-md-12">

    <!-- START DATATABLE EXPORT -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">KRS Saya</h3>



        </div>
        <div class="panel-body">
            <table id="krs" class="table" width="100%">
                <thead>
                    <tr>
                        <th>No</th>

                        <th>Matakuliah </th>
                        <th>Periode Akademik</th>
                        <th>Hari</th>
                        <th>Waktu</th>
                        <th>Total SKS</th>
                        <th>Status</th>


                        <th>#</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>

        </div>
    </div>
    <!-- END DATATABLE EXPORT -->
@endsection
@section('modal')

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

@endsection
@section('script')
<script type="text/javascript">

    var table=  $('#krs').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
              paging: true,
              pageLength:10,
        ajax: {
            url: '{{route('krs.mhs')}}',
            method: 'POST'
        },

        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},

            {data: 'name' ,name: 'mk.name',orderable: false},
            {data: 'nama_akademik', name: 'akademik.name',orderable: false},
            {data: 'hari', name: 'jadwal.hari',orderable: false},
            {data: 'start', name: 'jadwal.start',orderable: false},

            {data: 'status', name: 'status',orderable: false,searchable: false},


             {data: 'action', name: 'action', orderable: false, searchable: false}

        ],

    });
    </script>
@endsection
