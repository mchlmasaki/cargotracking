@extends('layouts.employeelayout')
@section('content')
@include('flash::message')
<?php $title='Dashboard';?>
       
          <!-- top tiles -->
          <div class="row top_tiles">
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                  <div class="count">{{ $total_clients }}</div>
                  <h2 style="color: black;">New Clients</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count">{{ $total_containers }}</div>
                  <h2 style="color: black;">No. of Trucks</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">{{ $total_newshipments }}</div>
                  <h2 style="color: black;">Pending Shipments</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">{{ $total_approvedshipments }}</div>
                  <h2 style="color: black;">Approved Shipments</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                  <div class="count">{{ $total_intransitshipments }}</div>
                  <h2 style="color: black;">In Transit Shipments</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count">{{ $total_deliveredshipments }}</div>
                  <h2 style="color: black;">Delivered Shipments</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">{{ $total_completedshipments }}</div>
                  <h2 style="color: black;">Completed Shipments</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">{{ $total_undeliveredshipments }}</div>
                  <h2 style="color: black;">Un-Delivered</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">{{ $total_cancelledshipments }}</div>
                  <h2 style="color: black;">Cancelled</h2>
                  
                </div>
              </div>
            </div>

          <!-- /top tiles -->



          <div class="row">



            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Shipping Summary Performance</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Pending Shipments ({{ $total_newshipments }})</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar progress-bar-dark" role="progressbar" data-transitiongoal="{{ $total_newshipments }}"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Approved Shipments ({{ $total_approvedshipments }})</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar progress-bar-gray" role="progressbar" data-transitiongoal="{{ $total_approvedshipments }}"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Shipments In Transit ({{ $total_intransitshipments }})</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar progress-bar-info" role="progressbar" data-transitiongoal="{{ $total_intransitshipments }}"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Delivered Shipments ({{ $total_deliveredshipments }})</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="{{ $total_deliveredshipments }}"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  </div>
                </div>
              </div>
            </div>



            <div class="col-md-2 col-sm-3 col-xs-12">
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
                              <p><i class="fa fa-square blue"></i> <a href="{{ url('Employee/pending_orders') }}">Shipments</a> </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i><a href="{{ url('Employee/trackshipment') }}">Track Shipments</a> </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i><a href="{{ url('Employee/containers') }}">Delivery Trucks</a> </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i> <a href="{{ url('Employee/users') }}">Customers</a> </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i><a href="{{ url('Employee/change_password') }}">Change Password</a> </p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>

              <div class="col-md-6 col-sm-3 col-xs-12">
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
