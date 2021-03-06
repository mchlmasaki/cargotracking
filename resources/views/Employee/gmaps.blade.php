<style>
#map_container{ 
  width: 1067px;
  height: 100%;
  float: left;
}
#map_canvas{
  width: 90%;
  height: 97%;
  margin-left:40px;
  border: 1px solid darkgrey;
}
</style>
<div id="map_container">
  <div id="map_canvas"></div>
</div>



<p>
<label for="search_ex_places">Saved Places</label>
<input type="text" placeholder="Search Saved Places" id="search_ex_places" list="saved_places">
</p>



<form method="post" action='index.php'>
  <p>Enter Your Street name,City state,Country</p>
  <input type="text" name='address' placeholder="Search New Places" id="search_new_places" >
  <input type="submit" name="submit_address" id="submit_address" value="Get Coordinates">
</form>

<form method="post" action='index.php'>
  <p>Enter Latitude</p>
  <input type='text' name='latitude' placeholder='Enter Latitude'>
  <p>Enter Longitude</p>
  <input type='text' name='longitude' placeholder='Enter Longitude'>
  <input type="submit" name="submit_coordinates" value="Get Address">
</form>





<form method="POST" action="save_places.php">

<label for="place">Name</label>
<input type="text" name="place" id="place" required />  

<label for="description">Description</label>
<input type="text" name="description" id="description" required />  

<label for="place">Latitude</label>
<input type="text" name="latitude" id="latitude"  required />  

<label for="place">Longitude</label>
<input type="text" name="longitude" id="longitude" required />  


<p> 
<input type="submit"  name="btn_save" value="save place"/>
<input type="button" id="plot_marker" value="plot marker"/>  
</p>
</form>

<?php
if(isset($_POST['submit_address']))
{
  $address =$_POST['address']; // Google HQ
  $prepAddr = str_replace(' ','+',$address);
  $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
  $output= json_decode($geocode);
  $status = $output->status;

  
  if($status == "OK")
  {
    $latitude = $output->results[0]->geometry->location->lat;
  $longitude = $output->results[0]->geometry->location->lng;
   echo "latitude: ".$latitude;
   echo "longitude: ".$longitude;
  }
  else
  {
  echo "No Data Found Try Again";
  }

  
}

if(isset($_POST['submit_coordinates']))
{
  $lat=$_POST['latitude'];
  $long=$_POST['longitude'];
  
  $url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&sensor=false";
  $json = @file_get_contents($url);
  $data = json_decode($json);
  $status = $data->status;
  $address = '';
  if($status == "OK")
  {
  echo $address = $data->results[0]->formatted_address;
  }
  else
  {
  echo "No Data Found Try Again";
  }
}
?>
 
<script src="js/jquery172.js"></script>              
<script type="text/javascript"
  src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCaN6laSOH7u378_-85AgbPakTeJB4NW_Y&sensor=true&libraries=places">
</script>
<script>
    var lat = -1.380779; //default latitude
    var lng = 36.768017; //default longitude
    var homeLatlng = new google.maps.LatLng(lat, lng); //set default coordinates
    var homeMarker = new google.maps.Marker({ //set marker
      position: homeLatlng, //set marker position equal to the default coordinates
      map: map, //set map to be used by the marker
      draggable: true //make the marker draggable
    });
    
    
    
    var myOptions = {
      center: new google.maps.LatLng(-1.380779, 36.768017), //set map center
      zoom: 17, //set zoom level to 17
      mapTypeId: google.maps.MapTypeId.ROADMAP //set map type to road map
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions); //initialize the map
    //if the position of the marker changes set latitude and longitude to 
    //current position of the marker
    google.maps.event.addListener(homeMarker, 'position_changed', function(){
      var lat = homeMarker.getPosition().lat(); //set lat current latitude where the marker is plotted
      var lng = homeMarker.getPosition().lng(); //set lat current longitude where the marker is plotted
    });    
    
    //if the center of the map has changed
    google.maps.event.addListener(map, 'center_changed', function(){
      var lat = homeMarker.getPosition().lat(); //set lat to current latitude where the marker is plotted
      var lng = homeMarker.getPosition().lng(); //set lng current latitude where the marker is plotted
    });
    var input = document.getElementById('search_new_places'); //get element to use as input for autocomplete
    var autocomplete = new google.maps.places.Autocomplete(input); //set it as the input for autocomplete
    autocomplete.bindTo('bounds', map); //bias the results to the maps viewport
    
    //executed when a place is selected from the search field
    google.maps.event.addListener(autocomplete, 'place_changed', function(){
        
        //get information about the selected place in the autocomplete text field
        var place = autocomplete.getPlace(); 
        
        if (place.geometry.viewport){ //for places within the default view port (continents, countries)
          map.fitBounds(place.geometry.viewport); //set map center to the coordinates of the location
        } else { //for places that are not on the default view port (cities, streets)
          map.setCenter(place.geometry.location);  //set map center to the coordinates of the location
          map.setZoom(17); //set a custom zoom level of 17
        }
        homeMarker.setMap(map); //set the map to be used by the  marker
        homeMarker.setPosition(place.geometry.location); //plot marker into the coordinates of the location 
  
    });
  $('#plot_marker').click(function(e){ //used for plotting the marker into the map if it doesn't exist already
      e.preventDefault(); 
      homeMarker.setMap(map); //set the map to be used by marker
      homeMarker.setPosition(map.getCenter()); //set position of marker equal to the current center of the map
      map.setZoom(17);
      
      $('input[type=text], input[type=hidden]').val('');
  });
  $('#search_ex_places').blur(function(){//once the user has selected an existing place
      
      var place = $(this).val();
      //initialize values
      var exists = 0;
      var lat = 0; 
      var lng = 0;
      $('#saved_places option').each(function(index){ //loop through the save places
        var cur_place = $(this).data('place'); //current place description
        
        //if current place in the loop is equal to the selected place
        //then set the information to their respected fields
        if(cur_place == place){ 
          exists = 1;
          $('#place_id').val($(this).data('id'));
          lat = $(this).data('lat');
          lng = $(this).data('lng');
          $('#n_place').val($(this).data('place'));
          $('#n_description').val($(this).data('description'));
        }
      });
      
      if(exists == 0){//if the place doesn't exist then empty all the text fields and hidden fields
        $('input[type=text], input[type=hidden]').val('');
        
      }else{
        //set the coordinates of the selected place
        var position = new google.maps.LatLng(lat, lng);
        
        //set marker position
        homeMarker.setMap(map);
        homeMarker.setPosition(position);
        //set the center of the map
        map.setCenter(homeMarker.getPosition());
        map.setZoom(17);
        
      }
    });
    $('#btn_save').click(function(){
      var place   = $.trim($('#n_place').val());
      var description = $.trim($('#n_description').val());
      var lat = homeMarker.getPosition().lat();
      var lng = homeMarker.getPosition().lng();
      
      $.post('save_place.php', {'place' : place, 'description' : description, 'lat' : lat, 'lng' : lng}, 
        function(data){
          var place_id = data;
          var new_option = $('<option>').attr({'data-id' : place_id, 'data-place' : place, 'data-lat' : lat, 'data-lng' : lng, 'data-description' : description}).text(place);
          new_option.appendTo($('#saved_places'));
        }
      );
      
      $('input[type=text], input[type=hidden]').val('');
    });
</script>