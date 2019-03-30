@extends('layouts.employeelayout')
@section('content')
@include('flash::message')
<?php $title='Shipments In Transit';?>

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
                          <li role="presentation" class=""><a href="{{  url('Employee/approved_orders') }}" aria-expanded="true">Approved</a>
                          </li>
                          <li role="presentation" class="active"><a href="{{  url('Employee/intransit_orders') }}"  aria-expanded="false">In Transit</a>
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
                          <th>Senders Address</th>
                          <th>Receivers Name</th>
                          <th>Receivers Contact</th>
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
                          <td>{{ $shipment->sender_name }}</td>
                          <td>{{ $shipment->receiver_name }}</td>
                          <td>{{ $shipment->receiver_contact }}</td>
                          <td>{{ $shipment->receiver_address }}</td>
                          <td>{{ $shipment->type_ofshipment }}</td>
                          <td>{{ $shipment->from_location }}</td>
                          <td>{{ $shipment->to_location }}</td>
                          <td>{{ $shipment->cons_no }}</td>
                          <td>{{ date('M d, Y', strtotime( $shipment->created_at )) }}</td>
                          <td><a href="{{ url('Employee/shipmentdetails/'.$shipment->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-folder"></i> View </a><button data-toggle="modal" href="#modalDefault" onclick="return editUser('{{ $shipment->id }}','{{ $shipment->sender_name }}','{{ $shipment->sender_contact }}','{{ $shipment->receiver_name }}','{{ $shipment->receiver_contact }}','{{ $shipment->cons_no }}','{{ $shipment->from_location }}','{{ $shipment->to_location }}','{{ $shipment->status }}')" class="btn btn-success btn-sm "><i class="fa fa-edit"></i> Update </button> 
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
                                            <center><h4 class="modal-title">Update Shipment Status</h4></center>
                                        </div>

                                        <div class="modal-body">
                                            <!-- New Task form-->
                          <form name="user_form" action="{{ URL::to('Employee/intransit_orders')}}" method="POST" class="form-horizontal">
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

                          <div class="form-group{{ $errors->has('from_location') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">From</label>

                            <div class="col-md-6">
                                <input id="from_location" type="text" class="form-control" name="from_location" value="{{ old('from_location') }}">

                                @if ($errors->has('from_location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('from_location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('to_location') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Destination</label>

                            <div class="col-md-6">
                                <input id="to_location" type="text" class="form-control" name="to_location" value="{{ old('to_location') }}">

                                @if ($errors->has('to_location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('to_location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Status</label>

                            <div class="col-md-6">
                          <select class="form-control" id="status" type="text" class="form-control" name="status" >
                            <option>In Transit</option>
                            <option>Delivered</option>
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
  function editUser(id,sender_name,sender_contact,receiver_name,receiver_contact,cons_no,from_location,to_location,status)
  {
    $("input[name='id']").val(id);
    $("input[name='sender_name']").val(sender_name);
    $("input[name='sender_contact']").val(sender_contact);
    $("input[name='receiver_name']").val(receiver_name);
    $("input[name='receiver_contact']").val(receiver_contact);
         $("input[name='cons_no']").val(cons_no);
         $("input[name='from_location']").val(from_location);
         $("input[name='to_location']").val(to_location);
         $("select[name='status']").val(status);
  }

</script>
        <!-- /page content -->
        @endsection()