@extends('admin.layouts.app')
@section('title')
Tambah Invoice
@endsection
@section('css')
  <link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">
  <style media="screen">
  .select2 {
  width: 200px;
}
  </style>
@endsection
@section('atas')
  <ul class="breadcrumb">
      <li><a href="#">Keuangan</a></li>
      <li class="active">Invoice</li>
  </ul>
@endsection
@section('content')
  <div class="col-md-12">

                              <form class="form-horizontal" action="{{ route('invoice.store') }}" method="post">
                                @csrf
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">@yield('title')</h3>
                                      <ul class="panel-controls">
                                          <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                      </ul>
                                  </div>
                                  <div class="panel-body">
                                  </div>
                                  <div class="panel-body">

                                      <div class="row">

                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Biaya</label>
                                                <div class="col-md-9">
                                                    <select class="form-control select" data-live-search="true" name="biaya" required>
                                                      <option value=""></option>
                                                      @foreach ($biaya as $key)
                                                        <option value="{{ $key->uuid }}">{{ $key->name }}</option>
                                                      @endforeach
                                                    </select>
                                                 </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Angkatan</label>
                                                <div class="col-md-9">
                                                    <select class="form-control select" data-live-search="true" name="angkatan" required id="angkatan">
                                                      <option value=""></option>
                                                      @foreach ($angkatan as $key)
                                                        <option value="{{ $key->angkatan }}">{{ $key->angkatan }}</option>
                                                      @endforeach
                                                    </select>
                                                 </div>
                                            </div>


                                              <div class="form-group">
                                                  <label class="col-md-3 control-label">Keterangan</label>
                                                  <div class="col-md-9 col-xs-12">
                                                      <textarea class="form-control" rows="5" name="ket" required></textarea>

                                                  </div>
                                              </div>


                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Mahaiswa</label>
                                                <div class="col-md-9">
                                                    <select id="mhs" class="form-control select2" data-live-search="true" name="mhs[]" required multiple>
                                                    </select>
                                                 </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Jumlah</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control money" name="total_amount" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Batas Akhir Pembayaran</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="mask_date form-control" name="due_date" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Diskon</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control money" name="potongan" value="0">
                                                </div>
                                            </div>


                                          </div>

                                      </div>

                                  </div>
                                  <div class="panel-footer">
                                      <a class="btn btn-default" href="{{ route('invoice.index') }}">Kembali</a>
                                      <button class="btn btn-primary pull-right" type="submit">Simpan</button>
                                  </div>
                              </div>
                              </form>

                          </div>
@endsection
@section('js')
  <script src="{{ asset('select2/dist/js/select2.full.min.js') }}" charset="utf-8"></script>
  <script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-select.js')}}"></script>
 <script type='text/javascript' src='{{asset('js/plugins/maskedinput/jquery.maskedinput.min.js')}}'></script>
@endsection
@section('script')
  <script type="text/javascript">

      $(".select2").select2({
        allowClear: true,
        width: "resolve" ,

        placeholder:'Pilih'
      });

      $("#angkatan").change(function(event) {
        var id = $("#angkatan").val();
        //$('#angkatan').selectpicker('refresh');
        $("#angkatan").attr("disabled", true);

        $.ajax({
          url: '{{ url('admin/keuangan/get/mhs/') }}/'+id,
          type: 'GET',
          dataType: 'JSON',

          success:function(data)
          {


            $.each(data, function(key, value) {
              $('#mhs').selectpicker('refresh');
                //  console.log(value.id_kab);
                $('#mhs').append('<option value="' + value.uuid + '">' + value.nim+' '+value.name + '</option>');

            });
          },
          error:function()
          {
            $('#mhs').selectpicker('refresh');
          }
        })


      });
  </script>

@endsection
