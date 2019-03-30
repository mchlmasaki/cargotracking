@extends('layouts.employeelayout')
@section('content')
@include('flash::message')
<?php $title='Cancelled Shipments';?>

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
                          <li role="presentation" class=""><a href="{{  url('Employee/pending_orders') }}"  aria-expanded="true">Pending</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Employee/approved_orders') }}" aria-expanded="true">Approved</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Employee/intransit_orders') }}"  aria-expanded="false">In Transit</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Employee/delivered_orders') }}"  aria-expanded="false">Delivered</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Employee/completed_orders') }}"  aria-expanded="false">Completed</a>
                          </li>
                          <li role="presentation" class="active"><a href="{{  url('Employee/cancelled_orders') }}"  aria-expanded="false">Cancelled</a>
                          </li>
                        </ul>
                      </div>

                    </div>
                  
                  <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>id</th>
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
                         <?php 
                        $id = "delete_user".$shipment->id;

                         ?>
                        <td>{{ $shipment->id }}</td>
                          <td>{{ date('M d, Y', strtotime( $shipment->created_at )) }}</td>
                          <td>{{ $shipment->sender_name }}</td>
                          <td>{{ $shipment->sender_contact }}</td>
                          <td>{{ $shipment->receiver_name }}</td>
                          <td>{{ $shipment->receiver_contact }}</td>
                          <td>{{ $shipment->type_ofshipment }}</td>
                          <td>{{ $shipment->from_location }}</td>
                          <td>{{ $shipment->to_location }}</td>
                          <td>{{ $shipment->cons_no }}</td>
                          <td><button class="btn btn-info btn-xs">{{ $shipment->status }}</button></td>
                          <td><a href="{{ url('Employee/shipmentdetails/'.$shipment->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-folder"></i> View </a></td>
                          <td>
                            <a class="btn btn-danger btn-sm waves-effect waves-light remove-record" onclick="return confirmDelete('{{ $shipment->id }}')" data-toggle="modal" data-url="{!! URL::to('Employee/cancelled_orders/delete', $shipment->id) !!}" data-id="{{$shipment->id}}" data-target="#confirmDelete"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                          </td>

                        </tr>
                         @endforeach
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>

<!-- Delete confirm modal -->
<form action="{{ URL::to('Employee/cancelled_orders/delete/') }}" method="POST" class="remove-record-model">
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
 <script type="text/javascript">
  function confirmDelete(id){
    $("input[name='id']").val(id);
  }
  
</script>

              

            </div>
        <!-- /page content -->
        @endsection()