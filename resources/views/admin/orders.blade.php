@include('layouts/pages')


@include('layouts/nav')

{{-- Order Details --}}
<div class="details">
    <div class="row header">
        <div class="col-xl-3 side-bar">
            <h5 class="font-weight-bold title">Account Details</h5>
            <a href="{{ url('/account-details') }}"><div class="d-flex justify-content-between btn mt-3">
                <p class="text-list font-weight-bold active">Edit Profile</p>
                <span class="iconify text-list active" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div></a>
            <a href="{{ url('/change-password') }}"><div class="d-flex justify-content-between btn mt-1 list-menu">
                <p class="text-list font-weight-bold">Change Password</p>
                <span class="iconify text-list" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div></a>
            <a href="{{ url('/orders') }}"><div class="d-flex justify-content-between btn mt-1 list-menu">
                <p class="text-muted font-weight-bold">Orders</p>
                <span class="iconify text-muted" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div></a>
        </div>
        <div class="col-xl-9">
        <div class="heading d-flex justify-content-between">
          <h5 class="font-weight-bold title">Orders</h5>
        </div>
        <table class="table mt-3 dataTable">
            <thead class="thead-success">
              <tr>
                <th scope="col">Order No.</th>
                <th scope="col">Order Status</th>
                <th scope="col">Order Date</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>
            <tbody>
            @foreach($order as $id => $orders)
              <tr class="order-row" data-href="{{ url('admin/order') }}/{{ $orders->order_number }}">
                <td>{{ $orders->order_number }}</td>
                <td>
                    @if($orders->order_status == 0)
                    Menunggu Pembayaran
                    @elseif($orders->order_status == 1)
                    Paket Siap Dikirim
                    @elseif($orders->order_status == 2)
                    Paket Terkirim
                    @else
                    Order gagal (Pembayaran tidak diselesaikan)
                    @endif
                </td>
                <td>{{ $orders->created_at }}</td>
                <td>Rp. <span class="number">{{ $orders->amount }}</span>,-</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="d-flex justify-content-center">
            {!! $order->links() !!}
        </div>
        </div>
    </div>
</div>

@include('layouts/footer')

<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('.order-row').click(function() {
            window.location = $(this).data('href');
        });
        $('.dataTable').DataTable();
    });

</script>

<script>
    const price = document.querySelectorAll('.number');

    window.addEventListener('load', function() {
        price.forEach((val, index) => {
            valInner = val.innerHTML;
            val.innerHTML = parseFloat(valInner).toLocaleString('id');
        });
    });
</script>