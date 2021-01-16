<div class="container">
 	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{url('/driver-dashboard')}}">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>



  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if($driver->unreadNotifications->count() )
            <span class="badge badge-danger"> {{$driver->unreadNotifications->count()}}</span>
            @endif
            <span><i class="fa fa-bell"></i></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="btn btn-link"  href="{{route('markAsRead')}}">Mark All as Read</a>
          @foreach($driver->unreadNotifications as $notification)
            <a class="dropdown-item">
                {{--{{ $notification->type }}--}}

                {{ $notification->data['letter']['title'] }}
                
            </a>
            @endforeach
        </div>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="{{url('/accepted-orders')}}"> Orders</a>
      </li>

      <li class="nav-item dropdown">
        
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{$driver->name}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{url('/driver-map/'.$driver->id)}}">Driver Map</a>
          <a class="dropdown-item" href="{{url('/driver-logout')}}">Logout</a>
        </div>
      </li>
    </ul>
  </div>
  </nav>
</div> <br>