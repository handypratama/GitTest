@extends('layouts.user')

@section('container')
<div class="container">
  <h2 class="text-center mb-3">Transaction History</h2>

  <div class="content">
    @foreach ($transactions as $transaction)
    <h5>Transaction ID: {{ $transaction->id }}</h5>
    <h5>Transaction Date: {{ $transaction->transactionDate }}</h5>
    <h5>Method: {{ $transaction->transactionMethod }}</h5>
    <h5>Card Number: {{ creditcard($transaction->cardNumber) }}</h5>
    <h5>User's Name: {{ Auth::user()->name }}</h5>

    <table class="table mt-3 mb-5">
      <thead>
        <tr>
          <th scope="col">Furniture Name</th>
          <th scope="col">Price</th>
          <th scope="col">Quantity</th>
          <th scope="col">Total Price</th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0;?>
        @foreach ($transaction->transactionDetails as $detail)

        @foreach ($items as $item)
        @if ($item->id == $detail->item_id)
        <?php $total += ($item->price * $detail->quantity)?>
        <tr>
          <th scope="row">{{ $item->name }}</th>
          <td>Rp. {{number_format($item->price, 0, '.', '.')}}</td>
          <td>{{ $detail->quantity }}</td>
          <td>Rp. {{number_format($item->price * $detail->quantity, 0, '.', '.')}}</td>
        </tr>
        @endif
        @endforeach

        @endforeach
        <td colspan="3" class="text-end">Total Price: </td>
        <td>Rp. {{number_format($total, 0, '.', '.')}}</td>
      </tbody>
    </table>
    @endforeach
  </div>
</div>
@endsection

<?php 
function creditcard($cc) {
  $length = strlen($cc);

  for($i=0; $i<$length-4; $i++) {
    $cc[$i] = 'X';
  }

  return $cc;
}
?>