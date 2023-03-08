<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <!-- Style -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <title>Registration Form</title>
</head>

<body>

    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('images/bg_1.jpg');"></div>
        <div class="contents order-2 order-md-1">

          <div class="container">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-7">
                <h3>Registration Form </h3>
                <form action="{{route('register')}}" method="post">
                    @csrf

                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" id="name">
                    @error('name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                   @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="your-email@gmail.com" id="email">
                    @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                   @enderror
                  </div>
                  <div class="form-group">
                    <label for="dob">Date Of Birth</label>
                    <input type="date" class="form-control" name="dob" placeholder="Enter DOB" id="dobdob">
                    @error('dob')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                   @enderror
                  </div>
                  <div class="form-group last mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Your Password" id="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group mb-3">
                    <label for="promo_code">Select Promo Code (optional)</label>
                    <select name="promo_code" class="form-control" id="promo_code">
                        <option value="">select Promo Code</option>
                        @foreach($affiliates as $affiliate)
                         <option value="{{$affiliate->promo_code}}">{{$affiliate->promo_code}}</option>
                        @endforeach
                    </select>
                </div>

                  <input type="submit" value="Sign Up" class="btn btn-block btn-primary">

                </form>
              </div>
            </div>
          </div>
        </div>


      </div>


<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
</body>

</html>
