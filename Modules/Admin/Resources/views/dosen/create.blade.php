<form class="form-horizontal" action="{{ route('dosen.store') }}" method="post">
@csrf
<div class="form-group">
  <label for="">Nama Lengkap</label>
  <input type="text" class="form-control" id="" placeholder="" name="name" required>

</div>
<div class="form-group">
  <label for="">Email</label>
  <input type="email" class="form-control" id="" placeholder="email" name="email">

</div>
<div class="form-group">
  <label for="">Password</label>
  <input type="text" class="form-control"  placeholder="auto" disabled>

</div>
<div class="form-group pull-right">
  <button type="submit" name="simpan" class="btn btn-rounded btn-success">Simpan</button>
</div>
</form>
