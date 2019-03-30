@extends('layouts.clientlayout')
@section('content')
@include('flash::message')

        <!-- page content -->
          
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Track Your shipment:&nbsp;</h2><h2 style="color: red;"> </h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    





                    <div class="col-md-8 col-sm-12 col-xs-12" style=" ">
                <div class="x_panel">
                  
                  <div class="x_content">

                    
                    <form name="trackshipmentform" action="{{ URL::to('Client/trackshipment')}}" method="POST" class="form-horizontal form-label-left">
                      {!! csrf_field() !!}

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Enter Your Consignment Number</label>

                        <div class="col-sm-9">
                          
                    <div class="input-group {{ $errors->has('cons_no') ? ' has-error' : '' }}">
                      <input id="cons_no" type="text" class="form-control" name="cons_no" value="{{ old('cons_no')}}">
                      
                      <span class="input-group-btn">
                      <button type="submit" class="btn btn-primary" onclick="showDiv()">Go!</button>
                      </span>

                    </div>
                    @if ($errors->has('cons_no'))
                          <span class="help-block">
                              <strong style="color: red;">{{ $errors->first('cons_no') }}</strong>
                          </span>
                      @endif
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div id="welcomeDiv"  style="display:none;" class="answer_list" > 
                        <?php
$var=1;
if($var==1)
{
  echo '
<table id="" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>Updated on</th>
                          <th>Location</th>
                          <th>Current Status</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($users as $user)
                        <tr>
                        
                        <td>{{ $user->id}</td>
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->id }}</td>
                        </tr>
                         @endforeach
                      </tbody>
                    </table>

  ';
  
}else{
  echo "no";
}


?>
  
</div>
<input type="button" name="answer" value="Show Div" onclick="showDiv()" />




                  












                    <div class="col-md-12 col-sm-9 col-xs-12">

                     
                      <br />
                      <p>Current Location: </p>
                      <div id="mainb" style="height:350px;">
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

?>

<?php
 $lat= 10;
$lng= 20;
?>
 
<script src="js/jquery172.js"></script>              
<script type="text/javascript"
  src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCaN6laSOH7u378_-85AgbPakTeJB4NW_Y&sensor=true&libraries=places">
</script>
<script>
    //var lat = -1.380779; //default latitude
    var lat = <?php echo $lat; ?>;
    //var lng = 36.768017; //default longitude
    var lng = <?php echo $lng; ?>;
    var homeLatlng = new google.maps.LatLng(lat, lng); //set default coordinates
    var homeMarker = new google.maps.Marker({ //set marker
      position: homeLatlng, //set marker position equal to the default coordinates
      map: map, //set map to be used by the marker
      draggable: true //make the marker draggable
    });
    
    
    
    var myOptions = {
      center: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>), //set map center
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



<script type="text/javascript">
function showDiv() {
   document.getElementById('welcomeDiv').style.display = "block";
}

</script>






                       </div>
                      <hr>
                      
                        
              <hr>

              


                    </div>

                  </div>
                </div>
              </div>
            </div>
      
        <!-- /page content -->

        @endsection()