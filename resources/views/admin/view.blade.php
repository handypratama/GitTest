@extends('layouts.admin')

@section('container')
<section id="products">
  <div class="container">
    <h2 class="text-center mb-5">{{ $pageTitle }}</h2>

    <div class="searchbar d-flex justify-content-end mb-5">
      <form class="d-flex" action="/admin/view/search" method="GET">
        <input class="form-control me-2" type="search" name="searchQuery" placeholder="Search by furniture's name"
          aria-label="Search">
        <button class="btn btn-primary" type="submit">Search</button>
      </form>
    </div>

    @if (count($items))
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
    <div class="d-flex justify-content-end">
      {{ $items->links() }}
    </div>

    @else
    <h2>There are no items</h2>
    @endif
  </div>
</section>
@endsection