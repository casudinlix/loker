<form class="form-horizaontal" action="{{ route('store.config') }}" method="post">
  @csrf
  <div class="form-group">
    <label for="">Periode Akademik</label>
    <select class="form-control select" name="akademik" required>
      <option value=""></option>
      @foreach ($data as $key)
        <option value="{{ $key->uuid }}">{{ $key->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="">Mulai</label>
    <input type="text" class="form-control datepicker" name="start_date" placeholder="Tanggal Mulai">

  </div>
  <div class="form-group">
    <label for="">Berakhir</label>
    <input type="text" class="form-control datepicker" id="" placeholder="Tanggal berakhir" name="due_date">

  </div>
  <div class="form-group">
    <label for="">Maksimal SKS</label>
    <input type="number" class="form-control" name="max_sks" placeholder="Makasimal SKS">
  </div>
  <div class="form-group pull-right">
    <button type="submit" class="btn btn-rounded btn-primary">Simpan</button>
  </div>
</form>
<script type="text/javascript">
  $(".datepicker").datepicker({format: 'yyyy-mm-dd',autoclose:true});
  $(".select").selectpicker();

</script>
