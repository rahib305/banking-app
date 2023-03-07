@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-60">
        <div class="col-md-9">
                <h5 class="text-center mb-4">ABC BANK</h5>
            <div class="card">

                <div class="card-body">
                    <div class="pb-3 bg-white">{{ __('Login to your account') }}</div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-12">
                                <label for="email" class="col-md-4 col-form-label text-md-start">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                            <label for="password" class="col-md-4 col-form-label text-md-start">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('sign in') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <p class="text-center pt-4">Don't have account yet?
                <a class="p-0" href="{{ route('register') }}">
                    {{ __("Signup") }}
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
