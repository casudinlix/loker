<form class="form-group" action="{{ route('mk.store') }}" method="post">
  @csrf
  <div class="form-group">
    <label for="">Kode</label>
    <input type="text" class="form-control" id="" placeholder="Kode" name="kode" required>

  </div>
  <div class="form-group">
    <label for="">Nama Matakuliah</label>
    <input type="text" class="form-control" id="" placeholder="Nama MK" name="name" required>
<input type="hidden" name="created_by" value="{{ getadmin() }}">
  </div>
  <div class="form-group">
    <button type="submit" name="button" class="btn btn-info pull-right">Simpan</button>
  </div>
</form>
