@extends('layouts.admin')

@section('container')
<div class="wrapper-update-profile">
  <form action="/admin/profile/update" method="POST">
    @csrf
    <div class="mb-3 sub-heading">
      <h1>Update Profile</h1>
    </div>

    <div class="mb-3">
      <label for="name" class="form-label">Full Name</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        value="{{ old('name', Auth::user()->name) }}">
      @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
        value="{{ old('email', Auth::user()->email) }}">
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
        placeholder="Enter a new password">
      @error('password')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary w-100">Update Profile</button>
  </form>
</div>
@endsection