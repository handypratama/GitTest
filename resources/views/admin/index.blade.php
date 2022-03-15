@extends('layouts.admin')

@section('container')
<section id="hero">
  <div class="main-title">
    <h1>Build your dream house with us</h1>
  </div>
</section>

<section id="products">
  <div class="container">
    <h2 class="mb-3">Welcome {{ Auth::user()->role }}, to JHFurniture</h2>

    @if (session()->has('updateItem'))
    <div class="m-auto text-center alert alert-success alert-dismissible fade show mb-3" role="alert">
      {{ session('updateItem') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session()->has('deleteMessage'))
    <div class="m-auto text-center alert alert-success alert-dismissible fade show mb-3" role="alert">
      {{ session('deleteMessage') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row justify-content-start">
      @foreach ($items as $item)
      <div class="col-md-3 mb-3">
        <div class="card">
          <a href="/admin/{{ $item->id }}">
            <img src="{{Storage::url($item->image)}}" class="card-img-top" alt="product1" width="259" height="259">
          </a>
          <div class="card-body">
            <h2 class="card-title">{{$item->name}}</h2>
            <p class="card-text fs-5">Rp. {{number_format($item->price, 0, '.', '.')}}</p>
            <div class="d-flex justify-content-around">
              <a href="/admin/{{ $item->id }}/update" class="btn btn-primary w-auto">Update</a>
              <form action="/admin/{{$item->id}}/delete" method="POST">
                {{method_field('DELETE')}}
                @csrf
                <button type="submit" class="btn btn-danger w-auto">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection