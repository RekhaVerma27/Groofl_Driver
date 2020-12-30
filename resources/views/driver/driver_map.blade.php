
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Driver Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOnSELE8sqkY3hOcbmo_w2MjLR3ETHKuM&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
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
          <a class="dropdown-item" href="{{url('/driver-map'.$driver->id)}}">Driver Map</a>
          <a class="dropdown-item" href="{{url('/driver-logout')}}">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div id="map"></div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyDOnSELE8sqkY3hOcbmo_w2MjLR3ETHKuM"></script> -->
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyDOnSELE8sqkY3hOcbmo_w2MjLR3ETHKuM"></script>


<!-- Map Script -->
<script>
          function initMap() {
             var options = {
                zoom:5,
                center: { lat: 20.5937, lng: 78.9629} //Coordinates of New York 
             }
          var map = new google.maps.Map(document.getElementById('map'), options);
          
          function addMarker(prop) {
             var marker = new google.maps.Marker({
                position: prop.coordinates, // Passing the coordinates
                map:map, //Map that we need to add
                draggarble: false// If set to true you can drag the marker
             });
             if(prop.iconImage) { marker.setIcon(prop.iconImage); }
             if(prop.content) { 
                var information = new google.maps.InfoWindow({
                content: prop.content
                });
                
                marker.addListener('click', function() {
                information.open(map, marker);
                });
             }
          }

          @foreach($locations as $location)
          addMarker({
             coordinates:{lat: {{$location->latitude}}, lng: {{$location->longitude}}},
             content:'<h4>{{$location->name}}</h4>'
          });
          @endforeach

          //addMarker({lat: 28.7041, lng: 77.1025}); // Dehli Coordinates
          //addMarker({lat: 27.1767, lng: 78.0081}); // Agra Coordinates

          }
        </script>
  </body>
</html>