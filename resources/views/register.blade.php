@extends('layouts.guest')

@section('container')
<div class="wrapper-register">
    <form action="/register" method="POST">
        @csrf
        <div class="mb-3 sub-heading">
            <h1>Register</h1>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                rows="3">{{ old('address') }}</textarea>
            @error('address')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label pe-3">Gender</label>

            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender"
                value="Male">
            <label class="form-check-label pe-3" for="gender">Male</label>

            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender"
                value="Female" value="{{ old('gender') }}">
            <label class="form-check-label" for="gender">Female</label>
            @error('gender')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
</div>
@endsection