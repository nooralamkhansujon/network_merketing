@extends('layouts.default')
@section('title','Admin Dashboard')
@section('content')
<div class="container my-3">
     <h2 class="my-4"> Welcome to {{auth('admin')->user()->name}}(admin)</h2>
     <div class="row">
        {{-- single item  --}}
        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-body">
                  <h2 class="text-success">{{$TotalUser}}</h2>
                  <p class="text-danger">Users</p>
                </div>
            </div>
        </div>
        {{-- single item  --}}
        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-body">
                  <h2 class="text-success">{{$transactions->count()}}</h2>
                  <p class="text-danger">Total Transactions</p>
                </div>
            </div>
        </div>
        {{-- single item  --}}
        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-body ">
                  <h2 class="text-success">{{$TotalAffiliateUser}}</h2>
                  <p class="text-primary">Total Affiliate User</p>
                </div>
            </div>
        </div>
        {{-- single item  --}}
        <div class="col-md-4 mt-4">
            <div class="card border-info">
                <div class="card-body ">
                  <h2 class="text-success">{{$TotalSubAffiliateUser}}</h2>
                  <p class="text-primary">Total Sub-Affiliate User</p>
                </div>
            </div>
        </div>
     </div>
     <div class="row">
        {{-- single item  --}}
        <div class="col-md-12 mt-5">
            <h2>User Transactions</h2>
        </div>
        <div class="col-md-12 my-2">
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
@endsection
