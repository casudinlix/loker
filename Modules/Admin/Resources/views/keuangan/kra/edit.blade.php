<form class="form-group" action="{{ route('keuangan1.update',[$data->uuid]) }}" method="post">
  @csrf
  @method('PUT')
  <input type="hidden" name="uuid" value="{{ $data->harga }}">
  <div class="form-group">
    <label for="">Harga</label>
    <input type="text" class="form-control" id="" placeholder="Harga" name="harga" value="{{ $data->harga }}">

  </div>
  <div class="form-group">
    <label for=""></label>
  <button type="submit" name="button">Simpan</button>
  </div>
</form>
