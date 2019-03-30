@extends('layouts.clientlayout')
@section('content')
@include('flash::message')
<?php $title='Dashboard';?>
       
          <!-- top tiles -->
          <div class="row top_tiles">
              
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">1</div>
                  <h2 style="color: black;">Pending Shipments</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">2</div>
                  <h2 style="color: black;">Approved Shipments</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                  <div class="count">{{ total_intransitshipments }}</div>
                  <h2 style="color: black;">In Transit Shipments</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count">2</div>
                  <h2 style="color: black;">Delivered Shipments</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">5</div>
                  <h2 style="color: black;">Picked/Completed Shipments</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">{{ total_undeliveredshipments }}</div>
                  <h2 style="color: black;">Un-Delivered</h2>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">{{ total_cancelledshipments }}</div>
                  <h2 style="color: black;">Cancelled</h2>
                  
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
                              <p><i class="fa fa-square blue"></i> <a href="{{ url('Employee/pending_orders') }}">Shipments</a> </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i><a href="{{ url('Employee/pending_orders') }}">Track Shipments</a> </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i><a href="{{ url('Employee/pending_orders') }}">Containers</a> </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i> <a href="{{ url('Employee/pending_orders') }}">Customers</a> </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i><a href="{{ url('Employee/pending_orders') }}">Branches/Offices</a> </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i><a href="{{ url('Employee/pending_orders') }}">Shipping Cost</a> </p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i><a href="{{ url('Employee/pending_orders') }}">Account Settings</a> </p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>

            

          </div>
       
@endsection()
