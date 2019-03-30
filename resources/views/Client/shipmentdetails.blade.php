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
                  <li><a href="{{ url('Client/dashboard') }}"><i class="fa fa-home"></i>Dashboard</a></li>
                  <li><a><i class="fa fa-table"></i> Shipments <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('Client/sendpackage') }}">Send Shipment</a></li>
                      <li><a href="{{ url('Client/requests') }}">Your Shipping Orders</a></li>
                    </ul>
                  </li>
                  <li><a href="{{ url('Admin/users') }}"><i class="fa fa-truck"></i> Invoices </a></li>
                  <li><a href="{{ url('Client/trackshipment') }}"><i class="glyphicon glyphicon-map-marker"></i> Track Your Shipment </a></li>
                  <li><a><i class="glyphicon glyphicon-th-list"></i> Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('Client/edit_profile') }}">Edit Profile</a></li>
                      <li><a href="{{ url('Client/change_password') }}">Change Password</a></li>
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
                    <i class="glyphicon glyphicon-user"></i>&nbsp;{{ Auth::user()->name }}
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

        @include('flash::message')
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
             @foreach($shipments as $shipment)
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Shipment Invoice</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row"> 
                        <div class="col-xs-12 invoice-header">
                          <h2>Shipment Details.<small class="pull-right"><strong>Date and Time:</strong>  {{ $shipment->created_at }}</small></h2>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          From
                          <address>
                                          <strong>Name: {{ $shipment->sender_name }}</strong>
                                          <br>Address: {{ $shipment->sender_address }}
                                          <br>Location: {{ $shipment->from_location }}
                                          <br>Phone: {{ $shipment->sender_contact }}
                                          <br>Email: {{ $shipment->sender_email }}
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          To
                          <address>
                                          <strong>Name: {{ $shipment->receiver_name }}</strong>
                                          <br>Address: {{ $shipment->receiver_address }}
                                          <br>Location: {{ $shipment->to_location }}
                                          <br>Phone: {{ $shipment->receiver_contact }}
                                          
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
                                <th>Cons No/ID</th>
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
                                <td>{{ $shipment->created_at }}</td>
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
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                           {{ $shipment->description }}.
                          </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Shipping cost</p>
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
                        
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" action="action" onclick="window.history.go(-1); return false;" type="button"><i class="glyphicon glyphicon-arrow-left"></i>Go back</button>
                          
                        </div>
                      </div>
                       
                          
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

    <script type="text/javascript">
  function confirmDelete(id){
    $("input[name='id']").val(id);
  }
  
</script>

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
  </body>
</html>