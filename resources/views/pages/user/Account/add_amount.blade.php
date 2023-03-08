@extends('layouts.default')
@section('title','Add Amount')
@section('content')
<div class="container my-3">
  <h2>Add Amount</h2>
  <div class="container">
     <div class="row">
        {{-- single item  --}}
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body">
                    <form action="{{route('user.transaction')}}" method="post">
                        @csrf
                        <div class="form-group">
                          <label for="amount">Amount</label>
                          <input type="text" class="form-control" id="amount" name="amount">
                        </div>
                        <div class="form-group">
                          <label for="details">Details</label>
                          <input type="details" class="form-control" id="details" name="details">
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
