@extends('layouts.adminlayout')
@section('content')

        <!-- page content -->

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>ORDERS</h2>
                    
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="col-md-12">

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Pending Orders</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Processed Orders</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">In Transit</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Delivered Orders</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Completed Orders</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <p>Tab 1</p>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <p>Tab 2</p>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <p>Tab 3 </p>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                            <p>Tab 4</p>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                            <p>Tab 5</p>
                          </div>
                        </div>
                      </div>

                    </div>
                  <button data-toggle="modal" href="#modalDefault" class="btn btn-success btn-sm "><i class="fa fa-plus"></i> Add Officesdfgh </button>
                  <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Name</th>
                          <th>City/Location</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($offices as $office)
                        <tr>
                         <?php 
                        $id = "delete_user".$office->id;

                         ?>
                        <td>{{ $office->id }}</td>
                          <td>{{ $office->name }}</td>
                          <td>{{ $office->city }}</td>
                          <td><button data-toggle="modal" href="#modalDefault" onclick="return editUser('{{ $office->id }}','{{ $office->name }}','{{ $office->city }}')" class="btn btn-success btn-sm "><i class="fa fa-edit"></i> edit </button> &nbsp; | &nbsp;<button onclick="event.preventDefault(); document.getElementById('{{ $id }}').submit();" class="btn btn-danger btn-sm "><i class="fa fa-trash"></i> delete </button></td>

                  <form style="display: none" id="{{ $id }}" action="{{  URL::to('office/delete/'.$office->id) }}" method="POST">
                    
                    {!! csrf_field() !!}
                    {!! method_field('DELETE') !!}
                  </form>
                          </td>
                        </tr>
                         @endforeach
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>

              <!-- Small modal -->

                  <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Office</h4>
                                        </div>

                                        <div class="modal-body">
                                            <!-- New Task form-->
                          <form name="user_form" action="{{ URL::to('Admin/offices')}}" method="POST" class="form-horizontal">
                          {!! csrf_field() !!}
                          <input type="hidden" name="id">

                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">city</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}">

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                  
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Save
                                </button>
                                 <button type="button"  data-dismiss="modal" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>Close
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
  function editUser(id,name,city)
  {
    $("input[name='id']").val(id);
         $("input[name='name']").val(name);
         $("input[name='city']").val(city);
  }
</script>
        <!-- /page content -->
        @endsection()