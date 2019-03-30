@extends('../layouts.loginlayout')
@section('content')
@include('flash::message')
  <body class="login" >
    
    <div>
      <div class="profile_pic">
      <img src="./images/bg.jpg" alt="..." class="img-circle profile_img">
    </div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper" style="color: black;">
        
          <section class="login_content"> <strong><p> CARGO SERVICES AND TRACKING SYSTEM</p></strong> 
            <form method="POST" action="{{ url('/login') }}">
           
            <h1>Login </h1>
            {{ csrf_field() }}
              
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required="" placeholder="Email Address">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required="" placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
              </div>

<!--               <div class="form-group">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" id="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                </div> -->

              <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
              </div>


              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="{{ url('/register') }}" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />
                

                
@endsection()