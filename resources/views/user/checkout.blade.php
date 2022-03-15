@extends('layouts.user')

@section('container')
@if (Session::get('cart'))
<div class="container">
  <h1>Checkout</h1>
  <?php $total = 0;?>
  @foreach (Session::get('cart') as $item)
  <?php $total += ($item['price'] * $item['quantity'])  ?>
  <div class="item d-flex mb-3 justify-content-between align-items-center">
    <img src="{{Storage::url($item['image'])}}" class="border" alt="product1" width="200" height="200">
    <h3 class="col-2">{{ $item['name'] }}</h3>
    <h3 class="col-2">Rp. {{number_format($item['price'], 0, '.', '.')}}</h3>
    <h3 class="col-2">Rp. {{number_format($item['price'] * $item['quantity'], 0, '.', '.')}}</h3>
    <h3 class="col-1">{{ $item['quantity'] }} pcs</h3>
  </div>
  @endforeach
  <h3 class="d-flex justify-content-center">Total Price: Rp. {{number_format($total, 0, '.', '.')}}</h3>

  <form action="/user/checkout" method="POST">
    @csrf
    <div class="text-center">
      <label for="payment" class="form-label pe-3">Payment</label>

      <input class="form-check-input @error('payment') is-invalid @enderror" type="radio" name="payment" id="payment"
        value="Credit">
      <label class="form-check-label pe-3" for="payment">Credit</label>

      <input class="form-check-input @error('payment') is-invalid @enderror" type="radio" name="payment" id="payment"
        value="Debit" value="{{ old('payment') }}">
      <label class="form-check-label" for="payment">Debit</label>
      @error('payment')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3 m-auto w-50 text-center">
      <label for="cardNumber" class="form-label">Card Number</label>
      <input type="text" class="form-control @error('cardNumber') is-invalid @enderror" id="cardNumber"
        name="cardNumber" value="{{ old('cardNumber') }}">
      @error('cardNumber')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="d-flex justify-content-center mt-3">
      <button type="submit" class="btn btn-primary w-auto">Checkout</button>
    </div>
  </form>
</div>
@endsection