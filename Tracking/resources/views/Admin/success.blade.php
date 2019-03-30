@extends('layouts.adminlayout')
@section('content')
@include('flash::message')
       

          <div class="row">
   <!-- Start to do list -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2><b>Recommendations </b> </h2>
                      
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content"> 
                      <h3 style="color: blue;">  Delivery Truck updated/recommended successfully <i class="glyphicon glyphicon-ok-circle"></i></h3>
                      
                      <a href="{{ 'dashboard' }}"><button class="btn btn-default" action="action"  type="button"><i class="glyphicon glyphicon-arrow-left"></i>Go back</button></a>
                    </div>
                  </div>
                </div>
                <!-- End to do list -->


          </div>
       
@endsection()