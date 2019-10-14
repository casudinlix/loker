
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Detail Invoice {{ $x->invoice_no }} ({{ $mhs->nim }} {{ $mhs->name }})</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
                                  <div class="panel panel-default">



                                      <div class="panel-body panel-body-table">

                                          <div class="table-responsive">
                                              <table class="table table-bordered table-striped table-actions">
                                                  <thead>
                                                      <tr>
                                                          <th width="50">No</th>

                                                          <th width="100">Total</th>
                                                          <th width="100">Dibuat</th>
                                                          <th width="150">Tanggal</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                    @php
                                                      $no=1;
                                                      $pembayaran=0;
                                                      $total=0;
                                                      $tagihan=$x->total_amount-$x->potongan;

                                                    @endphp
                                                    <tr>

                                                      @foreach ($data as $k)
                                                        @php
                                                          $pembayaran+=$k->total_bayar;
                                                        @endphp
                                                      @endforeach
                                                    @foreach ($inv as $key)
                                                      <td>{{ $no++ }}</td>

                                                      <td>Rp. {{ number_format($tagihan) }}</td>
                                                      <td>{{ $key->created_by }}</td>
                                                      <td>{{ tgl_indo($key->created_at) }}</td>

                                                      @php
                                                        $total +=$tagihan-$pembayaran;
                                                      @endphp
                                                      </tr>
                                                    @endforeach

                                                    <tr>
                                                      <td colspan="6">Sisa Pembayaran  : Rp. {{ number_format($total) }} </td>
                                                    </tr>
                                                  </tbody>
                                              </table>
                                          </div>

                                      </div>
                                  </div>

                              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-download">Simpan</span></button>

      </div>
