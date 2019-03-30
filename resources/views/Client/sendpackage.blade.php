@extends('layouts.clientlayout')
@section('content')
@include('flash::message')

        <!-- page content -->

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
              <div class="modal-header">
              <h4 class="modal-title">Send Parcel/Documents/Goods</h4>
              </div>
              <h2><small>Shipper/Sender Information</small></h2>
                                        
              <form name="car_form" action="{{ URL::to('Client/sendpackage')}}" method="POST" class="form-horizontal">
              {!! csrf_field() !!}
              <?php 
                          function createRandomTransactionum() {
                            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                            srand((double)microtime()*1000000);
                            $i = 0;
                            $pass = '' ;
                            while ($i <= 7) {
                              $num = rand() % 33;
                              $tmp = substr($chars, $num, 1);
                              $pass = $pass . $tmp;
                              $i++;
                            }
                            return $pass;
                          }
                                  $consignment_No = createRandomTransactionum();
                           ?>

                      <input type="hidden" name="id" id="id">
                      

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('sender_name') ? ' has-error' : '' }}">
                        <input type="text" class="form-control has-feedback-left" name="sender_name" id="sender_name" value="{{ old('sender_name') }}" placeholder="Sender's name">
                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                        @if ($errors->has('sender_name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('sender_name') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('sender_contact') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="sender_contact" id="sender_contact" value="{{ old('sender_contact') }}" placeholder="Phone Number">
                        <span class="fa fa-bank form-control-feedback right" aria-hidden="true"></span>
                         @if ($errors->has('sender_contact'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('sender_contact') }}</strong>
                                    </span>
                                @endif
                      </div>

                      

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('from_location') ? ' has-error' : '' }} ">
                        <input type="text" name="from_location" value="{{ old('from_location') }}" class="form-control has-feedback-left" placeholder="Pickup Location(City/Town/Area)" id="search_new_places">
                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                        @if ($errors->has('from_location'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('from_location') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('sender_address') ? ' has-error' : '' }}" >
                        <input type="text" class="form-control" name="sender_address" id="sender_address" value="{{ old('sender_address') }}" placeholder="Address">
                        <span class="fa fa-pencil form-control-feedback right" aria-hidden="true"></span>
                                @if ($errors->has('sender_address'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('sender_address') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('sender_email') ? ' has-error' : '' }} ">
                      <input type="email" name="sender_email" value="{{ old('sender_email') }}" class="form-control has-feedback-left" placeholder="Email Address" id="sender_email">
                        
                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                        @if ($errors->has('sender_email'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('sender_email') }}</strong>
                                    </span>
                          @endif
                      </div><br><br><br>


                      

                     <h2><br><br><br><br><small>Nearest City/Town</small></h2>
                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('receiver_name') ? ' has-error' : '' }} ">
                      <select type="text" class="form-control has-feedback-left" name="town" id="town" value="{{ old('town') }}">
                        @foreach($towns as $town)
                        
                              <option value="{{ $town->town }}">{{ $town->town }} -  {{ $town->county }} County</option>
                           
                      @endforeach
                      </select>
                        
                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                       @if ($errors->has('receiver_name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('receiver_name') }}</strong>
                                    </span>
                                @endif
                      </div>


                      
                       <h2><br><br><br><br><small>Receiver's Information</small></h2>
                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('receiver_name') ? ' has-error' : '' }} ">
                      <input type="text" name="receiver_name" value="{{ old('receiver_name') }}" class="form-control has-feedback-left" placeholder="Receiver's Name" id="receiver_name">
                        
                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                       @if ($errors->has('receiver_name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('receiver_name') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('receiver_contact') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="receiver_contact" id="receiver_contact" value="{{ old('receiver_contact') }}" placeholder="Phone Number">
                        <span class="fa fa-bank form-control-feedback right" aria-hidden="true"></span>
                         @if ($errors->has('receiver_contact'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('receiver_contact') }}</strong>
                                    </span>
                                @endif
                      </div>

                      

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('to_location') ? ' has-error' : '' }} ">

                        <input type="text" name="to_location" value="{{ old('to_location') }}" class="form-control has-feedback-left" placeholder="Delivery Location(City/Town/Area)" id="search_destination_places">
                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                        @if ($errors->has('to_location'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('to_location') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('receiver_address') ? ' has-error' : '' }}" >
                        <input type="text" class="form-control" name="receiver_address" id="receiver_address" value="{{ old('receiver_address') }}" placeholder="Address">
                        <span class="fa fa-pencil form-control-feedback right" aria-hidden="true"></span>
                               @if ($errors->has('receiver_address'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('receiver_address') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <h2><br><br><br><br><small>Shipment Information</small></h2>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('type_ofshipment') ? ' has-error' : '' }} ">
                      <select type="text" class="form-control has-feedback-left" name="type_ofshipment" id="type_ofshipment" value="{{ old('type_ofshipment') }}">
                      <option>Agricultural </option><option>Aluminum </option>
                      <option> Appliances</option><option> Automobile</option><option> Bagged Products</option><option>Batteries </option><option>Blocks of marble </option>
                      <option>Boxes </option><option> Building Materials</option><option>Barrels </option><option>Bulk Loads </option>
                      <option> Car carriers container</option><option>Cement </option><option>Charcoal </option><option> Chemical</option>
                      <option> Containers</option><option> Crates</option><option> Dairy Products</option><option> Display Equipment</option>
                      <option>Documents </option><option> Drums</option><option>Dry storage container </option><option> Electronics</option>
                      <option>Engines </option><option>Fertiliser </option><option> Forest Products</option><option> Fresh Produce</option>
                      <option> Frozen Foods</option><option>Furniture </option><option>Fruits </option>
                      <option> Gas Bottles</option>
                      <option> Glass</option><option>Grains </option><option>Hazardous Chemicals </option><option> Hazardous Material</option>
                      <option>Insulated or thermal containers </option><option>Kitchenware </option><option>Logs </option><option> Machinery</option>
                      <option>Machinery parts </option><option> Mail</option><option> Meat</option><option>Metal </option>
                      <option>Metal Rolls </option><option>Motor Vehicle </option><option>Motor Vehicle Spares </option><option> Motorcycle</option>
                      <option>Non Hazardous Chemicals </option><option>Paints </option><option>Paper </option><option> Perishable Goods</option>
                      <option> Personal Effects</option><option> Rolls of cables</option><option> Rubber</option><option> Sheet metal</option>
                      <option> Tanks</option><option> Valuable Goods</option><option>Wire </option><option> Wire – Rolls </option>
                      <option>Wood </option>
                      </select>
                        
                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                         @if ($errors->has('type_ofshipment'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('type_ofshipment') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('product_name') ? ' has-error' : '' }}" >
                        <input type="text" class="form-control" value="{{ old('product_name') }}" name="product_name" id="product_name" placeholder="Package/Parcel Name">
                        <span class="fa fa-pencil form-control-feedback right" aria-hidden="true"></span>
                               @if ($errors->has('product_name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('product_name') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('qty') ? ' has-error' : '' }} ">
                        <input type="text" name="qty" value="{{ old('qty') }}" class="form-control has-feedback-left" placeholder="Quantity" id="qty">
                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                       @if ($errors->has('qty'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('qty') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('weight') ? ' has-error' : '' }}" >
                        <input type="text" class="form-control" value="{{ old('weight') }}" name="weight" id="weight" placeholder="Weight(Kg)">
                        <span class="fa fa-pencil form-control-feedback right" aria-hidden="true"></span>
                               @if ($errors->has('weight'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('description') ? ' has-error' : '' }} ">
                        <textarea type="text" class="form-control"  name="description" id="description" placeholder="Shipment Description" rows="5"></textarea>
                       @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <input type="hidden" value="Road" name="mode" id="mode">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('cons_no') ? ' has-error' : '' }} ">
                        <input type="text" name="cons_no" class="form-control has-feedback-right" placeholder="Consignment Number" id="cons_no" readonly="readonly" value="{{ $consignment_No }}">
                        <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                      @if ($errors->has('cons_no'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('cons_no') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <input type="hidden" class="form-control" readonly="readonly" value="Pending" name="status" id="status">

                     


                  
                      <div class="form-group">
                      <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="submit">
                                    <i class="fa fa-btn fa-user"></i> Submit Request
                                </button>
                                <button class="btn btn-success" type="reset">Reset</button>
                            </div>
                        </div>
                      </div>

                    </form>
                   
                      
                                        
                            
                            






                  <div class="x_title">
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  
                    
                  </div>
                </div>
              </div>



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

    var input = document.getElementById('search_destination_places'); //get element to use as input for autocomplete
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


    
</script>

            </div>

        <!-- /page content -->
        @endsection()