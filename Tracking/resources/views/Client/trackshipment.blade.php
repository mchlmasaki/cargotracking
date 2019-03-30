@extends('layouts.clientlayout')
@section('content')
@include('flash::message')

        <!-- page content -->
          
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Track Your shipment:&nbsp;</h2><h2 style="color: red;"> </h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    





                    <div class="col-md-12 col-sm-12 col-xs-12" style=" ">
                <div class="x_panel">
                  
                  <div class="x_content">

                    
    <form action="{{ URL::to('Client/trackshipment')}}" method="POST" role="search">
      {{ csrf_field() }}
      <div class="input-group">
        <input type="text" class="form-control" name="q"
          placeholder="Enter consignment number  e.g XEQ0J4D1"> <span class="input-group-btn">
          <button type="submit" class="btn btn-default">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </form>
    <div class="container">
      @if(isset($details))
      <p> Tracking results for consignment number: <b> {{ $query }} </b></p>
      <u><strong><h3>Shipment Tracking Details</h3></strong></u>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Date</th><th>Cons No</th><th>Sender Name</th><th>Sender Addr</th><th>Receiver Name</th><th>Receiver Addr</th>
            <th>Weight</th><th>Current Location</th><th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($details as $user)
          <tr>
            <td>{{ date('d M, Y', strtotime( $user->created_at )) }}</td><td>{{$user->cons_no}}</td>
            <td>{{$user->sender_name}}</td><td>{{$user->sender_address}}</td><td>{{$user->receiver_name}}</td>
            <td>{{$user->receiver_address}}</td><td>{{$user->weight}}</td><td>{{$user->to_location}}</td>
            <td>{{$user->status}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      
      @elseif(isset($message))
      <p style="color: red">{{ $message }}</p>
      @endif
      
    </div>

                  </div>
                </div><button class="btn btn-default" onclick="window.print('divPrint');" ><i class="fa fa-print"></i> Print</button>
              </div>


                  </div>
                </div>
              </div>
            </div>
      
        <!-- /page content -->

        @endsection()