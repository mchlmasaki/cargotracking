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
                      @if(isset($search_results))

                      @if(count($search_results)== 0)
                      <div class="warning"><p style="color: red;">Recommended Records not available</p></div>
                      <a href="{{ 'dashboard' }}"><button class="btn btn-default" action="action"  type="button"><i class="glyphicon glyphicon-arrow-left"></i>Go back</button></a>
                      
                     @else
                      <div class=""> <h2 style="color: black;">Recommended Trucks for '{{ $town_name }}' Location </h2>
                        @foreach($search_results as $recommend)
                       
                        <ul class="to_do">
                          
                          <li>
                            
                          <form name="user_form" action="{{ URL::to('Admin/recommendations/approve')}}" method="POST" class="form-horizontal">
                          {!! csrf_field() !!}
                          <input type="hidden" name="id" id="id" value="{{ $recommend->id }}">
                          <input type="hidden" name="status" id="status" value="{{ $recommend->status }}">
                          <p style="color: blue; text-transform: capitalize;">
                          <input type="checkbox" class="flat" value="{{ $town_name }}" name="location" required>&emsp; {{ $recommend->name }} 
                          &emsp;&emsp; &emsp;&emsp; 
                          <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok-circle"></i> Recommend </button> </p>
                           </form>

                           
                          </li>
                         
                        </ul>@endforeach
                        <a href="{{ 'dashboard' }}"><button class="btn btn-default" action="action"  type="button"><i class="glyphicon glyphicon-arrow-left"></i>Go back</button></a>
                      </div>
                      @endif
                      @else
                      <h3 style="color: red;"> {{ $myerror }}</h3>
                      <a href="{{ 'dashboard' }}"><button class="btn btn-default" action="action"  type="button"><i class="glyphicon glyphicon-arrow-left"></i>Go back</button></a>
                      @endif
                    </div>
                  </div>
                </div>
                <!-- End to do list -->


          </div>
       
@endsection()