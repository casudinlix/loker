<form class="form-group" action="{{ route('mk.update',[$data->uuid]) }}" method="post">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="">Kode</label>
    <input type="text" class="form-control" id="" value="{{ $data->kode }}" name="kode" required>

  </div>
  <div class="form-group">
    <label for="">Nama Matakuliah</label>
    <input type="text" class="form-control" id="" value="{{ $data->name }}" name="name" required>
<input type="hidden" name="created_by" value="{{ getadmin() }}">
  </div>
  <div class="form-group">
    <button type="submit" name="button" class="btn btn-info pull-right">Update</button>
  </div>
</form>
