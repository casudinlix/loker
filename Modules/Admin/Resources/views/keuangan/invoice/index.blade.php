@extends('admin.layouts.app')
@section('title')
Invoice
@endsection
@section('css')
  <link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/responsive.jqueryui.min.css') }}">

@endsection
@section('atas')
  <ul class="breadcrumb">
      <li><a href="#">Keuangan</a></li>
      <li class="active">Invoice</li>
  </ul>
@endsection
@section('content')
  <div class="col-md-12">

                              <!-- START DATATABLE EXPORT -->
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">@yield('title')</h3>
                                      <ul class="panel-controls">
                                           <li><a href="{{ route('invoice.create') }}" class="panel" data-toggle="tooltip" data-placement="top" title="Tambah data" ><span class="fa fa-plus"></span></a></li>
                                           <li><a href="#" class="panel-refresh" onclick="reloadconfig()"><span class="fa fa-refresh"></span></a></li>
                                       </ul>


                                  </div>
                                  <div class="panel-body">
                                      <table id="invoice" class="table" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>No</th>

                                                  <th>Invoice </th>
                                                  <th>Biaya </th>
                                                  <th>Periode Akademik </th>
                                                  <th>NIM </th>
                                                  <th>Nama</th>
                                                  <th>Tagihan</th>
                                                  <th>Potongan</th>
                                                  <th>Total</th>
                                                  <th>Dibuat</th>
                                                  <th>Due Date </th>
                                                  <th>Status </th>



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
var krsconfig=  $('#invoice').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,

    lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
          paging: true,
          pageLength:5,
    ajax: {
        url: '{{route('api.invoice')}}',
        method: 'POST'
    },

    columns: [
        {data: 'DT_RowIndex', orderable: false, searchable: false},

        {data: 'invoice_no', name: 'invoice.invoice_no',orderable: true},
        {data: 'nama_biaya', name: 'biaya.name',orderable: true},
        {data: 'nama_akademik', name: 'akademik.name',orderable: true},
        {data: 'nim', name: 'mahasiswa.nim',orderable: true},
        {data: 'name', name: 'users.name',orderable: true},
        {data: 'tagihan', name: 'invoice.total_amount',orderable: true},
        {data: 'potongan', name: 'invoice.potongan',orderable: true},
        {data: 'total_amount', name: 'invoice.total_amount',orderable: true},
        {data: 'created_by', name: 'created_by',orderable: true},

        {data: 'due_date', name: 'invoice.due_date',orderable: true},
        {data: 'status', name: 'invoice.status',orderable: true},

       {data: 'action', name: 'action', orderable: false, searchable: false}

    ],

});
function reloadconfig()
{
  krsconfig.ajax.reload();
}
</script>
@endsection
