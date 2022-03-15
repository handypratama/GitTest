@extends('layouts.admin')

@section('container')
<div class="container">
  <h1 class="text-center">{{ $item->name }}</h1>
  <div class="item-showcase d-flex justify-content-center">
    <div class="image col-3 mt-5">
      <img src="{{Storage::url($item->image)}}" class="border" alt="product1" width="300" height="300">
    </div>
    <div class="item-description ms-2 mt-5">
      <h4 class="pb-3">Name: {{ $item->name }}</h4>
      <h4 class="pb-3">Price: Rp. {{number_format($item->price, 0, '.', '.')}}</h4>
      <h4 class="pb-3">Furniture Type: {{ $item->type }}</h4>
      <h4 class="pb-3">Color: {{ $item->color }}</h4>
      <div class="d-flex">
        <a href="{{ url()->previous() }}" class="btn btn-secondary w-auto me-3">Previous</a>
        <a href="/admin/{{ $item->id }}/update" class="btn btn-primary w-auto me-3">Update</a>
        <form action="/admin/{{$item->id}}/delete" method="POST">
          {{method_field('DELETE')}}
          @csrf
          <button type="submit" class="btn btn-danger w-auto">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection