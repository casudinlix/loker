<form class="form-horizaontal" action="{{ route('kelas.update',[$data->uuid]) }}" method="post">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="">Nama</label>
    <input type="text" class="form-control" id="" value="{{ $data->name }}" name="nama">
    <p class="help-block">Help text here.</p>
  </div>
  <div class="form-group">
    <label for="">Kapasitas</label>
    <input type="number" class="form-control" id="" value="{{ $data->kapasitas }}" name="kapasitas">
    <p class="help-block">Help text here.</p>
  </div>
  <div class="form-group">
    <label for="">Status</label>
    <select class="form-control" name="status">
      <option value="true" {{ ($data->status==true)?"selected":"" }}>Active</option>
      <option value="false" {{ ($data->status==false)?"selected":"" }}>Non Active</option>
    </select>
  </div>
  <div class="form-group pull-right">
    <label for=""></label>
    <button type="submit" name="button" class="btn btn-info">Update</button>
  </div>
</form>
