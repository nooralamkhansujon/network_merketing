@extends('layouts.default')
@section('title','Affiliates')
@section('content')
<div class="container my-3">
  <h2>Affiliates List</h2>
  <div class="container">
     <div class="row">
        <div class="col-md-12">
            <a href="{{route('admin.affiliates.create')}}" class="btn btn-info">Add New Affiliates</a>
        </div>
        {{-- single item  --}}
        <div class="col-md-12">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Type</th>
                    <th scope="col">Promo Code</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($affiliates as $affiliate)
                        <tr>
                            <th scope="row">{{$affiliate->id}}</th>
                            <td>{{$affiliate->name ?? ''}}</td>
                            <td>{{$affiliate->email}}</td>
                            <td>{{$affiliate->account->amount ?? 0}}</td>
                            <td>{{$affiliate->type}}</td>
                            <td>{{$affiliate->promo_code}}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">Details</a>
                                <a href="{{route('admin.transactionsViaUser',$affiliate->id)}}" class="btn btn-sm btn-info">Transactions</a>
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
