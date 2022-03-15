@extends('layouts.user')

@section('container')
<section id="products">
  <div class="container">
    @if (session()->has('updateMessage'))
    <div class="w-25 m-auto text-center alert alert-success alert-dismissible fade show mb-3" role="alert">
      {{ session('updateMessage') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <h2 class="text-center mb-5">{{ Auth::user()->name }}'s Profile</h2>
    <div class="row d-flex justify-content-center my-3">
      <div class="col-2">
        <p>Full Name</p>
      </div>
      <div class="col-2">
        <p>{{ Auth::user()->name }}</p>
      </div>
    </div>

    <div class="row d-flex justify-content-center my-3">
      <div class="col-2">
        <p>Email</p>
      </div>
      <div class="col-2">
        <p>{{ Auth::user()->email }}</p>
      </div>
    </div>

    <div class="row d-flex justify-content-center my-3">
      <div class="col-2">
        <p>Address</p>
      </div>
      <div class="col-2">
        <p>{{ Auth::user()->address }}</p>
      </div>
    </div>

    <div class="row d-flex justify-content-center my-3">
      <div class="col-2">
        <p>Gender</p>
      </div>
      <div class="col-2">
        <p>{{ Auth::user()->gender }}</p>
      </div>
    </div>

    <div class="row d-flex justify-content-center my-3">
      <div class="col-2">
        <p>Role</p>
      </div>
      <div class="col-2">
        <p>{{ Auth::user()->role }}</p>
      </div>
    </div>

    <div class="row m-auto text-center">
      <div class="col">
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="btn btn-primary">Logout</button>
        </form>
      </div>
      <div class="col">
        <a href="{{ '/user/profile/history' }}" class="btn btn-primary">View Transaction History</a>
      </div>
      <div class="col">
        <a href="{{ '/user/profile/update' }}" class="btn btn-primary ">Update Profile</a>
      </div>
    </div>
  </div>
</section>
@endsection