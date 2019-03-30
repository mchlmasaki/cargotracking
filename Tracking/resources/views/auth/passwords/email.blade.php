@extends('../../layouts.loginlayout')
@include('flash::message')
@section('content')
  <body class="login">
    <div class="profile_pic">
      <img src="../images/bg.jpg" alt="..." class="img-circle profile_img">
    </div>
    <div>

      <div class="login_wrapper" style="color: black;">
        
          <section class="login_content"> <strong><p> COURIER SERVICES AND TRACKING SYSTEM</p></strong> 
          
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}"> 

            {{ csrf_field() }}
           
            <h1>Reset Password </h1>

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                placeholder="Email Address">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
              </div>

              <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                                </button>
                                 
                            </div>
              </div>


              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member?
                  <a href="{{ url('/login') }}" class="to_register"> Login </a>
                </p>

                <div class="clearfix"></div>
                <br />

                
@endsection()