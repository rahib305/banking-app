@extends('layouts.app')
@section('content')

<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="pb-0 bg-white bold">
                        <h6>{{ __('Statement of Account') }}</h6>
                    </div>
                    <hr>
                    <div class="table-responsive" >
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
                                    <td style="width: 110px;">{{$statement->date_time}} </td>
                                    <td>
                                        @if($statement->transaction_type == 'Debit')
                                        <span class="text-danger">₹{{$statement->amount}}</span>
                                        @else
                                            <span class="text-success">₹{{$statement->amount}}</span>
                                        @endif
                                    </td>
                                    <td>{{$statement->transaction_type}} </td>
                                    <td> {{$statement->description}}</td>
                                    <td>₹{{$statement->balance}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if(count($statements) == 0)
                    <label class="text-center w-100">
                        No Data Found!
                    </label>
                    @endif

                    {{ $statements->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
