@extends('layouts.l1employeelayout')
@section('content')
@include('flash::message')
<?php $title='Manage Shipments';?>

        <!-- page content -->
            @foreach($shipments as $shipment)
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Shipment status:&nbsp;</h2><h2 style="color: red;"> {{ $shipment->status}}</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="col-md-12 col-sm-9 col-xs-12">

                     
                      <br />
                      <p>Pickup Location: {{ $shipment->from_location }}</p>
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

<?php
 $lat= $shipment->from_lat;
$lng= $shipment->from_lng;
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
                       </div>
                      <hr>
                      
                        <?php 
                  //calculating the actual cost directly from the DB and rounding it to 2dp
          $actualcost=round($shipment->shipping_rate*$shipment->weight, 2);
              if($actualcost!=$shipment->shipping_cost || $shipment->shipping_cost<=0){
               echo "<h4 class='red'> <i class='glyphicon glyphicon-remove'></i>You Need To Calculate Cost In order To Approve Shipment</h4>";
              }
              else{
                  echo "<h4 class='blue' ><i class='glyphicon glyphicon-ok-circle'></i>The shipping cost is upto date. You can now approve the shipment</h4>";
                }
              ?>
              <hr>

              <form action="{{ URL::to('Employee/manage_shipment/{shipment}')}}" method="POST" class="form-horizontal" name="Approve">
              {!! csrf_field() !!}
                  <input type="hidden" name="id" value="{{$shipment->id}}">
              
                <h4 class="green">General Details</h4>

                <div class="row">

                <div class='col-sm-2'>
                    Client name
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker'>
                            <input type='text' class="form-control" value="{{ $shipment->sender_name }}" readonly=""/>
                        </div>
                    </div>
                </div>

                <div class='col-sm-2'>
                    Client phone
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker2'>
                            <input type='text' class="form-control" value="{{ $shipment->sender_contact }}" readonly=""/>
                        </div>
                    </div>
                </div>
                
                 <div class='col-sm-2'>
                    Client email
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker3'>
                            <input type='text' class="form-control" value="{{ $shipment->sender_email }}" readonly=""/>
                        </div>
                    </div>
                </div>
                <div class='col-sm-2'>
                    Receiver's name
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker3'>
                            <input type='text' class="form-control" value="{{ $shipment->receiver_name }}" readonly=""/>
                        </div>
                    </div>
                </div>
                
                <div class='col-sm-2'>
                    Receiver's phone
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker4'>
                            <input type='text' class="form-control" value="{{ $shipment->receiver_contact }}" readonly=""/>
                        </div>
                    </div>
                </div>
                
                 <div class='col-sm-2'>
                    Receiver's email
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker6'>
                            <input type='text' class="form-control" value="{{ $shipment->receiver_name }}" readonly=""/>
                        </div>
                    </div>
                </div>
                <div class='col-sm-2'>
                    Receiver's address
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker7'>
                            <input type='text' class="form-control" value="{{ $shipment->receiver_address }}" readonly=""/>
                        </div>
                    </div>
                </div>
                
            </div>

                      <div>
                        <h4 class="green">Shipment Details</h4>

                <div class='col-sm-2'>
                    Consignment no
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker'>
                            <input type='text' class="form-control" value="{{ $shipment->cons_no }}" readonly="" />
                        </div>
                    </div>
                </div>

                <div class='col-sm-2'>
                    Type
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker2'>
                            <input type='text' class="form-control" value="{{ $shipment->type_ofshipment }}" readonly=""/>
                        </div>
                    </div>
                </div>
                
                 <div class='col-sm-2'>
                    Weight(Kg)
                    <div class="form-group">
                      <div class='input-group date' id='myDatepicker3'>
                      <input type='text' class="form-control" value="{{ $shipment->weight }}" name="weight" id="weight" readonly=""/>
                      </div>
                    </div>
                </div>
                <div class='col-sm-2'>
                    Total freight(Ksh)
                    <div class="form-group">
                    
                    <?php //$shipping_cost=$shipment->weight*$shipment->shipping_rate;?>
                        <div class='input-group date' id='myDatepicker3'>
                            <input type='text' class="form-control" value="{{ $shipment->shipping_cost }}" readonly=""/>
                        </div>
                    </div>
                </div>
                
                <div class='col-sm-2'>
                    Booking date
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker4'>
                            <input type='text' class="form-control" value="{{ date('M d, Y', strtotime( $shipment->created_at )) }}" readonly=""/>
                        </div>
                    </div>
                </div><br><br><br><br>
                </div>
                 <div>
                        <h4 class="green">Travel Details</h4>
                
                <div class='col-sm-3'>
                    From location
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker4'>
                            <input type='text' class="form-control" value="{{ $shipment->from_location }}" readonly=""/>
                        </div>
                    </div>
                </div>
                
                 <div class='col-sm-3'>
                    To location
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker6'>
                            <input type='text' class="form-control" value="{{ $shipment->to_location }}" readonly=""/>
                        </div>
                    </div>
                </div>

                            </div>


                            </div>
                            </div>
                        <input id="status" type="hidden" class="form-control" name="status" value="Approved">

                        
                        <div class="form-group">
                      <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                            <button class="btn btn-default" action="action" onclick="window.history.go(-1); return false;" type="button"><i class="glyphicon glyphicon-arrow-left"></i>Go back</button>
                            <?php 
                  //calculating the actual cost directly from the DB and rounding it to 2dp
          $actualcost=round($shipment->shipping_rate*$shipment->weight, 2);
                            if($actualcost!=$shipment->shipping_cost || $shipment->shipping_cost<=0){
                             
                            }
                            else{
                                 ?>
                                <button type="submit" name="Approve" class="btn btn-primary">
                                <i class="glyphicon glyphicon-ok-circle"></i> Approve shipping order
                                </button>
                                <?php
                              }
                            ?>
                                
                            </div>
                        </div>
                      </div>
                      </form>

                      <form name="edit_profile" action="{{ URL::to('Employee/manage_shipment/cost/{weight}')}}" method="POST" class="form-horizontal">
                          {!! csrf_field() !!}
                          <input type="hidden" name="id" value="{{ $shipment->id }}">
                          <?php
                        $weight=$shipment->weight;
                        if($weight<10){
                          ?>
                          <input type='hidden' value="0{{ $shipment->weight }}" name="weight" id="weight" />
                          <?php
                        }else{
                          ?>
                          <input type='hidden' value="{{ $shipment->weight }}" name="weight" id="weight" />
                          <?php
                        }
                        ?>
                           
                          <button type="submit" class="btn btn-warning pull-right"> Calculate cost</button>
                       </form>

                    </div>

                  </div>
                </div>
              </div>
            </div>
         @endforeach
        <!-- /page content -->

        @endsection()