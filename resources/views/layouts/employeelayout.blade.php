<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cargo Tracking | {{ $title }} </title>

    <!-- Bootstrap -->
    <link href="../../public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../public/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../public/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="../../public/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../../public/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../../public/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../public/build/css/custom.min.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="../../publicvendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../publicvendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../../public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../../publicvendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../../publicvendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('Admin/dashboard') }}" class="site_title"><i class="fa fa-paw"></i> <span>Cargo Tracking</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../../public/images/img.jpg" alt="..." class="img-circle profile_img">
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
                  <li><a href="{{ url('Employee/users') }}"><i class="fa fa-users"></i>Clients</a></li>
                  <li><a href="{{ url('Employee/containers') }}"><i class="fa fa-truck"></i> Containers </a></li>
                  <!-- <li><a href="{{ url('Employee/offices') }}"><i class="glyphicon glyphicon-tasks"></i>  Offices </a></li> -->
                  <li><a><i class="glyphicon glyphicon-tasks"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('Employee/pending_orders_report') }}">Pending Orders</a></li>
                      <li><a href="{{ url('Employee/intransit_orders_report') }}">On Transit Orders</a></li>
                      <li><a href="{{ url('Employee/delivered_orders_report') }}">Delivered Orders</a></li>
                      <li><a href="{{ url('Employee/undelivered_orders_report') }}">Un-Delivered Orders</a></li>
                      <li><a href="{{ url('Employee/cancelled_orders_report') }}">Cancelled Orders</a></li>
                      <li><a href="{{ url('Employee/clients_report') }}">Customers</a></li>
                      <li><a href="{{ url('Employee/containers_report') }}">Containers</a></li>
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
   <script src="../vendors/maps/jquery172.js"></script>
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/jquery/dist/Chart.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
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