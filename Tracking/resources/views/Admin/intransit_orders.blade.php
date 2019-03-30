@extends('layouts.adminlayout')
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
                          <li role="presentation" class=""><a href="{{  url('Admin/all_orders') }}"  aria-expanded="true">All</a></li>
                          <li role="presentation" ><a href="{{  url('Admin/pending_orders') }}"  aria-expanded="true">Pending</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Admin/approved_orders') }}" aria-expanded="true">Approved</a>
                          </li>
                          <li role="presentation" class="active"><a href="{{  url('Admin/intransit_orders') }}"  aria-expanded="false">In Transit</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Admin/delivered_orders') }}"  aria-expanded="false">Delivered</a>
                          </li>
                          <li role="presentation" class=""><a href="{{  url('Admin/cancelled_orders') }}"  aria-expanded="false">Cancelled</a>
                        </ul>
                      </div>

                    </div>
                  
                  <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr><th>Date</th>
                          <th>Senders Address</th>
                          <th>Receivers Name</th>
                          <th>Receivers Contact</th>
                          <th>Receivers Address</th>
                          <th>Type of Shipment</th>
                          <th>From</th>
                          <th>Destination</th>
                          <th>Consignment Number</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($shipments as $shipment)
                        <tr>
                        <td>{{ date('M d, Y', strtotime( $shipment->created_at )) }}</td>
                          <td>{{ $shipment->sender_name }}</td>
                          <td>{{ $shipment->receiver_name }}</td>
                          <td>{{ $shipment->receiver_contact }}</td>
                          <td>{{ $shipment->receiver_address }}</td>
                          <td>{{ $shipment->type_ofshipment }}</td>
                          <td>{{ $shipment->from_location }}</td>
                          <td>{{ $shipment->to_location }}</td>
                          <td>{{ $shipment->cons_no }}</td>
                          
                          <td><a href="{{ url('Admin/shipmentdetails/'.$shipment->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-folder"></i> View </a>
                          </td>
                        </tr>
                         @endforeach
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>

            </div>

        <!-- /page content -->
        @endsection()