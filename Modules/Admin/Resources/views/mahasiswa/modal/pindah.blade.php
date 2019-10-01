<form class="form-horizontal" action="{{ route('post.pindah',[$data->uuid]) }}" method="post">
  @csrf
   
  <div class="form-group">
    <label for="">kurikulum</label>
    <select class="form-control select" name="kurikulum">
      @foreach ($kurikulum as $key)
        <option value="{{ $key->uuid }}" {{ ($key->uuid==$data->kurikulum_uuid)?"selected":"" }}>{{ $key->name }}</option>
      @endforeach
    </select>

  </div>
  <div class="form-group">
    <label for="">Jurusan</label>
    <select class="form-control select" name="jurusan">
      @foreach ($jurusan as $key)
        <option value="{{ $key->uuid }}" {{ ($key->uuid==$data->jurusan_uuid)?"selected":"" }}>{{ $key->name }} - {{ $key->program_name }}</option>
      @endforeach
    </select>
  </div>
<div class="form-group pull-right">
   <button type="submit" name="button" class="btn btn-rounded btn-info">Update</button>
</div>
  </div>
</form>
