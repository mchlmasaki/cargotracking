 @extends('layouts.clientlayout')
@section('content')
@include('flash::message')


 <!-- page content -->
       
          <div class="">
            
            <div class="clearfix"></div>
            

            <div class="row">

              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Change Password</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form name="change_password" class="form-horizontal form-label-left" action="{{ URL::to('Client/change_password')}}" method="POST">
                    {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                      <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Old Password</label>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="oldpassword" type="password" class="form-control" name="oldpassword" value="{{ old('oldpassword') }}">

                                @if ($errors->has('oldpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('oldpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">New password</label>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password-confirm') }}">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary"><i class="glyphicon glyphicon-remove"></i> Reset</button>
                          <button type="submit" class="btn btn-success" ><i class="glyphicon glyphicon-ok-circle"></i> Update</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div></div>
          </div>
        <!-- /page content -->
        
        @endsection()