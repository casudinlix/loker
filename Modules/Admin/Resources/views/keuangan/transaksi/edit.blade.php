<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Transaksi</h4>
      </div>
      <div class="modal-body">
      <form action="{{route('transaksi.update',[$data->uuid])}}" method="POST">
@csrf
@method('PUT')
<div class="form-group">
    <label for="xx">Status</label>
    <select name="status" class="form-control select">
            <option value="On Proses" {{($data->status=='On Proses')?'selected':''}}>On Proses</option>
            <option value="Verified" {{($data->status=='Verified')?'selected':''}}>Verified</option>
            <option value="Reject" {{($data->status=='Reject')?'selected':''}}>Reject</option>
    </select>
</div>
<div class="form-group">
    <label for="xx">Total Bayar</label>
<input id="xx" class="form-control" type="text" name="" readonly value="{{number_format($data->total_bayar)}}">
</div>
<div class="form-group">
    <label for="xx">File</label>
<a><i class="fa fa-eye pull-right">Lihat Lampiran</i>
    @if ($data->file!=null)
    <img id="myImg" src="{{Storage::url($data->file)}}" alt="Snow" style="width:100%;max-width:300px">

    @else
    <img id="myImg" src="{{Storage::url('no_image.jpeg')}}" alt="Snow" style="width:100%;max-width:300px">

    @endif
</a>
</div>
<button type="submit" class="btn btn-primary pull-right">Update</button>

</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

<script>
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>
