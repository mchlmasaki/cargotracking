@extends('../layouts.loginlayout')
@section('content')
<!-- @include('flash::message') -->
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
        
          <section class="login_content">
            <form method="POST" action="{{ url('/login') }}">
            <h1>Verify account </h1>
            {{ csrf_field() }}
              
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                            <p>Your account is not verified. Please go to your email and verify your account</p>
                                
                            </div>
              </div>

              
              <div class="form-group">
                            <div class="col-md-12">
                            <a href="{{ url('/login') }}"><button type="button" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Click here to login
                                </button></a>
                                

                                
                            </div>
              </div>


              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

                
@endsection()
<!-- <script type="text/javascript">
  setTimeout(function(){window.location=/logout},3000);
</script> -->