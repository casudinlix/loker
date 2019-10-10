@extends('admin.layouts.app')
@section('title')
Jadwal Kuliah
@endsection
@section('css')
  <link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/responsive.jqueryui.min.css') }}">
  <link rel="stylesheet" href="{{asset('jquery.modal.min.css')}}">
  <link rel="stylesheet" href="{{asset('clockpicker.css')}}">

@endsection
@section('atas')
  <ul class="breadcrumb">
      <li><a href="#">Akademik</a></li>
      <li class="active">Jadwal</li>
  </ul>
@endsection
@section('content')
  <div class="col-md-12">

                              <!-- START DATATABLE EXPORT -->
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">@yield('title')</h3>
                                      <ul class="panel-controls">
                                           <li><a href="{{ route('jadwal.create') }}" rel="modal:open"  class="panel" data-toggle="tooltip" data-placement="top" title="Tambah data" ><span class="fa fa-plus"></span></a></li>
                                           <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                       </ul>
                                      <div class="btn-group pull-right">
                                          <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                          <ul class="dropdown-menu">


                                              <li><a href="#" onClick ="$('#jadwal').tableExport({type:'excel',escape:'false'});"><img src='{{asset('img/icons/xls.png')}}' width="24"/> XLS</a></li>
                                              <li><a href="#" onClick ="$('#jadwal').tableExport({type:'doc',escape:'false'});"><img src='{{asset('img/icons/word.png')}}' width="24"/> Word</a></li>
                                              <li><a href="#" onClick ="$('#jadwal').tableExport({type:'powerpoint',escape:'false'});"><img src='{{asset('img/icons/ppt.png')}}' width="24"/> PowerPoint</a></li>
                                              <li><a href="#" onClick ="$('#jadwal').tableExport({type:'pdf',escape:'false'});"><img src='{{asset('img/icons/pdf.png')}}' width="24"/> PDF</a></li>
                                          </ul>
                                      </div>

                                  </div>
                                  <div class="panel-body">
                                      <table id="jadwal" class="table" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>No</th>

                                                  <th>Periode Akademik </th>
                                                  <th>Matakuliah</th>

                                                  <th>Dosen</th>
                                                  <th>Mulai</th>
                                                  <th>Selesai</th>
                                                  <th>Ruangan</th>

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
  <script type="text/javascript" src="{{asset('jquery.modal.min.js')}}"></script>
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

  <script type="text/javascript">
  var table=  $('#jadwal').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
            paging: true,
            pageLength:5,
      ajax: {
          url: '{{route('api.jadwal')}}',
          method: 'POST'
      },

      columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},

          {data: 'nama_akademik', name: 'akademik.name',orderable: false},
          {data: 'nama_mk', name: 'mata_kuliah.name',orderable: false},
          {data: 'nama_dosen', name: 'dosens.name',orderable: false},
          {data: 'start', name: 'jadwal.start',orderable: false,searchable: false},
          {data: 'end', name: 'jadwal.end',orderable: false,searchable: false},
          {data: 'nama_kelas', name: 'kelas.name',orderable: false},


           {data: 'action', name: 'action', orderable: false, searchable: false}

      ],

  });
  </script>
@endsection
