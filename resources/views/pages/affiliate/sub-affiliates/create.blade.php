@extends('layouts.default')
@section('title','Admin Dashboard')
@section('content')
<div class="container my-3">
  <h2>Add Sub Affiliate User</h2>
  <div class="container">
     <div class="row">
        {{-- single item  --}}
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body">
                    <form action="{{route('admin.affiliates.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="text" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                           <button type="submit" class="btn btn-success">Save</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
     </div>
  </div>
</div>
@endsection
