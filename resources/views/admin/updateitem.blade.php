@extends('layouts.admin')

@section('container')
<div class="wrapper-register">
  <div class="mb-3 sub-heading">
    <h1>Update Furniture</h1>
  </div>

  <form enctype="multipart/form-data" action="/admin/{{$item->id}}/update" method="POST">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name"
        value="{{ $item->name }}">
      @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">Price</label>
      <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
        value="{{ $item->price }}">
      @error('price')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="type" class="form-label">Type</label>
      <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
        <option value="Bed">Bed</option>
        <option value="Wardrobe">Wardrobe</option>
        <option value="Sofa">Sofa</option>
        <option value="Chair">Chair</option>
        <option value="Table">Table</option>
      </select>
      @error('type')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="color" class="form-label @error('color') is-invalid @enderror">Color</label>
      <select name="color" id="color" class="form-control">
        <option value="White">White</option>
        <option value="Black">Black</option>
        <option value="Navy">Blue Navy</option>
      </select>
      @error('color')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="image" class="form-label pe-3 @error('image') is-invalid @enderror">Image</label>
      <input type="file" id="image" class="form-control" name="image">
      @error('image')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary w-100">Update Furniture</button>
  </form>
</div>
@endsection