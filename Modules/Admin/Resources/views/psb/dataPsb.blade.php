@extends('admin.layouts.app')
@section('title')
Data PMB
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/responsive.jqueryui.min.css') }}">
<link rel="stylesheet" href="{{asset('alert/css/alertify.min.css')}}">
<link rel="stylesheet" href="{{asset('alert/css/themes/semantic.min.css')}}">
<style media="screen">
.select2-container {
  width: 100% !important;
  padding: 0;
}
</style>
@endsection
@section('atas')
  <ul class="breadcrumb">
      <li><a href="#">Akademik</a></li>
      <li class="">PMB</li>
      <li class="active">Data PMB</li>
  </ul>
@endsection
@section('content')
  <div class="row">

    <div class="col-md-12">

                           <!-- START STRIPED TABLE SAMPLE -->
                           <div class="panel panel-default">
                               <div class="panel-heading">
                                   <h3 class="panel-title">Data PMB</h3>
                                   
                               </div>
                               <div class="panel-body">

                                   <table class="table table-striped data">
                                       <thead>
                                           <tr>
                                             <th>No</th>
                                               <th>No PMB</th>
                                               <th>NIK</th>
                                               <th>Nama</th>
                                               <th>Lahir</th>
                                               <th>Agama</th>
                                               <th>Tanggal Lahir</th>
                                               <th>No Telpon</th>
                                               <th>email</th>
                                                <th>#</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                         @php
                                           $no=1;
                                         @endphp
                                             @foreach ($data as $key )
                                               <tr>
                                                 <td>{{ $no++ }}</td>
                                                 <td>{{ $key->no_psb }}</td>


                                                       @foreach (json_decode($key->data) as $item => $val)
                                                         <td>
                                                           @if ($item=='tgl_lahir')
                                                           {{ tgl_indo($val) }}
                                                         @else
                                                       {{ $val }}
                                                     @endif
                                                     </td>
                                                       @endforeach
                                                       <td><div class="btn-group">
                                                       <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
                                                         <ul class="dropdown-menu" role="menu">
                                                         <li><a href="{{ route('psb.show',[$key->uuid]) }}">Proses</a></li>
                                                           <li><a onclick="hapus('{{ $key->uuid }}')" >Hapus</a></li>
                                                           </ul>
                                                           </div></td>
                                             @endforeach
                                           </tr>
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
<script src="{{ asset('alert/alertify.min.js') }}" charset="utf-8"></script>
@endsection
@section('script')
<script type="text/javascript">
  $('.select2').select2({
    width:'100%',
  });

  function hapus($id)
  {
    var id=$id
    alertify.confirm('Hapus Calon Mahasiwa', 'Data Yang Dihapus tidak dapat di kembalikan', function(){
      $.ajax({
        url: '{{ route('delete.psb') }}',
        type: 'POST',
        dataType: 'JSON',
        data: {uuid:id },
        success:function(response){
          window.location.reload();
        alertify.success('Data Berhasil Di Hapus')
        },
        error:function(response){
          alertify.error('Error')
        }
      })


      },
    function(){ alertify.error('Cancel')
    });
  }
  $(".data").dataTable({
    processing: true,
      responsive: true,
        autoWidth: false,
          pageLength:5,
          lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
  });
</script>
@endsection
