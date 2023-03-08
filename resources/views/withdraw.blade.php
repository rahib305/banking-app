@extends('layouts.app')
@section('content')

<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="pb-0 bg-white">
                        <h6>{{ __('Withdraw Money') }}</h6>
                    </div>
                    <hr>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{$errors->first()}}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('money.withdraw') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="amount" class="col-md-4 col-form-label text-md-start">{{ __('Amount') }}</label>
                                <input id="amount" type="amount" class="form-control @error('amount') is-invalid @enderror" placeholder="Enter amount to withdraw" name="amount" value="{{ old('amount') }}" autofocus>
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Withdraw') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
