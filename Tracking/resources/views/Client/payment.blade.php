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
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
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
                            <li><a href="{{ url('Client/dashboard') }}"><i class="fa fa-home"></i>Dashboard</a></li>
                            <li><a><i class="fa fa-table"></i> Shipments <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ url('Client/sendpackage') }}">Send Shipment</a></li>
                                    <li><a href="{{ url('Client/requests') }}">Your Shipping Orders</a></li>
                                </ul>
                            </li>
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
                                <li><a href="{{ url('Client/edit_profile') }}"> Profile</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
    <!-- page content -->
        <div class="right_col" role="main" style="color: black;">
            <div class="">
                <div class="clearfix">
                    @include('flash::message')
                    <p>Payment for shipment <strong>Cons #{{ $payment->ref_number }}</strong></p>
                    <p>Status :
                        @if($payment->status == 'payment-pending')
                            <span class="label label-warning">payment pending</span>
                        @endif
                        @if($payment->status == 'paid')
                            <span class="label label-success">paid</span>
                        @endif
                        @if($payment->status == 'initialized')
                            <span class="label label-info">payment initialized</span>
                        @endif
                        @if($payment->status == 'cancelled')
                            <span class="label label-danger">payment cancelled</span>
                        @endif
                        @if($payment->status == 'timed-out')
                            <span class="label label-danger">payment timed out</span>
                        @endif
                    </p>
                </div>
                <table class="table table-bordered table-condensed">
                    <tr>
                        <th>Amount</th>
                        <td align="right">Ksh {{ $payment->amount }}</td>
                    </tr>
                </table>
                @if($payment->status == 'payment-pending')
                    <button class="btn btn-sm btn-primary" id="payment-btn">initialize payment</button>
                @else
                   @if($payment->status == 'initialized' || $payment->status == 'cancelled' || $payment->status == 'timed-out')
                        <button class="btn btn-sm btn-primary" id="payment-btn">re-initialize payment</button>
                        <button class="btn btn-sm btn-secondary"  id="confirm-btn">confirm payment</button>
                   @endif
                @endif
            </div>
        </div>

<!-- /page content -->

<script type="text/javascript">
    function confirmDelete(id){
        $("input[name='id']").val(id);
    }

</script>

<!-- jQuery -->
<script src="../../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../../vendors/nprogress/nprogress.js"></script>

<!-- Custom Theme Scripts -->
<script src="../../build/js/custom.min.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    $('#payment-btn').click(function(){
        this.disabled = true;
        this.innerHTML = "loading";
        axios.post("{{ url('payment/initialize') }}", {
            'payment_id' : '{{ $payment->id }}',
            'payment' : 'mpesa',
            'phone' : '{{ $payment->phone }}'
        })
            .then(function(response) {
                if (response.data.success) {
                    window.location.reload(false)
                }
            })
    });
    $('#confirm-btn').click(function(){
        this.disabled = true;
        this.innerHTML = "loading";
        axios.post("{{ url('payment/confirm') }}", {
            'payment_id' : '{{ $payment->id }}',
        })
            .then(function(response) {
                if (response.data.success) {
                    if (response.data.hasOwnProperty('redirect')) {
                        window.location.href = response.data.redirect;
                    } else {
                        window.location.reload(false)
                    }
                }
            })
    });
</script>
    </div>
</div>
</body>
</html>