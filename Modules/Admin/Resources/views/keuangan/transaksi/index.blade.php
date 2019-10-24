@extends('admin.layouts.app')
@section('title')
Transaksi
@endsection
@section('css')
  <link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables/responsive.jqueryui.min.css') }}">
{{-- <link rel="stylesheet" href="{{asset('jquery.modal.min.css')}}"> --}}
@endsection
@section('atas')
  <ul class="breadcrumb">
      <li><a href="#">Keuangan</a></li>
      <li class="active">Transaksi</li>
  </ul>
@endsection
@section('content')
<div class="row"
  <div class="col-md-12">

                              <!-- START DATATABLE EXPORT -->
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">@yield('title')</h3>
                                      {{-- <ul class="panel-controls">
                                           <li><a href="{{ route('invoice.create') }}" class="panel" data-toggle="tooltip" data-placement="top" title="Tambah data" ><span class="fa fa-plus"></span></a></li>
                                           <li><a href="#" class="panel-refresh" onclick="reloadconfig()"><span class="fa fa-refresh"></span></a></li>
                                       </ul> --}}


                                  </div>
                                  <div class="panel-body">
                                      <table id="transaksi" class="table" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>No</th>

                                                  <th>No Transaksi </th>
                                                  <th>No Invoice </th>
                                                  <th>Type Bayar </th>
                                                  <th>NIM </th>
                                                  <th>Nama</th>
                                                  <th>Total Bayar</th>


                                                  <th>Dibuat</th>
                                                  <th>Diupdate</th>
                                                  <th>Status </th>
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
</div>

@endsection
@section('modal')
  <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
  <div class="modal-dialog modal-lg">
     <div class="modal-content">

     </div>
  </div>
  </div>

  <div class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
  <div class="modal-dialog modal-lg ">
     <div class="modal-content">


     </div>
  </div>
  </div>
  <div class="modal" id="cetak" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
  <div class="modal-dialog modal-lg">
     <div class="modal-content">


     </div>
  </div>
  </div>
@endsection
@section('js')
  {{-- <script type="text/javascript" src="{{asset('jquery.modal.min.js')}}"></script> --}}

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
$("#myModal").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-content").load(link.attr("href"));
});
$("#edit").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-content").load(link.attr("href"));
});
$("#cetak").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-content").load(link.attr("href"));
});

var krsconfig=  $('#transaksi').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,

    lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
          paging: true,
          pageLength:5,
    ajax: {
        url: '{{route('api.transaksi')}}',
        method: 'POST'
    },

    columns: [
        {data: 'DT_RowIndex', orderable: false, searchable: false},

        {data: 'tran_no', name: 'transaksi.tran_no',orderable: true},
        {data: 'invoice_no', name: 'invoice.invoice_no',orderable: true},
        {data: 'type', name: 'type',searchable: false,orderable:false},
        {data: 'nim', name: 'mahasiswa.nim',orderable: true},
        {data: 'name', name: 'users.name',orderable: true},
        {data: 'total_bayar', name: 'transaksi.total_bayar',orderable: true},
        {data: 'created_by', name: 'transaksi.created_by',orderable: true},
        {data: 'updated_by', name: 'transaksi.updated_by',orderable: true},
        {data: 'status', name: 'transaksi.status',orderable: true},
        {data: 'created_at', name: 'transaksi.created_at',orderable: true},
       {data: 'action', name: 'action', orderable: false, searchable: false}

    ],

});
function reloadconfig()
{
  krsconfig.ajax.reload();
}
</script>
@endsection
