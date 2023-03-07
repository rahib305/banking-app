@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-60">
        <div class="col-md-9">
            <h5 class="text-center mb-4">ABC BANK</h5>
            <div class="card">
                <div class="card-body">
                    <div class="pb-3 bg-white">{{ __('Create new account') }}</div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-12">
                                <label for="name" class="col-md-4 col-form-label text-md-start">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="email" class="col-md-4 col-form-label text-md-start">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email" value="{{ old('email') }}" required autocomplete="email">
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Create new account') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <p class="text-center pt-4">Already have an account?
                <a class="p-0" href="{{ route('login') }}">
                    {{ __("Sign in") }}
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
