@extends('admin.layouts.app')
@section('title')
Buat Jadwal
@endsection
@section('css')
  <link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('clockpicker.css')}}">

@endsection
@section('atas')
  <ul class="breadcrumb">
      <li><a href="#">Akademik</a></li>
      <li class="active">Buat Jadwal</li>
  </ul>
@endsection
@section('content')
  <div class="col-md-12">

                              <form class="form-inline" action="{{ route('jadwal.store') }}" method="post">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">@yield('title') Periode Akademik {{ $akademik->name }}</h3>
                                      <ul class="panel-controls">
                                      </ul>
                                  </div>
                                  <div class="panel-body">
                              <p>Silahkan Klik <b>+ Field</b> untuk memasukan lebih dari 1 data</p>
                              <p> Pastikan Kembali Jam Mulai Tidak lebih besar dari jam akhir matakuliah gunakan format waktu <b>24 jam</b> contoh <b>02:30 - 13:00</b></p>
                                                                  </div>
                                  <div class="panel-body multi-field-wrapper">
                                    <div class="multi-fields">

                                      <div class="tambah row">
                                        <div class="multi-field">
                                          <input type="hidden" name="akademik[]" value="{{ $akademik->uuid }}">
                                        <div class="form-group mr-2">
                                          <select required class="form-control " name="mk[]" data-placeholder="Matakuliah" required>
                                             <option value=""></option>
                                            @foreach ($mk as $key)
                                              <option value="{{ $key->uuid }}">{{ $key->kode.' - '.$key->name }}</option>
                                            @endforeach
                                          </select>
                                            </div>
                                            <div class="form-group mr-2">
                                              <select required class="form-control " name="dosen[]" >
                                                <option value=""></option>
                                                @foreach ($dosen as $key)
                                                  <option value="{{ $key->uuid }}">{{ $key->name }}</option>
                                                @endforeach
                                              </select>                                            </div>
                                            <div class="form-group mr-2">
                                              <select required class="form-control " name="hari[]">
                                                  <option value=""></option>
                                                <option value="Senin">Senin</option>
                                                <option value="Selasa">Selasa</option>
                                                <option value="Rabu">Rabu</option>
                                                <option value="Kamis">Kamis</option>
                                                <option value="Jumaat">Jumaat</option>
                                                <option value="Sabtu">Sabtu</option>
                                                <option value="Minggu">Minggu</option>
                                              </select>                                            </div>
                                            <div class="form-group mr-2">
                                              <select required class="form-control " name="kelas[]">
                                                  <option value=""></option>
                                                @foreach ($kelas as $key)
                                                  <option value="{{ $key->uuid }}">{{ $key->name }}</option>
                                                @endforeach
                                              </select>                                            </div>
                                            <div class="form-group mr-2">
                                              <input required type="text" class="mask_jam form-control" id="" placeholder="Jam Mulai" name="start[]">
                                            </div>
                                            <div class="form-group mr-2">
                                              <input required type="text" class="mask_jam form-control" id="" name="end[]" placeholder="jam akhir">
                                            </div>
<hr/>

                                        </div>
                                      </div>

                                    </div>
                                    <button type="button" class="add-field btn btn-primary pull-right" id='add'>+ Field</button>
                                    <button type="button" class="btn btn-danger pull-right" id='remove'>- Hapus</button>

                                  </div>
                                  <div class="panel-footer">
                                      <button class="btn btn-default">Clear Form</button>
                                      <button class="btn btn-primary pull-right">Submit</button>
                                  </div>
                              </div>
                              @csrf
                              </form>

                          </div>
@endsection
@section('js')
  <script src="{{ asset('select2/dist/js/select2.full.min.js') }}" charset="utf-8"></script>
  <script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-select.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-timepicker.min.js')}}"></script>
  <script src="{{ asset('clockpicker.js') }}" charset="utf-8"></script>
   <script type='text/javascript' src='{{asset('js/plugins/maskedinput/jquery.maskedinput.min.js')}}'></script>

@endsection
@section('script')
<script type="text/javascript">
$('.select2').select2({
  width: '250%'
});
var input = $('.jam').clockpicker({
    placement: 'bottom',
    align: 'right',
    autoclose: true,
    'default': 'now'
});
function checkRemove() {
    if ($('div.tambah').length == 1) {
        $('#remove').hide();
    } else {
        $('#remove').show();
    }
};
$(document).ready(function() {
    checkRemove()
    $('#add').click(function() {
        $('div.tambah:last').after($('div.tambah:first').clone());
        checkRemove();
    });
    $('#remove').click(function() {
        $('div.tambah:last').remove();
        checkRemove();
    });
});
// window.onload = function(){
//   moreFields;
// };
// $('.multi-field-wrapper').each(function() {
//   var $wrapper = $('.multi-fields', this);
//   $(".add-field", $(this)).click(function(e) {
//     $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val(' ').focus();
//   });
//   $('.multi-field .remove-field', $wrapper).click(function() {
//       if ($('.multi-field', $wrapper).length > 1)
//           $(this).parent('.multi-field').remove();
//   });
// });
</script>
@endsection
