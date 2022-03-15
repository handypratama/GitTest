@extends('layouts.guest')

@section('container')
<section id="hero">
  <div class="main-title">
    <h1>Build your dream house with us</h1>
  </div>
</section>

<section id="products">
  <div class="container">
    @if (session()->has('logoutMessage'))
    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
      {{ session('logoutMessage') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <h2>Best Sellers</h2>
    <div class="row justify-content-start mt-3">
      @foreach ($items as $item)
      <div class="col-md-3 mb-3">
        <div class="card">
          <a href="/{{ $item->id }}">
            <img src="{{Storage::url($item->image)}}" class="card-img-top" alt="product1" width="259" height="259">
          </a>
          <div class="card-body">
            <h2 class="card-title">{{$item->name}}</h2>
            <p class="card-text fs-5">Rp. {{number_format($item->price, 0, '.', '.')}}</p>
            <form action="/user/{{ $item->id }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection