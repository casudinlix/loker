

    <form class="form-group" action="{{ route('jadwal.store') }}" method="post">
@csrf




                                   <div class="form-group">
                                     <label for="">Periode Akademik</label>
                                      <select class="form-control select2" name="akademik" required>

                                        @foreach ($akademik as $key)
                                          <option value="{{ $key->uuid }}">{{ $key->name }}</option>
                                        @endforeach
                                      </select>
                                   </div>
                                   <div class="form-group">
                                     <label for="">Matakuliah</label>
                                      <select required class="form-control select2" name="mk">
                                         <option value=""></option>
                                        @foreach ($mk as $key)
                                          <option value="{{ $key->uuid }}">{{ $key->kode.' - '.$key->name }}</option>
                                        @endforeach
                                      </select>
                                   </div>
                                   <div class="form-group">
                                     <label for="">Dosen</label>
                                      <select required class="form-control select2" name="dosen">
                                        <option value=""></option>
                                        @foreach ($dosen as $key)
                                          <option value="{{ $key->uuid }}">{{ $key->name }}</option>
                                        @endforeach
                                      </select>
                                   </div>




                             <!-- END BASIC TABLE SAMPLE -->




                             <div class="form-group">
                               <label for="">Hari</label>
                               <select required class="form-control select2" name="hari">
                                   <option value=""></option>
                                 <option value="Senin">Senin</option>
                                 <option value="Selasa">Selasa</option>
                                 <option value="Rabu">Rabu</option>
                                 <option value="Kamis">Kamis</option>
                                 <option value="Jumaat">Jumaat</option>
                                 <option value="Sabtu">Sabtu</option>
                                 <option value="Minggu">Minggu</option>
                               </select>
                             </div>
                             <div class="form-group">
                               <label for="">Kelas</label>
                               <select required class="form-control select2" name="kelas">
                                   <option value=""></option>
                                 @foreach ($kelas as $key)
                                   <option value="{{ $key->uuid }}">{{ $key->name }}</option>
                                 @endforeach
                               </select>
                             </div>
                                
                               <div class="form-group">
                                 <label for="">Start</label>
                                 <input required type="text" class="form-control jam" id="" placeholder="" name="start">

                               </div>
                               <div class="form-group">
                                 <label for="">End</label>
                                 <input required type="text" class="form-control jam" id="" name="end">

                               </div>
                               <div class="form-group">
                                  <button type="submit" class="pull-right btn btn-info" name="button">Simpan</button>
                               </div>
                           </div>
                           <!-- END STRIPED TABLE SAMPLE -->




  </form>






<script type="text/javascript">
  $('.select2').select2({
    width:'100%',
    placeholder: "Pilih",
  });


$(".timepicker24").timepicker({minuteStep: 5,showSeconds: true,showMeridian: false});

$('#kurikulum').change(function(event) {
  var kurikulum = $("#kurikulum").val();

  $.ajax({
    url: '{{url('api/v1/public/mk')}}/'+kurikulum,
    type: 'get',
    dataType: 'json',
    cache: true,
    async: true,
     success:function(data)
     {
         //$('select[name="matakuliah[]"]').empty();
         $('#matakuliah').empty();
         $.each(data, function(key, value) {

             //  console.log(value.id_kab);
             $('#matakuliah').append('<option value="' + value.uuid + '">' + value.kode+' - '+value.name +' ( Semester '+ value.smt+')'+ '</option>');

         });
     }
  })

});
var input = $('.jam').clockpicker({
    placement: 'bottom',
    align: 'right',
    autoclose: true,
    'default': 'now'
});

</script>
