@extends('layouts.clientlayout')
@section('content')
@include('flash::message')
<?php $title='Dashboard';?>
       
          <!-- top tiles -->
          <div class="row top_tiles">
              
              <div class="animated flipInY col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">{{$total_pendingshipments }}</div>
                  <h2 style="color: black;">Pending Shipments</h2>
                  
                </div>
              </div>

              
              <div class="animated flipInY col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count">{{$total_deliveredshipments}}</div>
                  <h2 style="color: black;">Delivered Shipments</h2>
                  
                </div>
              </div>
              
              
              
            </div>

          <!-- /top tiles -->



          <div class="row">

            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Overview</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p></p>
                      </th>
                    </tr>
                    <tr>
                      
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i> <a href="{{ url('Client/sendpackage') }}">Pickup Request</a> </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i><a href="{{ url('Client/requests') }}">My shipment</a> </p> 
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i><a href="{{ url('Client/trackshipment') }}">Track Shipments</a> </p>
                            </td>
                          </tr>
                          
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i><a href="{{ url('Client/edit_profile') }}">Edit Profile</a> </p>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i> <a href="{{ url('Client/change_password') }}">Change Password</a> </p>
                            </td>
                          </tr>
                          
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>

              <div class="col-md-9 col-sm-3 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Shipping Cost</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p></p>
                      </th>
                    </tr>
                    <tr>
                      
                      <td>
                        <table class="table table-striped table-bordered b">
                      <thead>
                        <tr>
                          <th>Weight (Kg)</th>
                          <th>Rate (Ksh)</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($shippingrates as $shippingrate)
                        <tr>
                          <td>{{ $shippingrate->weight_from }} - {{ $shippingrate->weight_to }}</td>
                          <td>{{ $shippingrate->rate }}</td>
                          
                        </tr>
                         @endforeach
                      </tbody>
                    </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>

            

          </div>
       
@endsection()
