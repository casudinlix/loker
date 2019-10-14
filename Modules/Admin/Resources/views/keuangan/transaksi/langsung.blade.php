
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Pembayaran</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">


        <form class="form-horizontal" action="{{route('transaksi.simpan')}}" method="post">
          @csrf
        <div class="form-group">
          <label for="">Nomor Invoice</label>
          <input type="text" class="form-control" id="" value="{{ $inv->invoice_no }}" >
          <input type="hidden" class="form-control" id="" value="{{ $inv->uuid }}" name="invoice">

        </div>
        <div class="form-group">
          <label for="">Metode</label>
        <select class="form-control select" name="type" required>
        <option value="Tunai">Tunai</option>
        <option value="Transfer">Transfer</option>
        </select>
        </div>
        <div class="form-group">
          <label for="">Nama Bank</label>
          <input type="text" class="form-control" id="" placeholder="Nama Bank" name="bank" required>

        </div>
        <div class="form-group">
          <label for="">Mahasiswa</label>
          <input type="text" class="form-control" id="" value="{{ $user->nim.' '.$user->name }}">
        <input type="hidden" name="users_uuid" value="{{ $inv->users_uuid }}">
        </div>
        <div class="form-group">
          @php
            $dibayar=0;
          @endphp
            @foreach ($tran as $key)
              @php
                $dibayar+=$key->total_bayar;
              @endphp
            @endforeach
          <label for="">Tagihan</label>
          <input type="text" name="tagihan" value="{{ $inv->total_amount-$inv->potongan-$dibayar }}" id="tagihan" class="form-control" readonly>

        </div>
        <div class="form-group">
          <label for="">Total Bayar</label>
          <input type="text" class="money form-control " id="total_bayar" placeholder="Total Bayar" required name="total_bayar" onkeypress="return angka(event)">

        </div>
        <div class="form-group">
          <label for="">Kekurangan</label>
          <input type="number" class="form-control" id="sum" placeholder="" name="sisa" readonly min=0 oninput="validity.valid||(value='');">

        </div>

        <div class="form-group">
          <label for="">Bukti Bayar</label>
          <input type="file" class="form-control" name="file">
          <p class="help-block">*Max 2Mb.</p>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary pull-right">Simpan</button>

        </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>




<script type="text/javascript">
  $(".select").selectpicker();
  $('#total_bayar, #tagihan').keyup(function(){
                 var bayar = parseFloat($('#total_bayar').val()) || 0;
                 var tagihan = parseFloat($('#tagihan').val()) || 0;
                 $('#sum').val(tagihan - bayar);
              });
</script>
