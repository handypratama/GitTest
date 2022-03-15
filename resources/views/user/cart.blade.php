@extends('layouts.user')

@section('container')
@if (Session::get('cart'))
<div class="container">
  <h1>My Cart</h1>
  <?php $total = 0; $i = 0?>
  @foreach (Session::get('cart') as $item)
  <?php $total += ($item['price'] * $item['quantity'])  ?>
  <div class="item d-flex mb-3 justify-content-between align-items-center">
    <img src="{{Storage::url($item['image'])}}" class="border" alt="product1" width="200" height="200">
    <h3 class="col-2">{{ $item['name'] }}</h3>
    <h3 class="col-2">Rp. {{number_format($item['price'], 0, '.', '.')}}</h3>
    <h3 class="col-2">Rp. {{number_format($item['price'] * $item['quantity'], 0, '.', '.')}}</h3>

    <form action="/user/cart/{{ $i }}/minQty" method="POST">
      @csrf
      <button class="btn btn-primary col-1 w-100"><i class="bi bi-dash"></i></button>
    </form>
    <h3 class="col-1 text-center">{{ $item['quantity'] }} pcs</h3>

    <form action="/user/cart/{{ $i }}/addQty" method="POST">
      @csrf
      <button class="btn btn-primary col-1 w-100"><i class="bi bi-plus"></i></button>
    </form>
  </div>
  <?php $i++?>
  @endforeach

  <h3 class="d-flex justify-content-end">Total Price:</h3>
  <h3 class="d-flex justify-content-end">Rp. {{number_format($total, 0, '.', '.')}}</h3>

  <div class="d-flex justify-content-end">
    <a href="/user/checkout" class="btn btn-primary w-auto">Proceed to Checkout</a>
  </div>
</div>

@else
<div class="text-center">
  <h2>You have nothing in your cart!</h2>
</div>
@endif
@endsection