<form class="form-group" action="{{ route('kurikulum.update',[$data->uuid]) }}" method="post">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="">Nama</label>
    <input type="text" class="form-control" required value="{{ $data->name }}" name="nama">

  </div>
  <div class="form-group">
    <label for="">Jurusan</label>
    <select class="form-control" name="jurusan">

      @foreach ($jurusan as $key)
        <option value="{{ $key->uuid }}" {{ ($data->jurusan_uuid==$key->uuid)?"selected":"" }}>{{ $key->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="">Status</label>
    <select class="form-control" name="status">
      <option value="true" {{ ($data->status==true)?"selected":"" }}>Aktif</option>
      <option value="false" {{ ($data->status==false)?"selected":"" }}>NonActive</option>

    </select>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-success pull-right" >Update</button>
  </div>
</form>
<script type="text/javascript">
  $(".select").selectpicker();
</script>
