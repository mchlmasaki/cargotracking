@extends('layouts.employeelayout')
@section('content')
@include('flash::message')
<?php $title='Delivered Shipments';?>

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
                          <li role="presentation" ><a href="{{  url('Employee/pending_orders') }}"  aria-expanded="true">Pending</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Employee/approved_orders') }}" aria-expanded="true">Approved</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Employee/intransit_orders') }}"  aria-expanded="false">In Transit</a>
                          </li>
                          <li role="presentation" class="active"><a href="{{  url('Employee/delivered_orders') }}"  aria-expanded="false">Delivered</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Employee/completed_orders') }}"  aria-expanded="false">Completed</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Employee/cancelled_orders') }}"  aria-expanded="false">Cancelled</a>
                        </ul>
                      </div>

                    </div>
                  
                  <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Senders Address</th>
                          <th>Receivers Name</th>
                          <th>Contact</th>
                          <th>Receivers Address</th>
                          <th>Type of Shipment</th>
                          <th>From</th>
                          <th>Destination</th>
                          <th>Consignment Number</th>
                          <th>Date</th>
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
                          <td>{{ $shipment->sender_name }}</td>
                          <td>{{ $shipment->receiver_name }}</td>
                          <td>{{ $shipment->receiver_contact }}</td>
                          <td>{{ $shipment->receiver_address }}</td>
                          <td>{{ $shipment->type_ofshipment }}</td>
                          <td>{{ $shipment->from_location }}</td>
                          <td>{{ $shipment->to_location }}</td>
                          <td>{{ $shipment->cons_no }}</td>
                          <td>{{ date('M d, Y', strtotime( $shipment->created_at )) }}</td>
                          <td><a href="{{ url('Employee/shipmentdetails/'.$shipment->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-folder"></i> View </a><button data-toggle="modal" href="#modalDefault" onclick="return editUser('{{ $shipment->id }}','{{ $shipment->sender_name }}','{{ $shipment->sender_contact }}','{{ $shipment->receiver_name }}','{{ $shipment->receiver_contact }}','{{ $shipment->cons_no }}','{{ $shipment->status }}')" class="btn btn-success btn-sm "><i class="fa fa-edit"></i> Update </button> 
                          <a class="btn btn-danger btn-sm waves-effect waves-light remove-record" onclick="return confirmDelete('{{ $shipment->id }}')" data-toggle="modal" data-url="{!! URL::to('Employee/delivered_orders/delete', $shipment->id) !!}" data-id="{{$shipment->id}}" data-target="#confirmDelete"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                          </td>

                        </tr>
                         @endforeach
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>

<!-- Delete confirm modal -->
<form action="{{ URL::to('Employee/delivered_orders/delete/') }}" method="POST" class="remove-record-model">
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
                                            <h4 class="modal-title">Update Shipment Status</h4>
                                        </div>

                                        <div class="modal-body">
                                            <!-- New Task form-->
                          <form name="user_form" action="{{ URL::to('Employee/delivered_orders')}}" method="POST" class="form-horizontal">
                          {!! csrf_field() !!}
                          <input type="hidden" name="id">
                          <input type="hidden" name="sender_name" >
                          <input type="hidden" name="sender_contact">
                          <input type="hidden" name="receiver_name" >
                          <input type="hidden" name="receiver_contact">
                          <div class="form-group{{ $errors->has('cons_no') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Consignment Number</label>

                            <div class="col-md-6">
                                <input id="cons_no" type="text" class="form-control" name="cons_no" value="{{ old('cons_no') }}" readonly>

                                @if ($errors->has('cons_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cons_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Status</label>

                            <div class="col-md-6">
                          <select class="form-control" id="status" type="text" class="form-control" name="status" >
                            <option>Delivered</option>
                            <option>Completed</option>
                          </select>
                                

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                  
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
  function editUser(id,sender_name,sender_contact,receiver_name,receiver_contact,cons_no,status)
  {
    $("input[name='id']").val(id);
    $("input[name='sender_name']").val(sender_name);
    $("input[name='sender_contact']").val(sender_contact);
    $("input[name='receiver_name']").val(receiver_name);
    $("input[name='receiver_contact']").val(receiver_contact);
         $("input[name='cons_no']").val(cons_no);
         $("select[name='status']").val(status);
  }

  function confirmDelete(id){
    $("input[name='id']").val(id);
  }
  
</script>
        <!-- /page content -->
        @endsection()