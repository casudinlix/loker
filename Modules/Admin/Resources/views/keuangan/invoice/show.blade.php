<style>
  .invoice-box {
      max-width: 800px;
      margin: auto;
      padding: 30px;
      border: 1px solid #eee;
      box-shadow: 0 0 10px rgba(0, 0, 0, .15);
      font-size: 16px;
      line-height: 24px;
      font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      color: #555;
  }

  .invoice-box table {
      width: 100%;
      line-height: inherit;
      text-align: left;
  }

  .invoice-box table td {
      padding: 5px;
      vertical-align: top;
  }

  .invoice-box table tr td:nth-child(2) {
      text-align: right;
  }

  .invoice-box table tr.top table td {
      padding-bottom: 20px;
  }

  .invoice-box table tr.top table td.title {
      font-size: 45px;
      line-height: 45px;
        margin: auto;
      color: #333;
  }

  .invoice-box table tr.information table td {
      padding-bottom: 40px;
  }

  .invoice-box table tr.heading td {
      background: #eee;
      border-bottom: 1px solid #ddd;
      font-weight: bold;
        margin: auto;
  }

  .invoice-box table tr.details td {
      padding-bottom: 20px;
  }

  .invoice-box table tr.item td{
      border-bottom: 1px solid #eee;
  }

  .invoice-box table tr.item.last td {
      border-bottom: none;
  }

  .invoice-box table tr.total td:nth-child(2) {
      border-top: 2px solid #eee;
      font-weight: bold;
  }

  @media only screen and (max-width: 600px) {
      .invoice-box table tr.top table td {
          width: 100%;
          display: block;
          text-align: center;
      }

      .invoice-box table tr.information table td {
          width: 100%;
          display: block;
          text-align: center;
      }
  }

  /** RTL **/
  .rtl {
      direction: rtl;
      font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
  }

  .rtl table {
      text-align: right;
  }

  .rtl table tr td:nth-child(2) {
      text-align: left;
  }
  @media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}



  </style>

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Detail Invoice {{ $x->invoice_no }} ({{ $mhs->nim }} {{ $mhs->name }})</h4>
      </div>
      <div class="modal-body" id="printThis">
        <div class="invoice-box">
                <table cellpadding="0" cellspacing="0">
                    <tr class="top">
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td >
                                      <img src="{{ asset('logo.png') }}" style="width:50%; max-width:100px;">
                                      <strong>{{ config('app.nama_kampus') }}</strong>
                                      </td>

                                    <td>
                                        Invoice #: {{ $x->invoice_no }}<br>
                                        Created: {{ $x->created_at }}<br>
                                        Due: {{ $x->due_date }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="information">
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td>
                                        {{ config('app.nama_kampus') }}<br>
                                        <address class="">
                                          <p>{{ config('app.alamat') }} {{ config('app.tlp') }} {{ config('app.email') }}</p><br>

                                        </address>
                                    </td>

                                    <td>
                                        {{ $mhs->nim }}.<br>
                                        {{ $mhs->name }}<br>
                                        {{ $mhs->email }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>


                    @php
                      $no=1;
                      $pembayaran=0;
                      $total=0;
                      $tagihan=$x->total_amount-$x->potongan;

                    @endphp
                    @foreach ($data as $k)
                      @php
                        $pembayaran+=$k->total_bayar;
                      @endphp
                    @endforeach
                    <div class="table-responsive">
                                                            <table class="table table-bordered table-striped table-actions">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="100">Biaya</th>
                                                                        <th width="100">Harga</th>
                                                                        <th width="100">Potongan</th>
                                                                        <th width="100">Total</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr id="trow_1">
                                                                      @foreach ($inv as $key)
                                                                        <td>
                                                                            {{ $x->name }}
                                                                        </td>

                                                                        <td>Rp. {{ number_format($x->total_amount) }}</td>
                                                                        <td>Rp. {{ number_format($x->potongan) }}</td>
                                                                        <td>Rp. {{ number_format($tagihan) }}</td>
                                                                    </tr>
                                                                    @php
                                                                      $total +=$tagihan-$pembayaran;
                                                                    @endphp
                                                                  @endforeach
                                                                  <tfoot>
                                                                    <tr>
                                                                      <td colspan="4" class="">SubTotal : Rp. {{ number_format($x->total_amount) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td colspan="4" class="">Dibayar : Rp. {{ number_format($pembayaran) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td colspan="4" class="">Grand Total : Rp. {{ number_format($total) }}</td>
                                                                    </tr>
                                                                  </tfoot>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <footer class="pull-right">
* Faktur dibuat di komputer dan valid tanpa tanda tangan dan meterai.</footer>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default"  id="btnPrint">Cetak</button>

      </div>
      <script type="text/javascript">
      document.getElementById("btnPrint").onclick = function () {
    printElement(document.getElementById("printThis"));
}

function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}
      </script>
