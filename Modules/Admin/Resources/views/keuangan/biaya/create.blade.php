<form class="form-group" action="{{ route('biaya.store') }}" method="post">
<div class="form-group">
  <label for="">Nama</label>
  <input type="text" class="form-control" id="" placeholder="Nama" required name="nama">
@csrf
</div>
<div class="form-group">
  <label for="">Jenis</label>
  <select class="form-control" name="type">
    <option value=""></option>
    <option value="Pemasukan">Pemasukan</option>
    <option value="Pengeluaran">Pengeluaran</option>
  </select>
</div>
<div class="form-group">
<button type="submit" name="button" class="btn btn-info pull-right">Simpan</button>
</div>
</form>
<script type="text/javascript">
  $(".select").selectpicker();
</script>
