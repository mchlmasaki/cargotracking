@extends('layouts.employeelayout')
@section('content')
@include('flash::message')
<?php $title='Report Name:Clients';?>

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
                          
                          <th>Name</th>
                          <th>Email</th>
                          <th>Contact</th>
                          <th>Status</th> 
                          <th>Member from</th>
                        </tr>
                      </thead>


                      <tbody>
                        @foreach($users as $user)
                        <tr>
                          
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->contact }}</td>
                          <td>
                            <?php
                            $accntstatus=$user->verified;
                            if($accntstatus=='1'){
                              echo'Verified';
                            }else{echo'Not Verified';}
                            ?>
                          </td>
                          <td>{{ date('M d, Y', strtotime( $user->created_at )) }}</td>
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