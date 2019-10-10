@extends('admin.layouts.app')
@section('title')
Detail {{ $data->no_psb }}
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('alert/css/alertify.min.css')}}">
<style media="screen">
    .select2-container {
        width: 100% !important;
        padding: 0;
    }
</style>
@endsection
@section('atas')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">PMB</a></li>
    <li><a href="#" class="active">Daftar Ulang</a></li>

</ul>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal" action="{{ route('posting.psb') }}" method="post" enctype="multipart/form-data">

            @csrf

            <input type="hidden" name="angkatan" value="{{ $data->gelombang }}">
            <input type="hidden" name="uuid" value="{{ $data->uuid }}">
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Akademik</a></li>
                    <li><a href="#tab-second" role="tab" data-toggle="tab">Personal Data</a></li>
                    <li><a href="#pendidikan" role="tab" data-toggle="tab">Pendidikan</a></li>
                    <li><a href="#pekerjaan" role="tab" data-toggle="tab">Pekerjaan</a></li>
                    <li><a href="#wali" role="tab" data-toggle="tab">Orang Tua / Wali</a></li>
                    <li><a href="#lain" role="tab" data-toggle="tab">Lain - Lain</a></li>

                </ul>
                <div class="panel-body tab-content">
                    <div class="tab-pane active" id="tab-first">
                        <div class="row">
                            <input type="hidden" name="no_psb" value="{{ $data->no_psb }}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Kurikulum</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <select class="form-control select" name="kurikulum" required>
                                                <option value=""></option>
                                                @foreach ($kurikulum as $key )
                                                <option value="{{ $key->uuid }}">{{ $key->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Jurusan</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <select class="form-control select" name="jurusan" required>
                                                <option value=""></option>
                                                @foreach ($jurusan as $key )
                                                <option value="{{ $key->uuid }}">{{ $key->name }} - {{ $key->program_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Ukuran Almamater</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <select class="form-control select" name="suit_size" required>
                                                <option value=""></option>
                                                <option value="M">M</option>
                                                <option value="S">S</option>
                                                <option value="XL">XL</option>

                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>






                    </div>
                    <div class="tab-pane" id="tab-second">
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">NIK</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="nik" value="{{ $val->nik }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tanggal Lahir</label>
                                    <div class="col-md-9 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                            <input type="text" class="form-control datepicker" name="tgl_lahir" value="{{ $val->tgl_lahir }}" />
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tempat Lahir</label>
                                    <div class="col-md-9 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-road"></span></span>
                                            <input type="text" class="form-control" name="tempatlahir" value="{{ $val->tempatlahir }}" />
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Alamat Lengkap</label>
                                    <div class="col-md-9 col-xs-12">
                                        <textarea class="form-control" name="address"></textarea>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Foto</label>
                                    <div class="col-md-9">
                                        <input type="file" class="fileinput btn-primary" name="file" id="filename" title="Browse file" />

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Status Perkawinan</label>
                                    <div class="col-md-9">
                                        <select class="form-control select" name="merital_status" required>
                                            <option value=""></option>
                                            <option value="Kawin">Kawin</option>
                                            <option value="Tidak Kawin">Tidak Kawin</option>
                                            <option value="Berpisah">Berpisah</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Provinsi</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="prov" required id="prov">
                                            @foreach (\Indonesia::allProvinces() as $key )
                                            <option value="{{ $key->id }}">{{ $key->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Kecamatan</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="kec" required id="kec">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Lengkap</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="text" class="form-control" name="nama" value="{{ $val->nama }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Agama</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="agama">
                                            <option value="Islam" {{ ($val->agama=='Islam')? "selected":"" }}>Islam</option>
                                            <option value="Kristen" {{ ($val->agama=='Kristen')? "selected":"" }}>Kristen</option>
                                            <option value="Protestan" {{ ($val->agama=='Protestan')? "selected":"" }}>Protestan</option>
                                            <option value="Hindu" {{ ($val->agama=='Hindu')? "selected":"" }}>Hindu</option>
                                            <option value="Budha" {{ ($val->agama=='Budha')? "selected":"" }}>Budha</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nomor Telpon</label>
                                    <div class="col-md-9">
                                        <input type="text" name="tlp" value="{{ $val->tlp }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">

                                        <input type="email" name="email" value="{{ $val->email }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Jenis Kelamin</label>
                                    <div class="col-md-9">
                                        <select class="form-control select" name="sex" required>
                                            <option value=""></option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Golongan Darah</label>
                                    <div class="col-md-9">
                                        <select class="form-control select" name="blood_type" required>
                                            <option value=""></option>
                                            <option value="A">A</option>
                                            <option value="AB">AB</option>
                                            <option value="B">B</option>
                                            <option value="O">O</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Kab / Kota</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="kab" required id="kab">

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Kelurahan</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="kel" required id="kel">

                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>




                    </div>
                    <div class="tab-pane" id="pendidikan">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama sekolah</label>
                                    <div class="col-md-9">
                                      <input type="text" name="school_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Dari Tahun</label>
                                    <div class="col-md-9">
                                      <input type="text" name="start_year" class="form-control year">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Alamat Sekolah</label>
                                    <div class="col-md-9">
                                    <textarea name="school_address" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Jenjang</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="level">
                                          <option value="SMA">SMA</option>
                                          <option value="SMK">SMK</option>
                                          <option value="MA">MA</option>
                                          <option value="Pesantren">Pesantren</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Sampai Tahun</label>
                                    <div class="col-md-9">
                                      <input type="text" name="end_year" class="form-control year">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nomor Ijazah</label>
                                    <div class="col-md-9">
                                      <input type="text" name="ijazah_no" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="tab-pane" id="pekerjaan">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Perusahaan</label>
                                    <div class="col-md-9">
                                        <input type="text" name="company_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Bekerja Shift ?</label>
                                    <div class="col-md-9">
                                      <select class="form-control select" name="shifting">
                                        <option value=""></option>
                                        <option value="true">YA</option>
                                        <option value="false">TIDAK</option>
                                      </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Posisi</label>
                                    <div class="col-md-9">
                                        <input type="text" name="position" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Lama Bekerja</label>
                                    <div class="col-md-9">
                                        <input type="text" name="job_year" class="form-control" placeholder="1 bulan">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="wali">
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nama Ayah</label>
                                <div class="col-md-9">
                                    <input type="text" name="ayah" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Alamat</label>
                                <div class="col-md-9">
                                    <textarea name="address_parent" class="form-control"></textarea>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nama Ibu</label>
                                <div class="col-md-9">
                                    <input type="text" name="ibu" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Pekerjaan</label>
                                <div class="col-md-9">
                                    <input type="text" name="job" class="form-control">
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="lain">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">


                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary pull-right" type="submit">Simpan <span class="fa fa-floppy-o fa-right"></span></button>
                </div>
            </div>

        </form>

    </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-file-input.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-select.js')}}"></script>
<script type='text/javascript' src='{{asset('js/plugins/icheck/icheck.min.js')}}'></script>
<script src="{{ asset('select2/dist/js/select2.full.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('alert/alertify.min.js') }}" charset="utf-8"></script>
@endsection
@section('script')
<script type="text/javascript">
    $('.select2').select2({
        width: '100%',
    });


    $("#prov").change(function(event) {
        var id_prov = $("#prov").val();

        var id_kec = $('#kec').val();

        $.ajax({
            url: '{{url('api/v1/public/kota')}}/'+id_prov,
            type: 'get',
            dataType: 'json',
            cache: false,
            async: true,
            success: function(data) {
                $('select[name="kab"]').empty();



                $.each(data, function(key, value) {

                    //  console.log(value.id_kab);
                    $('select[name="kab"]').append('<option value="' + value.id + '">' + value.name + '</option>');

                });
                $("#kab").change(function(event) {
                    var id_kab = $(this).val();

                    $.ajax({
                        url: '{{url('api/v1/public/kecamatan')}}/'+id_kab,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            //console.log(data);
                            $('select[name="kec"]').empty();

                            $.each(data, function(key, value) {
                                //console.log(value);
                                $('select[name="kec"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                            $("#kec").change(function(event) {
                                /* Act on the event */
                                var id_kec = $(this).val();
                                $.ajax({
                                    url: '{{url('api/v1/public/kelurahan')}}/' + id_kec,
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(data) {
                                        $('select[name="kel"]').empty();
                                        $.each(data, function(key, value) {
                                            //console.log(value);
                                            $('select[name="kel"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                                        });
                                    }
                                })



                            });

                        }

                    })
                    //console.log(id_kab);
                });
                //console.log(data);
            }

        });

    });
</script>
@endsection
