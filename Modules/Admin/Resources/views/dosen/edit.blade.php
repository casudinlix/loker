<form class="form-horizontal" action="{{ route('dosen.update',[$data->uuid]) }}" method="post">
@csrf
@method('PUT')
<div class="form-group">
  <label for="">Nama Lengkap</label>
  <input type="text" class="form-control" id="" placeholder="" name="name" value="{{ $data->name }}">

</div>
<div class="form-group">
  <label for="">Email</label>
  <input type="email" class="form-control" id="" placeholder="email" name="email" value="{{ $data->email }}">

</div>

<div class="form-group pull-right">
  <button type="submit" name="simpan" class="btn btn-rounded btn-success">Update</button>
</div>
</form>
