@extends('layouts.clientlayout')
@section('content')
@include('flash::message')

        <!-- page content -->

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>All Your Shipments</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <a href="{{ url('Client/sendpackage') }}" class="btn btn-success btn-sm "><i class="glyphicon glyphicon-shopping-cart"></i> Add Shipment </a>
                  <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Date</th>
                          <th>Cons no</th>
                          <th>Receivers name</th>
                          <th>Senders Address</th>
                          <th>Receivers address</th>
                          <th>Contact</th>
                          <th>From</th>
                          <th>To</th>
                          <th>Status</th>
                           <th>Details</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($shipments as $shipment)
                        <tr>
                         <?php 
                        $id = "delete_user".$shipment->id;

                         ?>
                        <td>{{ $shipment->id }}</td>
                        <td>{{ $shipment->created_at }}</td>
                        <td>{{ $shipment->cons_no }}</td>
                        <td>{{ $shipment->receiver_name }}</td>
                        <td>{{ $shipment->sender_address }}</td>
                          <td>{{ $shipment->receiver_address }}</td>
                          <td>{{ $shipment->receiver_contact }}</td>
                          <td>{{ $shipment->from_location }}</td>
                          <td>{{ $shipment->to_location }}</td>
                          <td><button class="btn btn-info btn-xs">{{ $shipment->status }}</button></td>
                          <td><a href="{{ url('Client/shipmentdetails/'.$shipment->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-folder"></i> View </a><button data-toggle="modal" href="#modalDefault" onclick="return editUser('{{ $shipment->id }}','{{ $shipment->sender_name }}','{{ $shipment->sender_contact }}','{{ $shipment->from_location }}','{{ $shipment->sender_address }}','{{ $shipment->receiver_name }}','{{ $shipment->receiver_contact }}','{{ $shipment->to_location }}','{{ $shipment->receiver_address }}','{{ $shipment->type_ofshipment }}','{{ $shipment->product_name }}','{{ $shipment->qty }}','{{ $shipment->weight }}','{{ $shipment->description }}','{{ $shipment->mode }}')" class="btn btn-success btn-sm "><i class="fa fa-pencil"></i> Edit </button></td>
                          
                          <td> 
                          <?php
                          $status=$shipment->status ;

                          if ($status=='Pending'){?>
                          <a class="btn btn-warning btn-sm waves-effect waves-light remove-record" onclick="return confirmCancel('{{ $shipment->id }}')" data-toggle="modal" data-url="{!! URL::to('Client/requests/cancel/', $shipment->id) !!}" data-id="{{$shipment->id}}" data-target="#confirmCancel"><i class="fa fa-trash"></i>&nbsp;Cancel</a>

                          <?php

                          }else{

                          }
                          ?>
                            
                            <a class="btn btn-danger btn-sm waves-effect waves-light remove-record" onclick="return confirmDelete('{{ $shipment->id }}')" data-toggle="modal" data-url="{!! URL::to('Client/requests/delete', $shipment->id) !!}" data-id="{{$shipment->id}}" data-target="#confirmDelete"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                          
                          </td>
                        </tr>
                         @endforeach
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>
<!-- Delete confirm modal -->
<form action="{{ URL::to('Client/requests/delete') }}" method="POST" class="remove-record-model">
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
                    <H4 class="text-center">Are you sure you want to delete this shipment?</H4>
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
 <!-- Cancel confirm modal -->
<form action="{{ URL::to('Client/requests/cancel/') }}" method="POST" class="remove-record-model">
{{csrf_field()}}

    <div id="confirmCancel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Cancel Confirmation</h4>
                </div>
                <div class="modal-body">
                    <H4 class="text-center">Are you sure you want to cancel this shipment?</H4>
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="status" value="Cancelled" >
                </div>
                <div class="modal-footer">
                
                    <div class="col-md-6 col-md-offset-4">
                  <button type="button"  data-dismiss="modal" class="btn btn-success">
                    <i class="glyphicon glyphicon-remove"></i>No
                  </button>
                  <button type="submit" class="btn btn-warning">
                      <i class="glyphicon glyphicon-ok-circle"></i> Yes
                  </button>
                                 
                            
                </div>

                </div>
            </div>
        </div>
    </div>
</form>
 <!-- /Cancel Confirm modals -->


              <!-- Small modal -->

                  <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update Shipment &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a data-dismiss="modal"><i class="fa fa-close"></i></a></h4>
                                        </div>

                    
                                        <div class="modal-body">
                                            <!-- New Task form-->
                          <form name="car_form" action="{{ URL::to('Client/requests')}}" method="POST" class="form-horizontal">
                    {!! csrf_field() !!}

                    <input type="hidden" name="id" id="id">

                    <div class="x_title">
                    <h2><small>Shipper Infor</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Shipper Name<span style="color: red;">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="sender_name" id="sender_name" value="{{ old('sender_name') }}">
                           @if ($errors->has('sender_name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('sender_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number<span style="color: red;">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="sender_contact" id="sender_contact" value="{{ old('sender_contact') }}">
                           @if ($errors->has('sender_contact'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('sender_contact') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pickup Location(City/Town/Area)<span style="color: red;">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="from_location" id="from_location" value="{{ old('from_location') }}">
                           @if ($errors->has('from_location'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('from_location') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address<span style="color: red;">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="sender_address" id="sender_address" value="{{ old('sender_address') }}">
                           @if ($errors->has('sender_address'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('sender_address') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="x_title">
                    <h2><small>Receiver Infor</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Receiver Name<span style="color: red;">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="receiver_name" id="receiver_name" value="{{ old('receiver_name') }}">
                           @if ($errors->has('receiver_name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('receiver_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                       
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number<span style="color: red;">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="receiver_contact" id="receiver_contact" value="{{ old('receiver_contact') }}">
                           @if ($errors->has('receiver_contact'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('receiver_contact') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Delivery Location(City/Town/Area)<span style="color: red;">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="to_location" id="to_location" value="{{ old('to_location') }}">
                           @if ($errors->has('to_location'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('to_location') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address<span style="color: red;">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="receiver_address" id="receiver_address" value="{{ old('receiver_address') }}">
                           @if ($errors->has('receiver_address'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('receiver_address') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="x_title">
                    <h2><small>Shipment Infor</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Type of Shipment<span style="color: red;">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="type_ofshipment" id="type_ofshipment" value="{{ old('type_ofshipment') }}">
                            <option>Document</option>
                            <option>Parcel</option>
                            <option>Option three</option>
                            <option>Option four</option>
                          </select>
                           @if ($errors->has('type_ofshipment'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('type_ofshipment') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Name<span style="color: red;">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" value="{{ old('product_name') }}" name="product_name" id="product_name">
                           @if ($errors->has('product_name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('product_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Quantity<span style="color: red;">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" value="{{ old('qty') }}" name="qty" id="qty">
                           @if ($errors->has('qty'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('qty') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Weight(Kg)<span style="color: red;">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" value="{{ old('weight') }}" name="weight" id="weight">
                           @if ($errors->has('weight'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Description<span style="color: red;">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea  class="form-control"  name="description" id="description"></textarea>
                           @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="hidden" class="form-control" value="Road" name="mode" id="mode">
                           @if ($errors->has('mode'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('mode') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      
                     
                      
                      <div class="ln_solid"></div>


                      <div class="form-group">
                      <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-ok-circle"></i> Update
                                </button>
                                <button type="button"  data-dismiss="modal" class="btn btn-primary">
                                            <i class="glyphicon glyphicon-remove"></i>Close
                                          </button>
                            </div>
                        </div>
                      </div>
  
                  </form>
                          </div>
                                        
                                    </div>
                                </div>
                            </div>
                  <!-- /modals -->

            </div> </div>


<script type="text/javascript">
  function editUser(id,sender_name,sender_contact,from_location,sender_address,receiver_name,receiver_contact,to_location,receiver_address,type_ofshipment,product_name,qty,weight,description,mode)
  {
    $("input[name='id']").val(id);
         $("input[name='sender_name']").val(sender_name);
         $("input[name='sender_contact']").val(sender_contact);
         $("input[name='from_location']").val(from_location);
         $("input[name='sender_address']").val(sender_address);
         $("input[name='receiver_name']").val(receiver_name);
         $("input[name='receiver_contact']").val(receiver_contact);
         $("input[name='to_location']").val(to_location);
         $("input[name='receiver_address']").val(receiver_address);
         $("select[name='type_ofshipment']").val(type_ofshipment);
         $("input[name='product_name']").val(product_name);
         $("input[name='qty']").val(qty);
         $("input[name='weight']").val(weight);
         $("textarea[name='description']").val(description);
         $("select[name='mode']").val(mode);
  }

  function confirmDelete(id){
    $("input[name='id']").val(id);
  }
    function confirmCancel(id){
    $("input[name='id']").val(id);
  }
  
</script>
        <!-- /page content -->
        
        @endsection()