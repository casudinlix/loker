@extends('admin.layouts.app')
@section('title')
KRS
@endsection
@section('css')
  <link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/responsive.jqueryui.min.css') }}">
  <link rel="stylesheet" href="{{asset('jquery.modal.min.css')}}">
@endsection
@section('atas')
  <ul class="breadcrumb">
      <li><a href="#">Akademik</a></li>
      <li class="active">Kurikulum</li>
  </ul>
@endsection
@section('content')
  <div class="col-md-12">

                              <!-- START DATATABLE EXPORT -->
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">KRS Mahasiswa</h3>
                                      <ul class="panel-controls">
                                           <li><a href="{{ route('dosen.create') }}" rel="modal:open" class="panel" data-toggle="tooltip" data-placement="top" title="Tambah data" ><span class="fa fa-plus"></span></a></li>
                                           <li><a href="#" class="panel-refresh" onclick="roloadkrs()"><span class="fa fa-refresh"></span></a></li>
                                       </ul>


                                  </div>
                                  <div class="panel-body">
                                      <table id="krs" class="table" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>No</th>

                                                  <th>No Transaksi </th>
                                                  <th>Periode Akademik</th>
                                                  <th>Mahasiswa</th>
                                                  <th>No Invoice </th>
                                                  <th>Total SKS</th>
                                                  <th>Status</th>
                                                  <th>Tanggal</th>

                                                  <th>#</th>
                                              </tr>
                                          </thead>
                                          <tbody>

                                          </tbody>

                                      </table>

                                  </div>
                              </div>
                              <!-- END DATATABLE EXPORT -->

                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">KRS Config</h3>
                                      <ul class="panel-controls">
                                           <li><a href="{{ route('config.krs') }}" rel="modal:open" class="panel" data-toggle="tooltip" data-placement="top" title="Tambah data" ><span class="fa fa-plus"></span></a></li>
                                           <li><a href="#" class="panel-refresh" onclick="reloadconfig()"><span class="fa fa-refresh"></span></a></li>
                                       </ul>


                                  </div>
                                  <div class="panel-body">
                                      <table id="krsconfig" class="table" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>No</th>

                                                  <th>Tahun Akademik </th>
                                                  <th>Tanggal Mulai</th>
                                                  <th>Tanggal Berakhir</th>

                                                  <th>Max SKS</th>
                                                  <th>Dibuat</th>
                                                  <th>Tanggal</th>

                                                  <th>#</th>
                                              </tr>
                                          </thead>
                                          <tbody>

                                          </tbody>

                                      </table>

                                  </div>
                              </div>

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
  var table=  $('#krs').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
            paging: true,
            pageLength:5,
      ajax: {
          url: '{{route('api.krs')}}',
          method: 'POST'
      },

      columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},

          {data: 'name', name: 'name',orderable: false},
          {data: 'nama_jurusan', name: 'jurusan.name',orderable: false},
          {data: 'created_by', name: 'created_by',orderable: false},
          {data: 'created_at', name: 'created_at',orderable: false,searchable: false},
          {data: 'status', name: 'status',orderable: false,searchable: false},


           {data: 'action', name: 'action', orderable: false, searchable: false}

      ],

  });
  var krsconfig=  $('#krsconfig').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      searchable: false,
      lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
            paging: true,
            pageLength:5,
      ajax: {
          url: '{{route('krs.config')}}',
          method: 'POST'
      },

      columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},

          {data: 'nama_akademik', name: 'nama_akademik',orderable: false,searchable: false},
          {data: 'start_date', name: 'start_date.name',orderable: false,searchable: false},
          {data: 'due_date', name: 'due_date',orderable: false},
          {data: 'max_sks', name: 'max_sks',orderable: false,searchable: false},
          {data: 'created_by', name: 'created_by',orderable: false,searchable: false},
          {data: 'created_at', name: 'created_at',orderable: false,searchable: false},
         {data: 'action', name: 'action', orderable: false, searchable: false}

      ],

  });
  function reloadconfig()
  {
    krsconfig.ajax.reload();
  }
  function roloadkrs()
  {
    table.ajax.reload();
  }
  </script>
@endsection
