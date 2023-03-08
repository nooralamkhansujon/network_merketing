<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Network Marketing</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        @auth('admin')
        <li class="nav-item ">
          <a class="nav-link" href="{{route('admin.dashboard')}}">Dashboard <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.affiliates.index')}}">Affiliates</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.users')}}">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.transactions')}}">Tranactions</a>
        </li>
        @endauth
        @auth('affiliate')
        <li class="nav-item active">
            <a class="nav-link" href="{{route('affiliate.dashboard')}}">Dashboard <span class="sr-only">(current)</span></a>
          </li>
        @endauth
        @auth('web')
        <li class="nav-item active">
            <a class="nav-link" href="{{route('user.dashboard')}}">Dashboard <span class="sr-only">(current)</span></a>
          </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{route('user.transactionForm')}}">Create Transaction</a>
          </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{route('user.transactions.index')}}">Transactions</a>
          </li>
        @endauth
        @auth('affiliate')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            Notifications
          </a>
          <div class="dropdown-menu" >
              @php
              $user = auth('affiliate')->user();

              @endphp

              @foreach ($user->notifications as $notification)

                  <a class="dropdown-item" style="display" href="#">{{$notification->data['message']}}</a>

              @endforeach
          </div>
        </li>
      @endauth
      </ul>
    </div>
    <ul class="navbar-nav mr-5">

        <li class="nav-item">
            <form action="{{route('logout')}}" method="post">
                @csrf
                @auth('admin')
                    <input type="hidden" name="guard" value="admin" >
                @endauth
                @auth('affiliate')
                    <input type="hidden" name="guard" value="affiliate" >
                @endauth
                @auth('web')
                    <input type="hidden" name="guard" value="web" >
                @endauth
                <button class="nav-link" style="border:none;background:transparent;cursor: pointer;" type="submit" >Logout</button>
          </form>
        </li>
      </ul>
</nav>
