@extends('layouts.employeelayout')
@section('content')
@include('flash::message')
<?php $title='Approved Shipments';?>

        <!-- page content -->

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Shipments <i class="fa fa-angle-right"></i> {{ $title }}</h5>
                    
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="col-md-12">

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                         <li role="presentation" class=""><a href="{{  url('Employee/all_orders') }}"  aria-expanded="true">All</a></li>
                          <li role="presentation" ><a href="{{  url('Employee/pending_orders') }}"  aria-expanded="true">Pending</a>
                          </li>
                          <li role="presentation" class="active"><a href="{{  url('Employee/approved_orders') }}" aria-expanded="true">Approved</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Employee/intransit_orders') }}"  aria-expanded="false">In Transit</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Employee/delivered_orders') }}"  aria-expanded="false">Delivered</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Employee/cancelled_orders') }}"  aria-expanded="false">Cancelled</a>
                        </ul>
                      </div>

                    </div>
                  
                  <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Client name</th>
                          <th>Client contact</th>
                          <th>Receiver name</th>
                          <th>Receiver contact</th>
                          <th>Type</th>
                          <th>From</th>
                          <th>To</th>
                          <th>Cons No.</th>
                          <th>Status</th>
                          <th>Details</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($shipments as $shipment)
                        <tr>
                          <td>{{ date('M d, Y', strtotime( $shipment->created_at )) }}</td>
                          <td>{{ $shipment->sender_name }}</td>
                          <td>{{ $shipment->sender_contact }}</td>
                          <td>{{ $shipment->receiver_name }}</td>
                          <td>{{ $shipment->receiver_contact }}</td>
                          <td>{{ $shipment->type_ofshipment }}</td>
                          <td>{{ $shipment->from_location }}</td>
                          <td>{{ $shipment->to_location }}</td>
                          <td>{{ $shipment->cons_no }}</td>
                          <td>
                            <?php
                            $status=$shipment->status;
                            if($status=='Approved'){
                              echo'<button class="btn btn-success btn-xs ">Approved</button>';
                            }else if($status=='Loaded'){echo'<button class="btn btn-info btn-xs ">Loaded </button>';}else{}
                            ?></td>
                          <td><a href="{{ url('Employee/shipmentdetails/'.$shipment->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-folder"></i> View </a></td>
                          <td>
                            <?php
                            $status=$shipment->status;
                            if($status=='Approved'){?>
                              <button data-toggle="modal" href="#modalDefault" onclick="return editUser('{{ $shipment->id }}','{{ $shipment->sender_name }}','{{ $shipment->sender_contact }}','{{ $shipment->weight }}','{{ $shipment->cons_no }}','{{ $shipment->from_location }}','{{ $shipment->to_location }}','{{ $shipment->status }}','{{ $shipment->nearest_town }}')" class="btn btn-success btn-sm "> Update </button><?php
                            }else if($status=='Loaded'){echo'';}
                            ?>

                          <a class="btn btn-danger btn-sm waves-effect waves-light remove-record" onclick="return confirmDelete('{{ $shipment->id }}')" data-toggle="modal" data-url="{!! URL::to('Employee/approved_orders/delete', $shipment->id) !!}" data-id="{{$shipment->id}}" data-target="#confirmDelete"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                          </td>

                        </tr>
                         @endforeach
                      </tbody>
                    </table>
                    
                    
                  </div>
                </div>
              </div>

<!-- Delete confirm modal -->
<form action="{{ URL::to('Employee/approved_orders/delete/') }}" method="POST" class="remove-record-model">
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


              <!-- Small modal -->

                  <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><center>Update Shipment Status</center> </h4>
                                        </div>

                                        <div class="modal-body">
                                            <!-- New Task form-->
                          <form name="user_form" action="{{ URL::to('Employee/approved_orders')}}" method="POST" class="form-horizontal">
                          {!! csrf_field() !!}
                          <input type="hidden" name="id">
                          <input id="weight" type="hidden" class="form-control" name="weight" >
                          <input id="sender_contact" type="hidden" class="form-control" name="sender_contact" >
                          <div class="form-group{{ $errors->has('cons_no') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Consignment Number</label>

                            <div class="col-md-8">
                                <input id="cons_no" type="text" class="form-control" name="cons_no" value="{{ old('cons_no') }}" readonly>

                                @if ($errors->has('cons_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cons_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group{{ $errors->has('from_location') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">From</label>

                            <div class="col-md-8">
                                <input id="from_location" type="text" class="form-control" name="from_location" value="{{ old('from_location') }}" readonly>

                                @if ($errors->has('from_location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('from_location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('to_location') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Destination</label>

                            <div class="col-md-8">
                                <input id="to_location" type="text" class="form-control" name="to_location" value="{{ old('to_location') }}" readonly>

                                @if ($errors->has('to_location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('to_location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="number_plate" class="col-md-4 control-label">Assign/Select Truck</label>

                            <div class="col-md-8">
                            
                          <select class="form-control" id="container_number" type="text" class="form-control" name="container_number" >

                            
                          @foreach($containers as $container)
                          <option value="{{ $container->container_number }}">{{ $container->name }} - {{ $container->office }}</option>
                            @endforeach
                          </select>
                                

                                @if ($errors->has('container_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('container_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Status</label>

                            <div class="col-md-8">
                              <input id="status" type="text" class="form-control" name="status" value="{{ old('status') }}" readonly>
                                

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input id="nearest_town" type="hidden" class="form-control" name="nearest_town" >
                  
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


                            
                          </form>
                          </div>
                                        
                                    </div>
                                </div>
                            </div>
                  <!-- /modals -->

            </div>


<script type="text/javascript">
  function editUser(id,sender_name,sender_contact,weight,cons_no,from_location,to_location,status,nearest_town)
  {
    $("input[name='id']").val(id);
    $("input[name='sender_name']").val(sender_name);
    $("input[name='sender_contact']").val(sender_contact);
    $("input[name='weight']").val(weight);
   $("input[name='cons_no']").val(cons_no);
   $("input[name='from_location']").val(from_location);
   $("input[name='to_location']").val(to_location);
   $("input[name='status']").val(status);
   $("input[name='nearest_town']").val(nearest_town);
  }

  function confirmDelete(id){
    $("input[name='id']").val(id);
  }
  
</script>
        <!-- /page content -->
        @endsection()