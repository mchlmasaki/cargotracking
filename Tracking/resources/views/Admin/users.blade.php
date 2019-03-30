@extends('layouts.adminlayout')
@section('content')
@include('flash::message')

        <!-- page content -->

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Clients</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <button data-toggle="modal" href="#modalDefault" class="btn btn-success btn-sm "><i class="fa fa-plus"></i> Add Clients </button>
                  <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>id</th> <th>Client</th> <th>Contact</th> <th>Email</th>
                          <th>Role</th> <th>Account Status</th> <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($users as $user)
                        <tr>
                        <td>{{ $user->id }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->contact }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->role }}</td> 
                          <td>
                            <?php
                            $accntstatus=$user->verified;
                            if($accntstatus=='1'){
                              echo'<button class="btn btn-success btn-sm ">Verified<i class="fa fa-check"></i> </button>';
                            }else{echo'<button class="btn btn-danger btn-xs ">Not Verified <i class="fa fa-close"></i></button>';}
                            ?></td>
                          <td>
                          <button data-toggle="modal" href="#updateModal" onclick="return editUser('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}','{{ $user->contact }}')" class="btn btn-success btn-sm "><i class="fa fa-edits"></i> Update </button>

                          <a class="btn btn-danger btn-sm waves-effect waves-light remove-record" onclick="return confirmDelete('{{ $user->id }}')" data-toggle="modal" data-url="{!! URL::to('Admin/users/delete', $user->id) !!}" data-id="{{$user->id}}" data-target="#confirmDelete"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                          </td>
                        </tr>
                         @endforeach
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>


<!-- Delete confirm modal -->
<form action="{{ URL::to('Admin/users/delete/') }}" method="POST" class="remove-record-model">
{{csrf_field()}}
{{method_field('delete')}}
    <div id="confirmDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <H4 class="text-center">Are you sure you want to delete this client?</H4>
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-footer">
                
                    <div class="col-md-6 col-md-offset-4">
                  <button type="button"  data-dismiss="modal" class="btn btn-success">
                    <i class="glyphicon glyphicon-remove"></i>No, Cancel
                  </button>
                  <button type="submit" class="btn btn-warning">
                      <i class="glyphicon glyphicon-ok-circle"></i> Yes, Delete
                  </button>
                                 
                            
                </div>

                </div>
            </div>
        </div>
    </div>
</form>
 <!-- /Delete Confirm modals -->


              <!-- Small modal -->

                  <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><center>Add Client</center> </h4>
                                        </div>

                                        <div class="modal-body">
                                            <!-- New Task form-->
                          <form name="user_form" action="{{ URL::to('Admin/users')}}" method="POST" class="form-horizontal">
                          {!! csrf_field() !!}
                          <?php 
                          function createRandomTransactionum() {
                            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                            srand((double)microtime()*1000000);
                            $i = 0;
                            $pass = '' ;
                            while ($i <= 7) {
                              $num = rand() % 33;
                              $tmp = substr($chars, $num, 1);
                              $pass = $pass . $tmp;
                              $i++;
                            }
                            return $pass;
                          }
                            $password = createRandomTransactionum();
                           ?>
                           <input type="hidden" id="id" name="id">
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if (!$errors->storeUserErrors->isEmpty())
                                    <div class="add">
                                        <span class="help-block" style="color: red;">
                                          <strong>{{ $errors->storeUserErrors->first('name') }}</strong>
                                        </span> 
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if (!$errors->storeUserErrors->isEmpty())
                                    <div class="add">
                                        <span class="help-block" style="color: red;">
                                          <strong>{{ $errors->storeUserErrors->first('email') }}</strong>
                                        </span> 
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Contact</label>

                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact" value="{{ old('contact') }}">

                                @if (!$errors->storeUserErrors->isEmpty())
                                    <div class="add">
                                        <span class="help-block" style="color: red;">
                                          <strong>{{ $errors->storeUserErrors->first('contact') }}</strong>
                                        </span> 
                                    </div>
                                @endif
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="verified" class="col-md-4 control-label"></label>

                            <div class="checkbox">
                            <label>
                              <input type="checkbox" value="1" name="verified"> Enable Portal Access
                            </label>
                          </div>
                        </div>

                        
                        
                        <input id="role" type="hidden" name="role" value="Client">
                        <input type="hidden" name="password" value="<?php echo $password; ?>">
                        <input type="hidden" name="password_confirmation" value="<?php echo $password; ?>">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                
                                 <button type="button"  data-dismiss="modal" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-remove"></i>Close
                                  </button>
                                  <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-ok-circle"></i> Register
                                </button>
                                
                            </div>
                        </div>


                            
                          </form>
                          </div>
                                        
                                    </div>
                                </div>
                            </div>
                  <!-- /modals -->
                  <!-- Update  modal -->

                  <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><center>Update Client</center> </h4>
                                        </div>

                                        <div class="modal-body">
                                            <!-- New Task form-->
                          <form name="user_form" action="{{ URL::to('Admin/users/update')}}" method="POST" class="form-horizontal">
                          {!! csrf_field() !!}
                          
                           <input type="hidden" id="id" name="id">
                          <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

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
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

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
                            <label for="email" class="col-md-4 control-label">Contact</label>

                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact" value="{{ old('contact') }}">

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
                            <label for="verified" class="col-md-4 control-label"></label>

                            <div class="checkbox">
                            <label>
                              <input type="checkbox" value="1" name="verified"> Enable Portal Access
                            </label>
                          </div>
                        </div>

                        
                        
                        <input id="role" type="hidden" name="role" value="Client">
                        <input type="hidden" name="password" >
                        <input type="hidden" name="password_confirmation" >

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                 <button type="button"  data-dismiss="modal" class="btn btn-primary">
                                            <i class="glyphicon glyphicon-remove"></i>Close
                                  </button>
                                  <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-ok-circle"></i> Update
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

<script type="text/javascript">
  function editUser(id,name,email,contact){
        $("input[name='id']").val(id);
         $("input[name='name']").val(name);
         $("input[name='email']").val(email);
         $("input[name='contact']").val(contact);
         
  }
  function confirmDelete(id){
    $("input[name='id']").val(id);
  }
  
</script>

<!-- /page content -->
@endsection()