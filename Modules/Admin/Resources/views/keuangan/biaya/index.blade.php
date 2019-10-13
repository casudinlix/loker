@extends('admin.layouts.app')
@section('title')
Biaya
@endsection
@section('css')
  <link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/responsive.jqueryui.min.css') }}">
  <link rel="stylesheet" href="{{asset('jquery.modal.min.css')}}">
@endsection
@section('atas')
  <ul class="breadcrumb">
      <li><a href="#">Keuangan</a></li>
      <li class="active">Biaya</li>
  </ul>
@endsection
@section('content')
  <div class="col-md-12">

                              <!-- START DATATABLE EXPORT -->
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">@yield('title')</h3>
                                      <ul class="panel-controls">
                                           <li><a href="{{ route('biaya.create') }}" rel="modal:open" class="panel" data-toggle="tooltip" data-placement="top" title="Tambah data" ><span class="fa fa-plus"></span></a></li>
                                           <li><a href="#" class="panel-refresh" onclick="reloadconfig()"><span class="fa fa-refresh"></span></a></li>
                                       </ul>


                                  </div>
                                  <div class="panel-body">
                                      <table id="biaya" class="table" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>No</th>

                                                  <th>Nama </th>
                                                  <th>Tipe</th>
                                                  <th>Dibuat</th>
                                                  <th>Tanggal </th>



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
var krsconfig=  $('#biaya').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,

    lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
          paging: true,
          pageLength:5,
    ajax: {
        url: '{{route('api.biaya')}}',
        method: 'POST'
    },

    columns: [
        {data: 'DT_RowIndex', orderable: false, searchable: false},

        {data: 'name', name: 'name',orderable: false},
        {data: 'type', name: 'type',orderable: false},
        {data: 'created_by', name: 'created_by',orderable: false},

        {data: 'created_at', name: 'created_at',orderable: false},

       {data: 'action', name: 'action', orderable: false, searchable: false}

    ],

});
function reloadconfig()
{
  krsconfig.ajax.reload();
}
</script>
@endsection
