@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card pb-0" style="">
                <h6 class="pt-2">Welcome {{auth()->user()->name}} </h6>
                <hr>
                <table class="table">
                    <tr>
                        <th class="text-muted">Your ID</th>
                        <td>{{auth()->user()->email}} </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Your Balance</th>
                        <td>₹{{auth()->user()->balance}} </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
