@extends('admin.layouts.app')
@section('title')
KRA List
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/responsive.jqueryui.min.css') }}">
@endsection
@section('atas')
  <ul class="breadcrumb">
      <li><a href="#">Keuangan</a></li>
      <li class="active">KRA</li>
  </ul>
@endsection
@section('content')
  <div class="col-md-12">

                              <!-- START DATATABLE EXPORT -->
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">@yield('title')</h3>

                                      <div class="panel-body">
		<form method="POST" id="search-form" class="form-inline" role="form">

			<div class="form-group">
				<label for="name">Kurikulum</label>
        <select class="form-control" name="kurikulum" id="kurikulum">
          <option value="">--</option>
          @foreach ($data as $key)
            <option value="{{ $key->uuid }}">{{ $key->name }}</option>
          @endforeach
        </select>
 			</div>


			<button type="submit" class="btn btn-primary">Filter</button>
		</form>
	</div>


                                  </div>
                                  <div class="panel-body">
                                      <table id="kra" class="table" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>No</th>
                                                  <th>Kode</th>
                                                  <th>Nama</th>
                                                  <th>Kurikulum</th>
                                                  <th>sks</th>
                                                  <th>Smt</th>
                                                  <th>Harga</th>
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
$('.select2').select2({
  width:'100%',
});
var oTable = $('#kra').DataTable({
        dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
            "<'row'<'col-xs-12't>>"+
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("kra.list") }}',
            method:'POST',
            data: function (d) {
                d.kurikulum = $('select[name=kurikulum]').val();

            }
        },
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'kode', name: 'kode'},
            {data: 'name', name: 'name',orderable: false},
              {data: 'nama_kurikulum', name: 'nama_kurikulum',orderable: false},
              {data: 'sks', name: 'sks',orderable: false},
              {data: 'smt', name: 'smt',orderable: false},
              {data: 'harga', name: 'harga',orderable: false},
            {data: 'status', name: 'status',orderable: false},

             {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#search-form').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>
@endsection
