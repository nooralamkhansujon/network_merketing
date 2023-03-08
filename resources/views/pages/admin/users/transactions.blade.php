@extends('layouts.default')
@section('title','Transactions')
@section('content')
<div class="container my-3">
  <h2>User Transaction List</h2>
  <div class="container">
     <div class="row">
        {{-- single item  --}}
        <div class="col-md-12">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">User name</th>
                    <th scope="col">Transaction Ref</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Details</th>
                    <th scope="col">Promo Code</th>
                    <th scope="col">Commission</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <th scope="row">{{$transaction->id}}</th>
                            <td>{{$transaction->user->name ?? ''}}</td>
                            <td>{{$transaction->transaction_ref}}</td>
                            <td>{{$transaction->amount}}</td>
                            <td>{{$transaction->details}}</td>
                            <td>{{$transaction->promo_code}}</td>
                            <td>{{$transaction->commission}}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">details</a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
              </table>
        </div>
     </div>
  </div>
</div>
@endsection
