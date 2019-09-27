@extends('admin.layouts.app')
@section('title')
Periode Akademik
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/responsive.jqueryui.min.css') }}">
@endsection
@section('atas')
  <ul class="breadcrumb">
                      <li><a href="#">Pengaturan</a></li>
                      <li class="active">Periode Akademik</li>

                  </ul>
@endsection
@section('content')
  <div class="col-md-12">

                              <!-- START DATATABLE EXPORT -->
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">@yield('title')</h3>
                                      <ul class="panel-controls">
                                        <li><a href="#" class="panel" data-toggle="tooltip" data-placement="top" title="Tambah Data"><span class="fa fa-plus"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                    </ul>
                                      <div class="btn-group pull-right">
                                          <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                          <ul class="dropdown-menu">


                                              <li><a href="#" onClick ="$('#akademik').tableExport({type:'excel',escape:'false'});"><img src='{{asset('img/icons/xls.png')}}' width="24"/> XLS</a></li>
                                              <li><a href="#" onClick ="$('#akademik').tableExport({type:'doc',escape:'false'});"><img src='{{asset('img/icons/word.png')}}' width="24"/> Word</a></li>
                                              <li><a href="#" onClick ="$('#akademik').tableExport({type:'powerpoint',escape:'false'});"><img src='{{asset('img/icons/ppt.png')}}' width="24"/> PowerPoint</a></li>
                                              <li><a href="#" onClick ="$('#akademik').tableExport({type:'pdf',escape:'false'});"><img src='{{asset('img/icons/pdf.png')}}' width="24"/> PDF</a></li>
                                          </ul>
                                      </div>

                                  </div>
                                  <div class="panel-body">
                                      <table id="akademik" class="table" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>No</th>
                                                  <th>Kode</th>
                                                  <th>Nama</th>
                                                  <th>Keterangan</th>
                                                  <th>Tanggal Mulai</th>
                                                  <th>Tanggal Selasai</th>
                                                  <th>Dibuat</th>
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



                          </div>
@endsection
@section('js')
  <script type="text/javascript" src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/plugins/datatables/dataTables.responsive.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/plugins/tableexport/tableExport.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/tableexport/jquery.base64.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/tableexport/html2canvas.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/tableexport/jspdf/libs/sprintf.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/tableexport/jspdf/jspdf.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/tableexport/jspdf/libs/base64.js')}}"></script>
@endsection
@section('script')
<script type="text/javascript">
var table=  $('#akademik').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
            paging: true,
            pageLength:5,
      ajax: {
          url: '{{route('api.akademik')}}',
          method: 'POST'
      },

      columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'kode', name: 'kode'},
          {data: 'name', name: 'name',orderable: false},
          {data: 'ket', name: 'ket',orderable: false},
          {data: 'start_date', name: 'start_date',orderable: false},
          {data: 'end_date', name: 'end_date',orderable: false},
          {data: 'created_by', name: 'created_by',orderable: false},
          {data: 'status', name: 'status',orderable: false},

           {data: 'action', name: 'action', orderable: false, searchable: false}

      ],

  });
</script>
@endsection
