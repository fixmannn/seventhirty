<div class="modal fade mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mb-5">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Metode Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item">
            <input type="radio" id="bca" name="payment" value="BCA" title="qris">
            <label for="bca">
              <img src="{{asset('/img/payment/BCA.svg')}}" alt="" width="50" class="mr-2">
              Scan QR BCA
            </label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="mandiri" name="payment" value="MANDIRI" title="va">
            <label for="bca">
              <img src="{{asset('/img/payment/MANDIRI.svg')}}" alt="" width="50" class="mr-2">
              Bank Mandiri Virtual Account
            </label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="bni" name="payment" value="BNI" title="va">
            <label for="bni">
              <img src="{{asset('/img/payment/bni.png')}}" alt="" width="50" class="mr-2">
              Bank BNI Virtual Account
            </label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="bri" name="payment" value="BRI" title="va">
            <label for="bri">
              <img src="{{asset('/img/payment/BRI.svg')}}" alt="" width="50" class="mr-2">
              Bank BRI Virtual Account
            </label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="permata" name="payment" value="PERMATA" title="va">
            <label for="permata">
              <img src="{{asset('/img/payment/PERMATA.svg')}}" alt="" width="50" class="mr-2">
              Permata Bank Virtual Account
            </label>
          </li>
          {{-- <li class="list-group-item">
            <input type="radio" id="alfamart" name="payment" value="alfamart">
            <label for="alfamart">
              <img src="{{asset('/img/payment/alfamart.png')}}" alt="" width="50" class="mr-2">
              Alfamart
            </label>
          </li> --}}
          <li class="list-group-item">
            <input type="radio" id="ovo" name="payment" value="ID_OVO" title="ewallets">
            <label for="ovo">
              <img src="{{asset('/img/payment/ID_OVO.png')}}" alt="" width="50" class="mr-2">
              OVO
              <span style="font-size: 14;" class="text-danger"><i>(Pastikan format nomor hp benar)</i></span>
            </label>
            <input type="hidden" class="form-control" id="ovo_number" name="ovo_number" placeholder="contoh +628128498281">
          </li>
          <li class="list-group-item">
            <input type="radio" id="dana" name="payment" value="ID_DANA" title="ewallets">
            <label for="dana">
              <img src="{{asset('/img/payment/ID_DANA.png')}}" alt="" width="50" class="mr-2">
              DANA
            </label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="linkaja" name="payment" value="ID_LINKAJA" title="ewallets">
            <label for="linkaja">
              <img src="{{asset('/img/payment/ID_LINKAJA.png')}}" alt="" width="50" class="mr-2">
              Link Aja
            </label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="shopeepay" name="payment" value="ID_SHOPEEPAY" title="ewallets">
            <label for="shopeepay">
              <img src="{{asset('/img/payment/ID_SHOPEEPAY.png')}}" alt="" width="50" class="mr-2">
              Shopee Pay
            </label>
          </li>
        </ul>
      </div>
      <div class="modal-footer align-items-center">
        <button type="submit" class="btn btn-success btn-block" id="payment-btn">Bayar</button>
      </div>
    </div>
  </div>
</div>