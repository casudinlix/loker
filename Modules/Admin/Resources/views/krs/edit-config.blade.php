<form class="form-horizaontal" action="{{ route('config.update',[$data->uuid]) }}" method="post">
  @csrf
   
  <div class="form-group">
    <label for="">Periode Akademik</label>
    <select class="form-control select" name="akademik" required>
      <option value=""></option>
      @foreach ($akademik as $key)
        <option value="{{ $key->uuid }}" {{ ($key->uuid==$data->akademik_uuid)?"selected":"" }}>{{ $key->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="">Mulai</label>
    <input type="text" class="form-control datepicker" name="start_date" value="{{ $data->start_date }}">

  </div>
  <div class="form-group">
    <label for="">Berakhir</label>
    <input type="text" class="form-control datepicker" id="" value="{{ $data->due_date }}" name="due_date">

  </div>
  <div class="form-group">
    <label for="">Maksimal SKS</label>
    <input type="number" class="form-control" name="max_sks" value="{{ $data->max_sks }}">
  </div>
  <div class="form-group pull-right">
    <button type="submit" class="btn btn-rounded btn-primary">Update</button>
  </div>
</form>
<script type="text/javascript">
  $(".datepicker").datepicker({format: 'yyyy-mm-dd',autoclose:true});
  $(".select").selectpicker();

</script>
