<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cargo Tracking </title>

    <!-- Bootstrap -->
    <link href="../../../public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../../public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../../public/vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom styling plus plugins -->
    <link href="../../../public/build/css/custom.min.css" rel="stylesheet">
  </head>

<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('Admin/dashboard') }}" class="site_title"><i class="fa fa-paw"></i> <span>Cargo Tracking!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../../../public/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>{{ Auth::user()->role }}</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ url('Employee/dashboard') }}"><i class="fa fa-home"></i>Dashboard</a></li>
                  <li><a><i class="glyphicon glyphicon-shopping-cart"></i> Shipments <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('Employee/pending_orders') }}"><i class="fa fa-pencil"></i>&nbsp;Pending</a></li>
                      <li><a href="{{ url('Employee/approved_orders') }}"><i class="fa fa-check-circle"></i>&nbsp;Approved</a></li>
                      <li><a href="{{ url('Employee/cancelled_orders') }}"><i class="fa fa-times-circle"></i>&nbsp;Cancelled</a></li>
                      <li><a href="{{ url('Employee/intransit_orders') }}"><i class="fa fa-truck"></i>&nbsp;In Transit</a></li>
                      <li><a href="{{ url('Employee/delivered_orders') }}"><i class="fa fa-thumbs-o-up"></i>&nbsp;Delivered</a></li>
                      <li><a href="{{ url('Employee/completed_orders') }}"><i class="fa fa-check-circle"></i>&nbsp;Completed</a></li>
                    </ul>
                  </li>
                  <li><a href="{{ url('') }}"><i class="glyphicon glyphicon-map-marker"></i> Track Shipment</a></li>
                  <li><a href="{{ url('Employee/users') }}"><i class="fa fa-users"></i>Customers</a></li>
                  <li><a><i class="fa fa-truck"></i> Cars <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('Employee/cars') }}">Cars</a></li>
                    </ul>
                  </li>
                  <li><a href="{{ url('Employee/offices') }}"><i class="glyphicon glyphicon-tasks"></i>  Offices </a></li>
                  <li><a><i class="glyphicon glyphicon-tasks"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Orders</a></li>
                      <li><a href="chartjs.html">Pending Orders</a></li>
                      <li><a href="chartjs.html">Delivered Orders</a></li>
                      <li><a href="chartjs.html">On Transit Orders</a></li>
                      <li><a href="chartjs2.html">Cusomers</a></li>
                      <li><a href="morisjs.html">Cars</a></li>
                    </ul>
                  </li>
                  <li><a><i class="glyphicon glyphicon-th-list"></i> Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('Employee/edit_profile') }}">Edit Profile</a></li>
                      <li><a href="{{ url('Employee/change_password') }}">Change Password</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">{{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>

             @foreach($shipments as $shipment)
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">@include('flash::message')

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h2>Shipment Details.<small class="pull-right"><strong>Date and Time:</strong>  {{ date('M d, Y', strtotime( $shipment->created_at )) }} {{  date('h:i A', strtotime($shipment->created_at)) }}</small></h2>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          From
                          <address>
                                          <strong>Sender's Name: </strong>{{ $shipment->sender_name }}
                                          <br><strong>Address: </strong>{{ $shipment->sender_address }}
                                          <br><strong>From: </strong>{{ $shipment->from_location }}
                                          <br><strong>Phone: </strong> {{ $shipment->sender_contact }}
                                          <br><strong>Email: </strong> ironadmin.com
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          To
                          <address>
                                          <strong>Receiver's Name: </strong>{{ $shipment->receiver_name }}
                                          <br><strong>Address: </strong>{{ $shipment->receiver_address }}
                                          <br><strong>To: </strong>{{ $shipment->to_location }}
                                          <br><strong>Phone: </strong> {{ $shipment->receiver_contact }}
                                          
                                      </address>
                        </div>
                        
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Cons No.</th>
                                <th>Status</th>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>From</th> <th>To</th>
                                <th>Order Date</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>{{ $shipment->cons_no }}</td>
                                <td><button class="btn btn-info btn-xs">{{ $shipment->status }}</button></td>
                                <td>{{ $shipment->qty }}</td>
                                <td>{{ $shipment->product_name }}</td>
                                <td>{{ $shipment->from_location }}</td>
                                <td>{{ $shipment->to_location }}</td>
                                <td>{{ date('M d, Y', strtotime( $shipment->created_at )) }} {{  date('h:i A', strtotime($shipment->created_at)) }}</td>
                              </tr>
                              
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          <p class="lead">Description:</p>
                          <textarea class="form-control text-muted well well-sm no-shadow" rows="5">
                          {{ $shipment->description }}.</textarea>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Shipping charges</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Weight:</th>
                                  <td>{{ $shipment->weight }}Kg</td>
                                </tr>
                                <tr>
                                  <th>Rate (per Kg):</th>
                                  <td>{{ $shipment->shipping_rate }}</td>
                                </tr>
                                <tr>
                                  <th>Total:</th>
                                  <td>Ksh.{{ $shipment->shipping_cost }}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        <?php
                          $status=$shipment->status ;
                          if($status=='Cancelled' || $status=='In Transit' || $status=='Delivered' || $status=='Completed'){
                            ?>
                            <div class="row no-print" id="cancel">
                        <div class="col-xs-12">
                          <button class="btn btn-default" action="action" onclick="window.history.go(-1); return false;" type="button"><i class="glyphicon glyphicon-arrow-left"></i>Go back</button>
                        </div>
                      </div>
                            <?php
                          }else{
                            ?>
                            <form name="edit_profile" action="{{ URL::to('Employee/shipmentdetails/{shipment}')}}" method="POST" class="form-horizontal" onsubmit="return confirmCancel()">
                          {!! csrf_field() !!}
                          <input type="hidden" name="id" value="{{ $shipment->id }}">
                          <input type="hidden" name="contact" value="{{ $shipment->sender_contact }}">
                          <input type="hidden" name="cons_no" value="{{ $shipment->cons_no }}">
                          <input type="hidden" name="sender_name" value="{{ $shipment->sender_name }}">
                          <input type="hidden" name="status" value="Cancelled" >
                          <p class="lead green">Cancel Shipment Order</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%" class="green">Consignment number:</th>
                                  <td>{{ $shipment->cons_no }}</td>
                                </tr>
                                <tr>
                                  <th class="green">Reason for cancellation:<span style="color: red;">*</span></th>
                                  <td>
                                    <textarea id="reason" type="text" class="form-control" name="reason" value="{{ old('reason') }}" rows="5" placeholder="Reason for cancellation"></textarea>

                                @if ($errors->has('reason'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('reason') }}</strong>
                                    </span>
                                @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p>Send response to:  {{ $shipment->sender_contact}} </p>
                          </p>
                          
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" action="action" onclick="window.history.go(-1); return false;" type="button"><i class="glyphicon glyphicon-arrow-left"></i>Go back</button>
                          <button type="submit" class="btn btn-warning pull-right" id="cancelButton" > Cancel shipment</button>
                        </div>
                      </div>
                       </form>
                            <?php
                          }
                          ?>
                    </section>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        <!-- /page content -->

        <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('/logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../../../public/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../../public/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../../public/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../../public/vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../../public/build/js/custom.min.js"></script>
    <script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
    <!-- <script type="text/javascript">
      $(document).ready(function(){
        $("#cancelButton").click(function(){
          $("#confirmCancel").modal();
        });
      });
    </script> -->
    <script type="text/javascript">
      function confirmCancel(){
        return confirm('Are you sure you want to cancel this shipment?');
      }
    </script>
  </body>
</html>