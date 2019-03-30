@extends('layouts.adminlayout')
@section('content')
@include('flash::message')
<?php $title='Report Name:Containers';?>

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
                          
                          <th>Container Name</th>
                          <th>Number</th>
                          <th>Max Weight</th>
                          <th>Status</th> 
                          <th>Date Added</th>
                        </tr>
                      </thead>


                      <tbody>
                        @foreach($containers as $container)
                        <tr>
                          
                          <td>{{ $container->name }}</td>
                          <td>{{ $container->container_number }}</td>
                          <td>{{ $container->max_weight }}</td>
                          <td>{{ $container->status }}</td>
                          <td>{{ date('M d, Y', strtotime( $container->created_at )) }}</td>
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