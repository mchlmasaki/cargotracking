@extends('layouts.adminlayout')
@section('content')
@include('flash::message')


       
          <!-- top tiles -->
          <div class="row tile_count">
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-group"></i> Total Employees</span>
              <div class="count">{{ $total_employees }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Customers</span>
              <div class="count">{{ $total_clients }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-group"></i> Branches</span>
              <div class="count">{{ $total_offices }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-automobile"></i> Delivery Trucks</span>
              <div class="count">{{ $total_containers }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i>New Requests</span>
              <div class="count">{{ $total_newshipments }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-shopping-cart"></i> In Transit</span>
              <div class="count">{{ $total_intransitshipments }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-share"></i> Delivered</span>
              <div class="count green">{{ $total_deliveredshipments }}</div>
            </div>
            
            
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="glyphicon glyphicon-shopping-cart"></i> Total Orders</span>
              <div class="count">{{ $total_shipment }}</div>
            </div>
          </div>
          <!-- /top tiles -->

          

          <div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>All Shipment Orders</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>New Request</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $total_newshipments }}%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>{{ $total_newshipments }}</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>In Transit</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $total_intransitshipments }}%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>{{ $total_intransitshipments }}</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Delivered</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-aero" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $total_deliveredshipments }}%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>{{ $total_deliveredshipments }}</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Total Request</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-red" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $total_shipment }}%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>{{ $total_shipment }}</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  

                </div>
              </div>
            </div>

            


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Quick Settings</h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="quick-list">
                      <li><i class="fa fa-calendar-o"></i><a href="{{ url('Admin/users') }}">Manage Clients</a></li>
                      <li><i class="fa fa-bar-chart"></i><a href="{{ url('Admin/employees') }}">Manage Employees</a> </li>
                      <li><i class="fa fa-bar-chart"></i><a href="{{ url('Admin/admins') }}">Manage Admins</a> </li>
                      <li><i class="fa fa-bar-chart"></i><a href="{{ url('Admin/charges') }}">Shipping Rates</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="{{ url('Admin/pending_orders') }}">Manage Shipments</a></li>
                      <li><i class="fa fa-bar-chart"></i><a href="{{ url('Admin/offices') }}">Manage Braches</a> </li>
                    </ul>

                  </div>
                </div>
              </div>
            </div>

                <!-- Start to do list -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Recommendations</h2>
                      
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <form name="container_form" action="{{ URL::to('Admin/recommendations')}}" method="POST" class="form-horizontal">
{!! csrf_field() !!}

<!--Task name-->


<!--Add Recommendation Button-->
<div class="form-group">
  <div class="">


    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label style="color: green;" >Select Town to get recommendations for it</label>

                            <div class="col-md-12">
                            <form name="container_form" action="{{ URL::to('Admin/recommendations')}}" method="POST" class="form-horizontal">
{!! csrf_field() !!}
                          <select class="form-control" id="town_id" type="text" class="form-control" name="town_id" >
                          @foreach($towns as $town)
                          <option value="{{ $town->id }}">{{ $town->town }} - {{ $town->county }} county</option>
                            @endforeach
                          </select>
                                

                                @if ($errors->has('id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                @endif
                              </form>
                            </div>
                        </div>

    <button type="submit" class="btn btn-success btn-sm ">
      <i class="fa fa-plus"></i>Get Recommendations
    </button>
  </div>
</div>
  
</form>

                    </div>
                  </div>
                </div>
                <!-- End to do list -->


          </div>
       
@endsection()