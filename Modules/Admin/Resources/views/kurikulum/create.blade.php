<form class="form-group" action="{{ route('kurikulum.store') }}" method="post">
  @csrf
  <div class="form-group">
    <label for="">Nama</label>
    <input type="text" class="form-control" required placeholder="Nama" name="nama">
    <p class="help-block">Help text here.</p>
  </div>
  <div class="form-group">
    <label for="">Jurusan</label>
    <select class="form-control" name="jurusan" required>

      @foreach ($jurusan as $key)
        <option value="{{ $key->uuid }}">{{ $key->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-success pull-right" >Simpan</button>
  </div>
</form>
<script type="text/javascript">
  $(".select").selectpicker();
</script>
