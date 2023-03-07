@extends('layouts.app')
@section('content')

<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="pb-3 bg-white bold">
                        <h6>{{ __('Statement of Account') }}</h6>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DateTime</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Details</th>
                                <th>Balance</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($statements as $statement)
                            <tr>
                                <td>{{$loop->iteration}} </td>
                                <td>{{$statement->transaction_date}} </td>

                                <td>{{$statement->amount}} </td>
                                <td>{{$statement->transaction_type}} </td>
                                <td> {{$statement->balance}}</td>
                                <td> {{$statement->balance}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $statements->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
