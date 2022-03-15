@extends('layouts.guest')

@section('container')
<div class="wrapper-content">
    <div class="wrapper-menu">
        <div class="content-login">
            @if (session()->has('registrationMessage'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('registrationMessage') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session()->has('loginErrorMessage'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginErrorMessage') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="sub-heading">
                <h1>Login</h1>
            </div>
            <hr>

            <form class="form-login" action="/login" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email"
                        value="{{ Cookie::get('emailCookie') !== null ? Cookie::get('emailCookie') : old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password"
                        value="{{ Cookie::get('passwordCookie') !== null ? Cookie::get('passwordCookie') : "" }}">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <div class="component">
                        <div class="remember">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                checked="{{ Cookie::get('emailCookie') !== null }}">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>

    <div class="line"></div>
    <div class="register">
        <h4>Haven't registered yet?</h4>
        <a href="{{ '/register' }}"><button type="submit" class="btn btn-primary">Register</button></a>
    </div>
</div>
@endsection