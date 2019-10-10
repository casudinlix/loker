

    <form class="form-group" action="{{ route('jadwal.update',[$data->uuid]) }}" method="post">
@csrf
@method('PUT')



                                   <div class="form-group">
                                     <label for="">Periode Akademik</label>
                                      <select class="form-control select2" name="akademik" required>

                                        @foreach ($akademik as $key)
                                          <option value="{{ $key->uuid }}" {{ ($key->uuid==$data->akademik_uuid)?"selected":"" }}>{{ $key->name }}</option>
                                        @endforeach
                                      </select>
                                   </div>
                                   <div class="form-group">
                                     <label for="">Matakuliah</label>
                                      <select required class="form-control select2" name="mk">
                                         <option value=""></option>
                                        @foreach ($mk as $key)
                                          <option value="{{ $key->uuid }}" {{ ($key->uuid==$data->mk_uuid)?"selected":"" }}>{{ $key->kode.' - '.$key->name }}</option>
                                        @endforeach
                                      </select>
                                   </div>
                                   <div class="form-group">
                                     <label for="">Dosen</label>
                                      <select required class="form-control select2" name="dosen">
                                        <option value=""></option>
                                        @foreach ($dosen as $key)
                                          <option value="{{ $key->uuid }}" {{ ($key->uuid==$data->dosen_uuid)?"selected":"" }}>{{ $key->name }}</option>
                                        @endforeach
                                      </select>
                                   </div>




                             <!-- END BASIC TABLE SAMPLE -->




                             <div class="form-group">
                               <label for="">Hari</label>
                               <select required class="form-control select2" name="hari">

                                 <option value="Senin" {{ ($data->hari=="Senin")?"selected":"" }}>Senin</option>
                                 <option value="Selasa" {{ ($data->hari=="Selasa")?"selected":"" }}>Selasa</option>
                                 <option value="Rabu" {{ ($data->hari=="Rabu")?"selected":"" }}>Rabu</option>
                                 <option value="Kamis" {{ ($data->hari=="Kamis")?"selected":"" }}>Kamis</option>
                                 <option value="Jumaat" {{ ($data->hari=="Jumaat")?"selected":"" }}>Jumaat</option>
                                 <option value="Sabtu" {{ ($data->hari=="Sabtu")?"selected":"" }}>Sabtu</option>
                                 <option value="Minggu" {{ ($data->hari=="Minggu")?"selected":"" }}>Minggu</option>
                               </select>
                             </div>
                             <div class="form-group">
                               <label for="">Kelas</label>
                               <select required class="form-control select2" name="kelas">
                                   <option value=""></option>
                                 @foreach ($kelas as $key)
                                   <option value="{{ $key->uuid }}" {{ ($key->uuid==$data->kelas_uuid)?"selected":"" }}>{{ $key->name }}</option>
                                 @endforeach
                               </select>
                             </div>

                               <div class="form-group">
                                 <label for="">Start</label>
                                 <input required type="text" class="form-control jam" id="" value="{{ $data->start }}" name="start">

                               </div>
                               <div class="form-group">
                                 <label for="">End</label>
                                 <input required type="text" class="form-control jam" value="{{ $data->end }}" name="end">

                               </div>
                               <div class="form-group">
                                  <button type="submit" class="pull-right btn btn-info" name="button">Update</button>
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
