@extends('layouts.employeelayout')
@section('content')
@include('flash::message')
<?php $title='Report Name:Approved Shipments';?>

        <!-- page content -->

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  

                  <div class="x_content">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><strong>{{$title}}</strong> </h2>
                    
                      
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table id="datatable-buttons" class="table table-striped table-bordered">
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
                          <td>{{ $shipment->status }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                  
                  
                    
                  </div>
                </div>
              </div>


              

            </div>
        <!-- /page content -->
        @endsection()