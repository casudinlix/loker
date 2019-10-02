<form class="form-horizaontal" action="{{ route('kelas.store') }}" method="post">
  @csrf
  <div class="form-group">
    <label for="">Nama</label>
    <input type="text" class="form-control" id="" placeholder="" name="nama">
    <p class="help-block">Help text here.</p>
  </div>
  <div class="form-group">
    <label for="">Kapasitas</label>
    <input type="number" class="form-control" id="" placeholder="" name="kapasitas">
    <p class="help-block">Help text here.</p>
  </div>
  <div class="form-group pull-right">
    <label for=""></label>
    <button type="submit" name="button" class="btn btn-info">Simpan</button>
  </div>
</form>
