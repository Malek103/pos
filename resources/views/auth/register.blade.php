{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}


@extends('auth.app')
@section('content')
    <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
        @csrf
        <span class="login100-form-title p-b-26">
            Welcome
        </span>
        <span class="login100-form-title p-b-48">
            <img src="{{ asset('images/poslogo.jpg') }}" width="150px" height="150px" alt="">
        </span>
        <div class="wrap-input100 validate-input">
            <input id="name" type="text" placeholder="User Name" class="form-control @error('name') is-invalid @enderror"
                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            {{-- <input class="input100" type="text" name="email" /> --}}
        </div>
        <div class="wrap-input100 validate-input">

            <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            {{-- <input class="input100" type="password" name="pass" /> --}}
        </div>
        <div class="wrap-input100 validate-input">
            <span class="btn-show-pass">
                <i class="zmdi zmdi-eye"></i>
            </span>
            <input id="password" type="password" placeholder="Password"
                class="form-control @error('password') is-invalid @enderror" name="password" required
                autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            {{-- <input class="input100" type="text" name="email" /> --}}

        </div>
        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <span class="btn-show-pass">
                <i class="zmdi zmdi-eye"></i>
            </span>
            <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control"
                name="password_confirmation" required autocomplete="new-password">
            {{-- <input class="input100" type="password" name="pass" /> --}}

        </div>
        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn">Register</button>
            </div>
        </div>
        {{-- <div class="text-center p-t-115">
            <span class="txt1"> Don’t have an account? </span>
            <a class="txt2" href="{{ route('register') }}"> Register </a>
        </div> --}}
    </form>
@endsection
