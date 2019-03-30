@extends('layouts.adminlayout')
@section('content')
@include('flash::message')
<?php $title='Report Name:Offices';?>

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
                          
                          <th>Office Name</th>
                          <th>City</th>
                          <th>Location</th>
                          <th>Address</th> 
                          <th>Contact</th> <th>Contact Person</th> <th>Date</th>
                        </tr>
                      </thead>


                      <tbody>
                        @foreach($offices as $office)
                        <tr>
                          
                          <td>{{ $office->name }}</td>
                          <td>{{ $office->city }}</td>
                          <td>{{ $office->location }}</td>
                          <td>{{ $office->address }}</td>
                          <td>{{ $office->contact }}</td>
                          <td>{{ $office->contact_person }}</td>
                          <td>{{ date('M d, Y', strtotime( $office->created_at )) }}</td>
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