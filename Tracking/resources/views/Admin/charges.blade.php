@extends('layouts.adminlayout')
@section('content')
@include('flash::message')

<!-- page content  -->

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Shipping Rates</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <button data-toggle="modal" href="#modalDefault" class="btn btn-success btn-sm "><i class="fa fa-plus"></i> New Rate </button>
                  <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Weight (Kg)</th>
                          <th>Rate (Ksh)/Kg</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                        
                      @foreach($shippingrates as $shippingrate)
                        <tr>
                        <td>{{ $shippingrate->id }}</td>
                          <td>{{ $shippingrate->weight_from }} - {{ $shippingrate->weight_to }}</td>
                          <td>{{ $shippingrate->rate }}</td>
                          <td>
                          <button data-toggle="modal" href="#modalDefault" onclick="return editShippingrate('{{ $shippingrate->id }}','{{ $shippingrate->weight_from }}','{{ $shippingrate->weight_to }}','{{ $shippingrate->rate }}')" class="btn btn-success btn-sm "><i class="fa fa-edits"></i> Update </button>

                          <a class="btn btn-danger btn-sm waves-effect waves-light remove-record" onclick="return confirmDelete('{{ $shippingrate->id }}')" data-toggle="modal" data-url="{!! URL::to('Admin/charges/delete', $shippingrate->id) !!}" data-id="{{$shippingrate->id}}" data-target="#confirmDelete"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                          </td>
                        </tr>

                         @endforeach
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>


<!-- Delete confirm modal -->
<form action="{{ URL::to('Admin/charges/delete/') }}" method="POST" class="remove-record-model">
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
                    <H4 class="text-center">Are you sure you want to delete this shipping rate?</H4>
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


              <!-- Small modal --> 

                  <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add New Rate Scheme</h4>
                                        </div>

                                        <div class="modal-body">
                                            <!-- New Task form-->
                          <form name="user_form" action="{{ URL::to('Admin/charges')}}" method="POST" class="form-horizontal" name="charges" onsubmit="return validateForm()">
                          {!! csrf_field() !!}
                          <input type="hidden" id="id" name="id"> 
                         <div class='col-sm-3'>
                    Weight from(Kg)
                    <div class="form-group">
                        <div class='input-group date' >
                            <input type='text' class="form-control" id="weight_from" name="weight_from" value="{{ old('weight_from') }}" placeholder="0" />
                            <div  style=" color: red;" id="weight_from_err"></div><br>
                        </div>
                        
                        @if (!$errors->storeShippingrateErrors->isEmpty())
                                    <div class="add">
                                        <span class="help-block" style="color: red;">
                                          <strong>{{ $errors->storeShippingrateErrors->first('weight_from') }}</strong>
                                        </span> 
                                    </div>
                        @endif
                    </div>
                </div>
                <div class='col-sm-3'>
                    Weight to(Kg)
                    <div class="form-group">
                        <div class='input-group date' >
                            <input type='text' class="form-control" id="weight_to" name="weight_to" value="{{ old('weight_to') }}" placeholder="20" />
                        </div>
                        @if (!$errors->storeShippingrateErrors->isEmpty())
                                    <div class="add">
                                        <span class="help-block" style="color: red;">
                                          <strong>{{ $errors->storeShippingrateErrors->first('weight_to') }}</strong>
                                        </span> 
                                    </div>
                        @endif
                    </div>
                </div>

                <div class='col-sm-4'>
                    Rate(Ksh)/Kg
                    <div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
                        <div class='input-group date' >
                            <input type='text' class="form-control" id="rate" name="rate" value="{{ old('rate') }}"/>
                        </div>
                        @if (!$errors->storeShippingrateErrors->isEmpty())
                                    <div class="add">
                                        <span class="help-block" style="color: red;">
                                          <strong>{{ $errors->storeShippingrateErrors->first('rate') }}</strong>
                                        </span> 
                                    </div>
                        @endif
                    </div>
                </div>
                
                                                  

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-ok-circle"></i> Submit
                                </button>
                                 <button type="button"  data-dismiss="modal" class="btn btn-primary">
                                            <i class="glyphicon glyphicon-remove"></i>Close
                                          </button>
                            </div>
                        </div>


                            
                          </form>
                          </div>
                                        
                                    </div>
                                </div>
                            </div>
                  <!-- /modals -->
            </div>

<script type="text/javascript">
  function editShippingrate(id,weight_from,weight_to,rate){
        $("input[name='id']").val(id);
         $("input[name='weight_from']").val(weight_from);
         $("input[name='weight_to']").val(weight_to);
         $("input[name='rate']").val(rate);
         
  }
  function confirmDelete(id){
    $("input[name='id']").val(id);
  }
  function validateForm() {
    //alert('weight_to');
    var weight_from = document.charges.weight_from.value;
    var weight_to = document.charges.weight_to.value;
    var test = true;
     //alert($weight_to);

    if (weight_from == null || weight_from == "") {
      alert('weight_to');
        document.getElementById("weight_from").style.border='1px solid red';
        document.getElementById("weight_from_err").innerHTML='Please type a comment';
        test = false;
    }
    
    if ( test == false ){
        return false;
    }else{
        alert("Welcome,You been registered successfully");
    }
  }
  
</script>

<!-- /page content -->
@endsection