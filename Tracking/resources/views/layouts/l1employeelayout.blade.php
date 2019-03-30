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
    <link href="./../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="./../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="./../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="./../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="./../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="./../../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="./../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="./../../build/css/custom.min.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="./../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="./../../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="./../../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="./../../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="./../../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="./../../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    

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
                <img src="../../images/deltrucks.png" alt="..." class="img-circle profile_img">
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
                <h3>Role: {{ Auth::user()->role }}</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ url('Employee/dashboard') }}"><i class="fa fa-home"></i>Dashboard</a></li>
                  <li><a><i class="glyphicon glyphicon-shopping-cart"></i> Shipments <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('Employee/pending_orders') }}"><i class="fa fa-pencil"></i>&nbsp;Pending</a></li>
                      <li><a href="{{ url('Employee/approved_orders') }}"><i class="fa fa-check-circle"></i>&nbsp;Approved</a></li>
                      <li><a href="{{ url('Employee/cancelled_orders') }}"><i class="fa fa-times-circle"></i>&nbsp;Cancelled</a></li>
                      <li><a href="{{ url('Employee/intransit_orders') }}"><i class="fa fa-truck"></i>&nbsp;In Transit</a></li>
                      <li><a href="{{ url('Employee/delivered_orders') }}"><i class="fa fa-thumbs-o-up"></i>&nbsp;Delivered</a></li>
                    </ul>
                  </li>
                  <li><a href="{{ url('Employee/trackshipment') }}"><i class="glyphicon glyphicon-map-marker"></i> Track Shipment</a></li>
                  <li><a href="{{ url('Employee/users') }}"><i class="fa fa-users"></i>Clients</a></li>
                  <li><a href="{{ url('Employee/containers') }}"><i class="fa fa-truck"></i> Delivery Trucks </a></li>
                  <!-- <li><a href="{{ url('Employee/offices') }}"><i class="glyphicon glyphicon-tasks"></i>  Offices </a></li> -->
                  <li><a><i class="glyphicon glyphicon-tasks"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('Employee/pending_orders_report') }}">Pending Orders</a></li>
                      <li><a href="{{ url('Employee/intransit_orders_report') }}">On Transit Orders</a></li>
                      <li><a href="{{ url('Employee/delivered_orders_report') }}">Delivered Orders</a></li>
                      <li><a href="{{ url('Employee/undelivered_orders_report') }}">Un-Delivered Orders</a></li>
                      <li><a href="{{ url('Employee/cancelled_orders_report') }}">Cancelled Orders</a></li>
                      <li><a href="{{ url('Employee/clients_report') }}">Customers</a></li>
                      <li><a href="{{ url('Employee/containers_report') }}">Delivery Trucks</a></li>
                      <li><a href="{{ url('Employee/offices_report') }}">Offices/Branches</a></li>
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

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('/logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
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
        
 @yield('content')
 </div>

        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            CARGO SERVICES AND TRACKING SYSTEM
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      

  


  <!-- jQuery -->
    <!-- jQuery -->
    <script src="./../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="./../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="./../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="./../../vendors/nprogress/nprogress.js"></script>
    <!-- gauge.js -->
    <script src="./../../vendors/gauge.js/dist/gauge.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="./../../build/js/custom.min.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="./../../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script>
    $('#myDatepicker').datetimepicker();
    
    $('#myDatepicker2').datetimepicker({
        format: 'DD.MM.YYYY'
    });
    
    $('#myDatepicker3').datetimepicker({
        format: 'hh:mm A'
    });
    
    $('#myDatepicker4').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true
    });

    $('#datetimepicker6').datetimepicker();
    
    $('#datetimepicker7').datetimepicker({
        useCurrent: false
    });
    
    $("#datetimepicker6").on("dp.change", function(e) {
        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });
    
    $("#datetimepicker7").on("dp.change", function(e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });
</script>

<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
    <script type="text/javascript">
      @if (count($errors) > 0)
      $('#modalDefault').modal('show');
      @endif
    </script>

  </body>
  </html>