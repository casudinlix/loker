<form class="form-horizontal" action="{{ route('matakuliah.update',[$data->uuid]) }}" method="post">
  @csrf
  @method('PUT')
<div class="form-group">
  <label for="">Kurikulum</label>
  <select class="form-control select" name="kurikulum" required>
    <option value=""></option>
    @foreach ($kurikulum as $key)
      <option value="{{ $key->uuid }}" {{ ($key->uuid==$data->kurikulum_uuid)?"selected":"" }}>{{ $key->name }}</option>
    @endforeach
  </select>

</div>
<div class="form-group">
  <label for="">Kode</label>
  <input type="text" class="form-control"   value="{{ $data->kode }}" name="kode" required>

</div>
<div class="form-group">
  <label for="">Nama</label>
  <input type="text" class="form-control" value="{{ $data->name }}" name="nama" required>

</div>
<div class="form-group">
  <label for="">SKS</label>
  <input type="number" class="form-control" value="{{ $data->sks }}" name="sks" required>

</div>
<div class="form-group">
  <label for="">Semester</label>
  <input type="text" class="form-control" value="{{ $data->smt }}" name="smt" required>

</div>
<div class="form-group">
  <label for="">Status</label>
  <select class="form-control select" name="status">
    <option value="true" {{ ($data->status==true)?"selected":"" }}>Active</option>
    <option value="false" {{ ($data->status==false)?"selected":"" }}>Non Active</option>
  </select>

</div>
<div class="form-group pull-right">
   <button type="submit" class="btn btn-success" name="button">Simpan</button>

</div>

</form>

<script type="text/javascript">
  $(".select").selectpicker();
</script>
