
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Driver Dashoard</title>
  </head>
  <body>
 	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
               alert("Error: Access is denied!");
            } else if( err.code == 2) {
               alert("Error: Position is unavailable!");
            }ok
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
      window.setInterval(notification,5000);
      window.setInterval(getLocationUpdate,10000);
    })();
</script>
  </body>
</html>