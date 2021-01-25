
@extends('driver.layouts.master')


@section('content') 
<div class="container">
  @if(Session::has('flash_message_success'))
            <div class="alert alert-sm alert-success alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif

        @if(Session::has('flash_message_error'))
            <div class="alert alert-sm alert-danger alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif

        
            @foreach($driver->unreadNotifications as $notifications)
                <div class="alert alert-sm alert-success alert-block" role="alert">

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <a href="{{url('/view-notification/'.$notifications->data['letter']['body'].'/'.$notifications->id)}}">
                  <strong>{{ $notifications->data['letter']['title'] }}</strong>

                  <strong>Order ID : {{ $notifications->data['letter']['body'] }}</strong>
                </a>
                <strong style="float: right; margin-right: 20px;">{{ $notifications->created_at }}</strong>
               <!-- <a href="{{url('/view-notification/'.$notifications->data['letter']['body'])}}"><button type="button" style="float: right; margin-right: 20px;">view Details</button></a> -->
            </div>
            @endforeach
    
        <div class="col-md-12">
           {{--<h2>Read Notifications</h2>
            @foreach($driver->readNotifications as $readnotifications)
                <h4>{{ $readnotifications->data['letter']['title'] }}</h4>
            @endforeach--}}
        </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>Driver Login</h1>
                      <form id="form1" method="post">@csrf

                        @if(Session::has('message'))
                                       {{session('message')}}
                        @else

                         @endif
                         
                        Your Latitude : <div id="lat" /></div><br>
                        Your Longitude : <div id="lng" /></div><br>

                        <!-- location:<div id="loc">
                            <input type="hidden" id="latitude1"/>
                            <input type="hidden" id="longitude2"/>
                            <input type="hidden" name="{{$driver->id}}"> -->
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyDOnSELE8sqkY3hOcbmo_w2MjLR3ETHKuM"></script> -->
<script src="http://maps.google.com/maps/api/js?key=AIzaSyDOnSELE8sqkY3hOcbmo_w2MjLR3ETHKuM"></script>
  <script type="text/javascript">
     var watchID;
     var geoLoc;
     var geocoder;
     function showLocation(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        document.getElementById('lat').innerHTML =latitude;

           document.getElementById('lng').innerHTML =longitude;
           // alert("Test");
        
        //displayLocation(latitude, longitude);
        document.getElementById('form1').action="{{url('/driver-latlng/'.$driver->id)}}?"+"latitude="+latitude+ "&longitude=" +longitude;
        // alert(document.getElementById('form1').action);
        document.getElementById('form1').submit();


        //alert("Latitude : " + latitude + " Longitude: " + longitude);
     }
     function errorHandler(err) {
        if(err.code == 1) {
          // alert("Error: Access is denied!");
        } else if( err.code == 2) {
           //alert("Error: Position is unavailable!");
        }
     }
     function getLocationUpdate(){
        if(navigator.geolocation){
           // timeout at 60000 milliseconds (60 seconds)
           
          var options = {timeout:60000};
           geoLoc = navigator.geolocation;
           
           watchID = geoLoc.watchPosition(showLocation, errorHandler, options);
        } else{
           alert("Sorry, browser does not support geolocation!");
     }
    }

      function displayLocation(latitude,longitude){
        var x=document.getElementById("loc");
          var geocoder;
          geocoder = new google.maps.Geocoder();
          var latlng = new google.maps.LatLng(latitude, longitude);

          geocoder.geocode(
              {'latLng': latlng}, 
              function(results, status) {
                  if (status == google.maps.GeocoderStatus.OK) {
                      if (results[0]) {
                          var add= results[0].formatted_address ;
                          var  value=add.split(",");

                          count=value.length;
                          country=value[count-1];
                          state=value[count-2];
                          city=value[count-3];
                          x.innerHTML = "city name is: " + city;
                      }
                      else  {
                          x.innerHTML = "address not found";
                      }
                  }
                  else {
                      x.innerHTML = "Geocoder failed due to: " + status;
                  } } );
        }
      // function autoRefresh() {
      //             getLocationUpdate();
      //             setTimeout("location.reload(true);", 10000);
      //             }

      function notification(){
        // alert("hello");

              alert("hello");
          

        window.location.href = "{{URL::to('orders')}}"
      }

      (function (){
            // window.setInterval(notification,5000);
            window.setInterval(getLocationUpdate,10000);
          })();
</script>

@endsection