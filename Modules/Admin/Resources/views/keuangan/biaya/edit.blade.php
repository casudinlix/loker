<form class="form-group" action="{{ route('biaya.update',[$data->uuid]) }}" method="post">
<div class="form-group">
  <label for="">Nama</label>
  <input type="text" class="form-control" value="{{ $data->name }}" placeholder="Nama" required name="nama">
@csrf
@method('PUT')
</div>
<div class="form-group">
  <label for="">Jenis</label>
  <select class="form-control" name="type">
    <option value=""></option>
    <option value="Pemasukan" {{ ($data->type=='Pemasukan')?"selected":"" }}>Pemasukan</option>
    <option value="Pengeluaran" {{ ($data->type=='Pengeluaran')?"selected":"" }}>Pengeluaran</option>
  </select>
</div>
<div class="form-group">
<button type="submit" name="button" class="btn btn-info pull-right">Update</button>
</div>
</form>
<script type="text/javascript">
  $(".select").selectpicker();
</script>
