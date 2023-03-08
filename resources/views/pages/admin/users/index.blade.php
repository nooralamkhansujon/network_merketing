@extends('layouts.default')
@section('title','Admin Dashboard')
@section('content')
<div class="container my-3">
  <h2>User List</h2>
  <div class="container">
     <div class="row">
        {{-- single item  --}}
        <div class="col-md-12">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">User name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Details</th>
                    <th scope="col">Promo Code</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name ?? ''}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->dob}}</td>
                            <td>{{$user->promo_code}}</td>
                            <td>{{$user->commission}}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">Details</a>
                                <a href="{{route('admin.transactionsViaUser',$user->id)}}" class="btn btn-sm btn-info">Transactions</a>
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
