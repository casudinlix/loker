<form action="{{ route('simpan_ijinkrs') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="my-input">Angkatan</label>
        <select name="angkatan" id="angkatan" class="form-control select">
            <option value=""></option>
            @foreach ($angkatan as $key)
              <option value="{{ $key->angkatan }}">{{ $key->angkatan }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="my-input">Mahasiswa</label>
        <select name="mhs[]" id="mhs" class="form-control select2" multiple="multiple" required>

        </select>
    </div>
    <div class="form-group">
      <label for="">Start Date</label>
      <input type="text" class="datepicker form-control" placeholder="" name="start_date">
    </div>
    <div class="form-group">
      <label for="">End Date</label>
      <input type="text" class="datepicker form-control" placeholder="" name="end_date">
    </div>
    <div class="form-group">
      <label for="">Keterangan</label>
<textarea name="ket" class="form-control"></textarea>
   </div>
   <div class="form-group">
     <label for="">Max SKS</label>
     <input type="text" class="form-control" id="" placeholder="" name="max_sks" onkeypress="return angka(event)">
   </div>
   <button type="submit" name="button">Simpan</button>
</form>
<script>
    var id=$('#mhs').val();
    $(".datepicker").datepicker({format: 'yyyy-mm-dd',autoclose:'true'});
$('.select2').select2({
  'width': '100%',
  'minimumInputLength': 2,
  'placeholder': 'Cari...',
});
$("#angkatan").change(function(event) {
  var id = $("#angkatan").val();
  //$('#angkatan').selectpicker('refresh');
  $("#angkatan").attr("disabled", true);

  $.ajax({
    url: '{{ url('admin/keuangan/get/mhs/') }}/'+id,
    type: 'GET',
    dataType: 'JSON',

    success:function(data)
    {


      $.each(data, function(key, value) {
        //$('#mhs').selectpicker('refresh');
          //  console.log(value.id_kab);
          $('#mhs').append('<option value="' + value.uuid + '">' + value.nim+' '+value.name + '</option>');

      });
    },
    error:function()
    {
      $('#mhs').selectpicker('refresh');
    }
  })


});
//
// $('.select2').select2({
//     'width': '80%',
//     'minimumInputLength': 4,
//     'placeholder': 'Cari...',
//
//     ajax: {
//     url: "{{url('mahasiswa/cari/')}}"+id,
//
//     dataType: 'json',
//     delay: 250,
//     type:'GET',
//     results: function (data) {
//         $.each(data, function (key, value) {
//             console.log(value)
//         });
//     },
//       cache: true
//     // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
//   }
// });
</script>
