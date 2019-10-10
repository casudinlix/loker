<form class="form-group" action="{{ route('import') }}" method="post" enctype="multipart/form-data">
  @csrf
  <input type="file" name="file">
  <button type="submit" class="btn btn-success" name="button">Upload</button>
</form>
