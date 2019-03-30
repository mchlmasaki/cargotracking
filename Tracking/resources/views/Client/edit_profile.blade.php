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
                    <h2>Profile Details</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left input_mask" >

                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly value="{{ Auth::user()->name }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly value="{{ Auth::user()->email }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly value="{{ Auth::user()->contact }}">
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      
                     
                    </form>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button data-toggle="modal" href="#updateModal" class="btn btn-success" onclick="return editUser('{{ Auth::user()->id }}','{{ Auth::user()->name }}','{{ Auth::user()->email }}','{{ Auth::user()->contact }}')"><i class="fa fa-edit"></i> Edit Profile </button>
                        </div>
                      </div>
                  </div>
                </div>
                              <!-- Small modal -->

                  <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <center><h4 class="modal-title">Edit Profile</h4></center> 
                                        </div>

                                        <div class="modal-body">
                                            <!-- New Task form--> 
                          <form name="edit_profile" action="{{ URL::to('Client/edit_profile')}}" method="POST" class="form-horizontal">
                          {!! csrf_field() !!}
                          <input type="hidden" name="id" value="{{ old('id') }}">

                          <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if (!$errors->updateUserErrors->isEmpty())
                                    <div class="update">
                                        <span class="help-block" style="color: red;">
                                          <strong>{{ $errors->updateUserErrors->first('name') }}</strong>
                                        </span> 
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if (!$errors->updateUserErrors->isEmpty())
                                    <div class="update">
                                        <span class="help-block" style="color: red;">
                                          <strong>{{ $errors->updateUserErrors->first('email') }}</strong>
                                        </span> 
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact" class="col-md-4 control-label">Contact</label>

                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact" value="{{ old('contact') }}" placeholder="+254712345678">

                                @if (!$errors->updateUserErrors->isEmpty())
                                    <div class="update">
                                        <span class="help-block" style="color: red;">
                                          <strong>{{ $errors->updateUserErrors->first('contact') }}</strong>
                                        </span> 
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                
                                 <button type="button"  data-dismiss="modal" class="btn btn-primary">
                                            <i class="glyphicon glyphicon-remove"></i>Close
                                  </button>
                                  <button type="submit" class="btn btn-primary" name="edit_profile" >
                                    <i class="glyphicon glyphicon-ok-circle"></i> Submit
                                </button>
                            </div>
                        </div>


                            
                          </form>
                          </div>
                                        
                                    </div>
                                </div>
                            </div>
                  <!-- /modals -->
              </div>
 
            </div>
 </div>
          <script type="text/javascript">
  function editUser(id,name,email,contact)
  {
    $("input[name='id']").val(id);
    $("input[name='name']").val(name);
    $("input[name='email']").val(email);
    $("input[name='contact']").val(contact);
  }
</script>
        <!-- /page content -->
        
@endsection()