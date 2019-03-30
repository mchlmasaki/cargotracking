@extends('layouts.l1employeelayout')
@section('content')
@include('flash::message')
<?php $title='Shipments In Container';?>


        <!-- page content -->

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{ $title }}</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(isset($shipments))
                  <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>Cons. No</th>
                          <th>Client</th>
                          <th>Status</th>
                          <th>From</th>
                          <th>To</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($shipments as $shipment)
                        <tr>
                        <td>{{ $shipment->cons_no }}</td>
                          <td>{{ $shipment->sender_contact }}</td>
                          <td>{{ $shipment->status }}</td>
                          <td>{{ $shipment->from }}</td>
                          <td>{{ $shipment->to }}</td>
                         
                        </tr>
                         @endforeach
                      </tbody>
                      <button class="btn btn-default" action="action" onclick="window.history.go(-1); return false;" type="button"><i class="glyphicon glyphicon-arrow-left"></i>Go back</button>
                    </table>
                    @elseif(isset($message))
                    <h2 style="color: red">{{ $message }}</h2>
                   <button class="btn btn-default" action="action" onclick="window.history.go(-1); return false;" type="button"><i class="glyphicon glyphicon-arrow-left"></i>Go back</button>
                    @endif
                    
                  </div>
                </div>
              </div>


     



            </div>


        <!-- /page content -->
        @endsection()