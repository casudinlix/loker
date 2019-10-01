@extends('admin.layouts.app')
@section('title')
Mahasiswa
@endsection
@section('css')
  <link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/responsive.jqueryui.min.css') }}">
  <link rel="stylesheet" href="{{asset('jquery.modal.min.css')}}">
@endsection
@section('atas')
  <ul class="breadcrumb">
      <li><a href="#">Akademik</a></li>
      <li class="active">Mahasiswa</li>
  </ul>
@endsection
@section('content')
  <div class="col-md-12">

                              <!-- START DATATABLE EXPORT -->
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">@yield('title')</h3>

                                      <div class="btn-group pull-right">
                                          <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                          <ul class="dropdown-menu">


                                              <li><a href="#" onClick ="$('#mahasiswa').tableExport({type:'excel',escape:'false'});"><img src='{{asset('img/icons/xls.png')}}' width="24"/> XLS</a></li>
                                              <li><a href="#" onClick ="$('#mahasiswa').tableExport({type:'doc',escape:'false'});"><img src='{{asset('img/icons/word.png')}}' width="24"/> Word</a></li>
                                              <li><a href="#" onClick ="$('#mahasiswa').tableExport({type:'powerpoint',escape:'false'});"><img src='{{asset('img/icons/ppt.png')}}' width="24"/> PowerPoint</a></li>
                                              <li><a href="#" onClick ="$('#mahasiswa').tableExport({type:'pdf',escape:'false'});"><img src='{{asset('img/icons/pdf.png')}}' width="24"/> PDF</a></li>
                                          </ul>
                                      </div>

                                  </div>
                                  <div class="panel-body">
                                      <table id="mahasiswa" class="table" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>No</th>
                                                  <th>NIM</th>
                                                  <th>Nama Lengkap</th>
                                                  <th>Jurusan</th>
                                                  <th>Telpon</th>
                                                  <th>Angkatan</th>

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
@endsection
@section('script')

  <script type="text/javascript">
  var table=  $('#mahasiswa').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
            paging: true,
            pageLength:5,
      ajax: {
          url: '{{route('api.mhs')}}',
          method: 'POST'
      },

      columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'nim', name: 'mahasiswa.nim'},
          {data: 'name', name: 'users.name',orderable: false},
          {data: 'nama_jurusan', name: 'jurusan.name',orderable: false},
          {data: 'tlp', name: 'profile.tlp',orderable: false},
          {data: 'angkatan', name: 'mahasiswa.angkatan',orderable: false},


           {data: 'action', name: 'action', orderable: false, searchable: false}

      ],

  });
  </script>
@endsection
