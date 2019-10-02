<form class="form-horizontal" action="{{ route('matakuliah.store') }}" method="post">
  @csrf
<div class="form-group">
  <label for="">Kurikulum</label>
  <select class="form-control select" name="kurikulum" required>
    <option value=""></option>
    @foreach ($kurikulum as $key)
      <option value="{{ $key->uuid }}">{{ $key->name }}</option>
    @endforeach
  </select>

</div>
<div class="form-group">
  <label for="">Kode</label>
  <input type="text" class="form-control" id="" placeholder="Kode" name="kode" required>

</div>
<div class="form-group">
  <label for="">Nama</label>
  <input type="text" class="form-control" id="" placeholder="Nama" name="nama" required>

</div>
<div class="form-group">
  <label for="">SKS</label>
  <input type="number" class="form-control" id="" placeholder="SKS" name="sks" required>

</div>
<div class="form-group">
  <label for="">Semester</label>
  <input type="text" class="form-control" id="" placeholder="Semester" name="smt" required>

</div>
<div class="form-group pull-right">
   <button type="submit" class="btn btn-success" name="button">Simpan</button>

</div>

</form>

<script type="text/javascript">
  $(".select").selectpicker();
</script>
