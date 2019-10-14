
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Riwayat Transaksi {{ $inv->invoice_no }} ({{ $mhs->nim }} {{ $mhs->name }})</h4>
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
                                                          <th width="100">No Transaksi</th>

                                                          <th width="100">Type Bayar</th>
                                                          <th width="100">Total Bayar</th>
                                                          <th width="100">Dibuat</th>
                                                          <th width="150">Tanggal</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                    @php
                                                      $no=1;
                                                      $total=0;
                                                      $tagihan=$inv->total_amount-$inv->potongan;
                                                    @endphp
                                                    <tr>


                                                    @foreach ($data as $key)
                                                      <td>{{ $no++ }}</td>
                                                      <td>{{ $key->tran_no }}</td>
                                                      <td>{{ $key->type }}</td>
                                                      <td>Rp. {{ number_format($key->total_bayar) }}</td>
                                                      <td>{{ $key->created_by }}</td>
                                                      <td>{{ tgl_indo($key->created_at) }}</td>

                                                      @php
                                                        $total +=$key->total_bayar;
                                                      @endphp
                                                      </tr>
                                                    @endforeach
                                                    <tr>
                                                      <td colspan="6">Total Bayar  : Rp. {{ number_format($total) }} </td>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="6">Sisa Pembayaran  : Rp. {{ number_format($tagihan-$total) }} </td>
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

      </div>
