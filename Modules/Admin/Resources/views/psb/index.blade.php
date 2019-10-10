@extends('admin.layouts.app')
@section('title')
PMB
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
      <li><a href="#">Akademik</a></li>
      <li class="active">PMB</li>
  </ul>
@endsection
@section('content')
  <div class="row">
<div class="col-md-6">

                             <!-- START BASIC TABLE SAMPLE -->
                             <div class="panel panel-default">
                                 <div class="panel-heading">
                                     <h3 class="panel-title">List Pendaftar</h3>
                                     <ul class="panel-controls">
                                          <li><a data-toggle="modal" data-target="#psb" class="panel" data-toggle="tooltip" data-placement="top" title="Tambah data" ><span class="fa fa-plus"></span></a></li>
                                          <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                      </ul>
                                 </div>
                                 <div class="panel-body">
                                     <p>    1. Minimal Lulus SMU atau sederajat tanpa batas tahun ijazah<br/>
                                            2. Fotokopi KTP atau SIM 2 lembar<br/>
                                            3. Fotokopi Ijazah (STTB) / STK yang dilegalisir 2 Lembar. Stempel sekolah harus asli (tidak boleh di fotokopi)<br/>
                                               Jika tidak memiliki legalisir asli, silahkan tunjukan ijazah asli.<br/>
                                            4. Pas Foto berwarna 3x4 = 2 Lembar<br/>
                                            5. Formulir Pendaftaran Rp.150.000,-</p>
                                     <table class="table">
                                         <thead>
                                             <tr>
                                                 <th>No</th>
                                                 <th>Jenis</th>
                                                 <th>Jumlah</th>

                                             </tr>
                                         </thead>
                                         <tbody>
                                             <tr>
                                                 <td>1</td>
                                                 <td>Baru</td>
                                                 <td>{{ $baru }}</td>

                                             </tr>
                                             <tr>
                                                 <td>2</td>
                                                 <td>Pindahan</td>
                                                 <td>{{ $pindahan }}</td>

                                             </tr>
                                             <tr>
                                                 <td>3</td>
                                                 <td>Alumni</td>
                                                 <td>{{ $alumni }}</td>

                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                             <!-- END BASIC TABLE SAMPLE -->

</div>
<div class="col-md-6">

                           <!-- START STRIPED TABLE SAMPLE -->
                           <div class="panel panel-default">
                               <div class="panel-heading">
                                   <h3 class="panel-title">Gelombang PSB</h3>
                                   <ul class="panel-controls">
                                        <li><a data-toggle="modal" data-target="#modal_basic" class="panel" data-toggle="tooltip" data-placement="top" title="Tambah data" ><span class="fa fa-plus"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                    </ul>
                               </div>
                               <div class="panel-body table-responsive">

                                   <table class="table table-striped datatable_simple">
                                       <thead>
                                           <tr>
                                             <th>No</th>
                                               <th>Kode</th>
                                               <th>Nama</th>
                                               <th>Periode Akademik</th>
                                               <th>Prefix</th>
                                               <th>Status</th>
                                               <th>Dibuat</th>
                                               <th>#</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                         @php
                                           $no=1;
                                         @endphp
                                             @foreach ($gelombang as $key )
                                               <tr>
                                                 <td>{{ $no++ }}</td>
                                                 <td>{{ $key->kode }}</td>
                                                 <td>{{ $key->name }}</td>
                                                 <td>{{ $key->nama_akademik }}</td>
                                                 <td>{{ $key->prefix }}</td>
                                                 @if ($key->status==1)
                                                    <td>   <span class="label label-success">Active</span></td>

                                                 @else
                                                  <td>   <span class="label label-danger">Non active</span></td>
                                                 @endif
                                                 <td>{{ $key->created_by }}</td>
                                                 <td><div class="btn-group">
                                                 <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle"><i class="fa fa-bars"></i>Option</a>
                                                   <ul class="dropdown-menu" role="menu">
                                                   <li><a data-toggle="modal" data-target="#edit-{{ $key->uuid }}">Ubah</a></li>

                                                     </ul>
                                                     </div></td>
                                                     <div class="modal" id="edit-{{ $key->uuid }}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                                                                 <div class="modal-dialog">
                                                                     <div class="modal-content">
                                                                         <div class="modal-header">
                                                                             <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                             <h4 class="modal-title" id="defModalHead">Edit Gelombang PSB</h4>
                                                                         </div>
                                                                         <div class="modal-body">
                                                                             <form class="form-group" action="{{ route('psb.update',[$key->uuid])}}" method="post">
                                                                          <div class="form-group">
                                                                            <label for="">Nama </label>
                                                                            <input type="text" value="{{ $key->name }}" name="nama" id="xx" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase();">
                                                                          </div>
                                                                          <div class="form-group">
                                                                            <label for="">Periode Akademik</label>
                                                                            <select required class="form-control select" name="akademik">
                                                                              <option value=""></option>
                                                                              @foreach ($akademik as $i )
                                                                                <option value="{{ $i->uuid }}" {{ ($i->uuid==$key->akademik_uuid)?"selected":"" }}>{{ $i->kode.' - '.$i->name }}</option>
                                                                              @endforeach
                                                                            </select>
                                                                      </div>
                                                                          <div class="form-group">
                                                                            <label for="">Prefix</label>
                                                                            <input type="text" required name="prefix" value="{{ $key->prefix }}" class="form-control" placeholder="" aria-describedby="helpId">
                                                                          </div>
                                                                          <div class="form-group">
                                                                            <label for="">Status</label>
                                                                            <select class="form-control select" name="status">
                                                                              @if ($key->status==1)
                                                                                <option value="1" selected>Active</option>
                                                                                <option value="0">Non Active</option>
                                                                              @else
                                                                                  <option value="1">Active</option>
                                                                                <option value="0" selected>Non Active</option>
                                                                              @endif
                                                                            </select>
                                                                          </div>

                                                                         </div>
                                                                         <div class="modal-footer">
                                                                             <button type="submit" class="btn btn-default">Update</button>
                                                                         </div>
                                                                         @csrf
                                                                         @method('PUT')
                                                                         </form>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                             @endforeach
                                           </tr>
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                           <!-- END STRIPED TABLE SAMPLE -->
                           <div class="modal" id="modal_basic" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                                       <div class="modal-dialog">
                                           <div class="modal-content">
                                               <div class="modal-header">
                                                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                   <h4 class="modal-title" id="defModalHead">Gelombang PSB</h4>
                                               </div>
                                               <div class="modal-body">
                                                   <form class="" action="{{ route('psbgelombang.store') }}" method="post">
                                                <div class="form-group">
                                                  <label for="">Nama </label>
                                                  <input type="text" required name="nama" id="xx" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase();">
                                                </div>
                                                <div class="form-group">
                                                  <label for="">Periode Akademik</label>
                                                  <select required class="form-control select" name="akademik">
                                                    <option value=""></option>
                                                    @foreach ($akademik as $key )
                                                      <option value="{{ $key->uuid }}">{{ $key->kode.' - '.$key->name }}</option>
                                                    @endforeach
                                                  </select>
                                            </div>
                                                <div class="form-group">
                                                  <label for="">Prefix</label>
                                                  <input type="text" required name="prefix" id="xx" class="form-control" placeholder="" aria-describedby="helpId">
                                                </div>


                                               </div>
                                               <div class="modal-footer">
                                                   <button type="submit" class="btn btn-default">Simpan</button>
                                               </div>
                                               @csrf
                                               </form>
                                           </div>
                                       </div>
                                   </div>
                                  <div class="modal" id="psb"   role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                                               <div class="modal-dialog">
                                                   <div class="modal-content">
                                                       <div class="modal-header">
                                                           <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                           <h4 class="modal-title" id="defModalHead">Entri PSB</h4>
                                                       </div>
                                                       <div class="modal-body">
                                                           <form class="" action="{{ route('psb.store') }}" method="post">
                                                             <div class="form-group">
                                                               <label for="">NIK</label>
                                                               <input type="text" name="nik" id="xx" class="form-control" placeholder="NIK" onkeypress="return angka(event)" maxlength="16" required>
                                                             </div>
                                                        <div class="form-group">
                                                          <label for="">Nama Lengkap</label>
                                                          <input type="text" name="nama" id="xx" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase();" required>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Gelombang</label>
                                                            <select required class="form-control select" name="gelombang">
                                                                <option value=""></option>
                                                              @foreach ($gelombang as $key)

                                                                <option value="{{ $key->uuid }}">{{ $key->nama_akademik }}</option>
                                                              @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Jenis</label>
                                                            <select required class="form-control select2" name="jenis">
                                                              <option value="Baru">Baru</option>
                                                              <option value="Pindahan">Pindahan</option>
                                                              <option value="Alumni">Alumni</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Tempat Lahir</label>
                                                          <select required class="form-control select2" name="tempatlahir">
                                                            <option value=""></option>
                                                            @foreach (\Indonesia::allCities() as $key )
                                                              <option value="{{ $key->name }}">{{ $key->name }}</option>
                                                            @endforeach
                                                          </select>
                                                    </div>

                                                        <div class="form-group">
                                                          <label for="">Agama</label>
                                                          <select class="form-control select" name="agama">
                                                            <option value="Islam">Islam</option>
                                                            <option value="Kristen">Kristen</option>
                                                            <option value="Protestan">Protestan</option>
                                                            <option value="Hindu">Hindu</option>
                                                            <option value="Budha">Budha</option>
                                                          </select>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Tanggal Lahir</label>
                                                          <input type="text" name="tgl_lahir" id="xx" class="form-control datepicker" placeholder="" aria-describedby="helpId" required>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Telpon</label>
                                                          <input type="text" name="tlp" onkeypress="return angka(event)" class="form-control" placeholder="" aria-describedby="helpId" required maxlength="12">
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Email</label>
                                                          <input type="email" name="email" id="xx" class="form-control" placeholder="" aria-describedby="helpId" required maxlength="12">
                                                        </div>

                                                       </div>
                                                       <div class="modal-footer">
                                                           <button type="submit" class="btn btn-default">Simpan</button>
                                                       </div>
                                                       @csrf
                                                       </form>
                                                   </div>
                                               </div>
                                             </div>

                       </div>
</div>
<div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">Periode Akademik</h3>
                                    <ul class="panel-controls">
                                         <li><a data-toggle="modal" data-target="#akademik" class="panel" data-toggle="tooltip" data-placement="top" title="Tambah data" ><span class="fa fa-plus"></span></a></li>
                                         <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                     </ul>
                                </div>

                                <div class="panel-body panel-body-table">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions datatable">
                                            <thead>
                                                <tr>
                                                    <th width="50">no</th>
                                                    <th width="100">Nama</th>
                                                    <th width="100">Kode</th>
                                                    <th width="100">Keterangan</th>
                                                    <th width="150">Tanggal Mulai</th>
                                                    <th width="150">Tanggal Berakhir</th>
                                                    <th width="150">Status</th>
                                                    <th width="50">#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                  @php
                                                    $no=1;
                                                  @endphp
                                                  @foreach ($allakademik as $key)
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $key->name }}</td>
                                                    <td>{{ $key->kode }}</td>
                                                    <td>{{ $key->ket }}</td>
                                                    <td>{{ tgl_indo($key->start_date) }}</td>
                                                    <td>{{ tgl_indo($key->end_date) }}</td>
                                                    @if ($key->status==1)
                                                       <td>   <span class="label label-success">Active</span></td>

                                                    @else
                                                     <td>   <span class="label label-danger">Non active</span></td>
                                                    @endif
                                                    <td>
                                                        <button class="btn btn-default btn-rounded btn-sm" data-toggle="modal" data-target="#edit-{{ $key->uuid }}"><span class="fa fa-pencil"></span></button>

                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="edit-{{ $key->uuid }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="">Edit</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <form class="form-group" action="{{ route('akademik.update',[$key->uuid]) }}" method="post">
                                                          @csrf
                                                          @method('PUT')
                                                          <div class="form-group">
                                                            <label for="">Kode</label>
                                                            <input type="text" class="form-control" id="" required value="{{ $key->kode }}" name="kode">

                                                          </div>
                                                          <div class="form-group">
                                                            <label for="">Nama</label>
                                                            <input type="text" class="form-control" id="" value="{{ $key->name }}" name="nama">

                                                          </div>
                                                          <div class="form-group">
                                                            <label for="">Keterangan</label>
                                                            <input type="text" class="form-control" id="" value="{{ $key->ket }}" name="ket">

                                                          </div>
                                                          <div class="form-group">
                                                            <label for="">Tanggal Mulai</label>
                                                            <input type="text" class="form-control datepicker" name="start_date" value="{{ $key->start_date }}">

                                                          </div>
                                                          <div class="form-group">
                                                            <label for="">Tanggal Berakhir</label>
                                                            <input type="text" class="form-control datepicker" name="end_date" value="{{ $key->end_date }}">

                                                          </div>
                                                          <div class="form-group">
                                                            <label for="">Status</label>
                                                            <select class="form-control select" name="status">
                                                            @if ($key->status==1)
                                                              <option value="1" selected>Active</option>
                                                              <option value="0">Non Active</option>
                                                            @else
                                                                <option value="1">Active</option>
                                                              <option value="0" selected>Non Active</option>
                                                            @endif
                                                          </select>
                                                          </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                  </div>
                                                </div>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="modal fade" id="akademik" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="">Periode Akademik</h4>
                                      </div>
                                      <div class="modal-body">
                                        <form class="form-group" action="{{ route('akademik.store') }}" method="post">
                                          @csrf
                                          <div class="form-group">
                                            <label for="">Kode</label>
                                            <input type="text" class="form-control" id="" required placeholder="" name="kode">

                                          </div>
                                          <div class="form-group">
                                            <label for="">Nama</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="nama">

                                          </div>
                                          <div class="form-group">
                                            <label for="">Keterangan</label>
                                            <input type="text" class="form-control" id="" placeholder="" name="ket">

                                          </div>
                                          <div class="form-group">
                                            <label for="">Tanggal Mulai</label>
                                            <input type="text" class="form-control datepicker" name="start_date" placeholder="">

                                          </div>
                                          <div class="form-group">
                                            <label for="">Tanggal Berakhir</label>
                                            <input type="text" class="form-control datepicker" name="end_date" placeholder="">

                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                      </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                            </div>

                        </div>
                    </div>
@endsection
@section('js')
 <script type="text/javascript" src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
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



</script>
@endsection
