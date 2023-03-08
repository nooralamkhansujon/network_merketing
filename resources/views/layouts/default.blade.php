<!doctype html>
<html>
<head>
   @include('includes.head')
</head>
<body>
   <header>
       @include('includes.header')
   </header>
   <div id="main" class="row">
        @yield('content')
   </div>
   {{-- <footer class="row">
    <div class="container">
       @include('includes.footer')
    </div>
   </footer> --}}
</div>
 @include('includes.script')
</body>
</html>
