@extends('layouts.adminlayout')
@section('content')
@include('flash::message')

        <!-- page content -->

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
              <div class="modal-header">
              <h4 class="modal-title">Add Office</h4>
              </div>

                                        
                    <form action="{{ URL::to('Admin/offices')}}" method="POST" class="form-horizontal form-label-left input_mask">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control has-feedback-left"  placeholder="Branch Office Name">
                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                        @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('city') ? ' has-error' : '' }}">
                        <select type="text" class="form-control has-feedback-left" name="city" id="city" value="{{ old('city') }}">
                        @foreach($towns as $town)
                        
                              <option value="{{ $town->town }}">{{ $town->town }} -  {{ $town->county }} County</option>
                           
                      @endforeach
                      </select>
                        <span class="" aria-hidden=""></span>
                         @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                        </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('location') ? ' has-error' : '' }} ">
                        <input type="text" name="location" value="{{ old('location') }}" class="form-control has-feedback-left" placeholder="Location" id="search_new_places">
                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                        @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('address') ? ' has-error' : '' }}" >
                        <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control" placeholder="Address">
                        <span class="fa fa-pencil form-control-feedback right" aria-hidden="true"></span>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('contact') ? ' has-error' : '' }}">
                        <input type="text" id="contact" name="contact" value="{{ old('contact') }}" class="form-control has-feedback-left" placeholder="Contact">
                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>

                                @if ($errors->has('contact'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                @endif
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback {{ $errors->has('contact_person') ? ' has-error' : '' }}">
                        <input type="text" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" class="form-control" placeholder="Contact Person">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>

                                @if ($errors->has('contact_person'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_person') }}</strong>
                                    </span>
                                @endif
                            </div>

                  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-9">
                          <button type="reset" class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success" name="submit_address" id="submit_address">Submit</button>
                        </div>
                      </div>

                    </form>
                      
                                        
                            
                                











                  <div class="x_title">
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Branch</th>
                          <th>City</th>
                          <th>Location</th>
                          <th>Address</th>
                          <th>Phone Number</th>
                          <th>Contact Person</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($offices as $office)
                        <tr>
                        
                        <td>{{ $office->id }}</td>
                          <td>{{ $office->name }}</td>
                          <td>{{ $office->city }}</td>
                          <td>{{ $office->location }}</td>
                          <td>{{ $office->address }}</td>
                          <td>{{ $office->contact }}</td>
                          <td>{{ $office->contact_person }}</td>
                          <td><button data-toggle="modal" href="#modalDefault" onclick="return editUser('{{ $office->id }}','{{ $office->name }}','{{ $office->city }}','{{ $office->location }}','{{ $office->address }}','{{ $office->contact }}','{{ $office->contact_person }}')" class="btn btn-success btn-xs "><i class="fa fa-edit"></i> edit </button> 
                          <a class="btn btn-danger btn-xs waves-effect waves-light remove-record" onclick="return confirmDelete('{{ $office->id }}')" data-toggle="modal" data-url="{!! URL::to('Admin/offices/delete', $office->id) !!}" data-id="{{$office->id}}" data-target="#confirmDelete"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                          </td>
                        </tr>
                         @endforeach
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>

<!-- Delete confirm modal -->
<form action="{{ URL::to('Admin/offices/delete/') }}" method="POST" class="remove-record-model">
{{csrf_field()}}
{{method_field('delete')}}
    <div id="confirmDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <H4 class="text-center">Are you sure you want to delete this office?</H4>
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-footer">
                
                    <div class="col-md-6 col-md-offset-4">
                  <button type="button"  data-dismiss="modal" class="btn btn-success">
                    <i class="glyphicon glyphicon-remove"></i>No, Cancel
                  </button>
                  <button type="submit" class="btn btn-warning">
                      <i class="glyphicon glyphicon-ok-circle"></i> Yes, Delete
                  </button>
                                 
                            
                </div>

                </div>
            </div>
        </div>
    </div>
</form>
 <!-- /Delete Confirm modals -->






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


<script type="text/javascript">
  function editUser(id,name,city,location,address,contact,contact_person)
  {
    $("input[name='id']").val(id);
    $("input[name='name']").val(name);
    $("select[name='city']").val(city);
    $("input[name='location']").val(location);
    $("input[name='address']").val(address);
    $("input[name='contact']").val(contact);
    $("input[name='contact_person']").val(contact_person);
  }
  function confirmDelete(id){
    $("input[name='id']").val(id);
  }
</script>
        <!-- /page content -->
        @endsection()