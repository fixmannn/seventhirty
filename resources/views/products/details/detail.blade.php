<div class="description">
  @foreach($products as $product)
  <h2>{{$product->name}} - {{$product->category}}</h2>
  <h5 class="text-danger"><s>Rp. <span id="number2">{{$product->price}}</span>,-</s></h5>
  <p class="price">Rp. <span id="number">{{$product->price - $product->discount_amount}}</span>,-</p>
  @endforeach
  <form action="{{url('add-to-cart/'.$product->id)}}" method="post">
    @csrf
    <div class="size-group mb-3">
      <h5 class="mr-2">Size :</h5>
      <div class="input-container">
        <input class="mt-0 radio-button" type="radio" aria-label="0" value="S" id="size-s" name="size">
        <div class="radio-box">
          <label for="size-s" id="" class="size-label">S</label>
        </div>
      </div>
      <div class="input-container">
        <input class="mt-0 radio-button" type="radio" aria-label="{{$info[0]->quantity}}" value="{{$info[0]->size}}" id="size-m" name="size">
        <div class="radio-box">
          <label for="size-m" id="" class="size-label">M</label>
        </div>
      </div>
      <div class="input-container">
        <input class="mt-0 radio-button" type="radio" aria-label="{{$info[1]->quantity}}" value="{{$info[1]->size}}" id="size-l" name="size">
        <div class="radio-box">
          <label for="size-l" id="" class="size-label">L</label>
        </div>
      </div>
      <div class="input-container">
        <input class="mt-0 radio-button" type="radio" aria-label="{{$info[2]->quantity}}" value="{{$info[2]->size}}" id="size-xl" name="size">
        <div class="radio-box">
          <label for="size-xl" id="" class="size-label">XL</label>
        </div>
      </div>
      <div class="input-container">
        <input class="mt-0 radio-button" type="radio" aria-label="{{$info[3]->quantity}}" value="{{$info[3]->size}}" id="size-xxl" name="size">
        <div class="radio-box">
          <label for="size-xxl" id="" class="size-label">XXL</label>
        </div>
      </div>
    </div>
    
    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif

    @if (session('failed'))
    <div class="alert alert-danger message">
      {{ session('failed') }}
    </div>
    @endif

    <div class="stock-available alert alert-success mt-3" style="display: none;">- Stok tersedia -</div>
    <div class="stock-na alert alert-danger mt-3" style="display: none;">- Stok kosong -</div>
    <div class="cart-btn">
      <button type="submit" id="cart-btn" class="btn btn-lg btn-outline-dark">Add to cart</button>
    </div>
  </form>
</div>

