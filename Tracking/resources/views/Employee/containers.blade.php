@extends('layouts.employeelayout')
@section('content')
<?php $title='Containers';?>

<div class="container">
<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-truck"></i> Delivery Trucks</div>
<div class="panel-body">

	<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Truck Name</th>
                          <th>Truck Number</th>
                          <th>Max Weight</th>
                          <th>Status</th>
                          <th>Current Location</th><th>Actions</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach($containers as $container)
                        <tr>
                        <?php 
                        $id = "delete_container".$container->id;
                         ?>
                        <td>{{ $container->id }}</td>
			<td>{{ $container->name }}</td>
			<td>{{ $container->container_number }}</td>
      <td>{{ $container->max_weight }}</td>
			<td>{{ $container->status }}</td>
			<td>{{ $container->current_location }}</td>
      <td>
        <a href="{{ url('Employee/shipments_in_container/'.$container->container_number) }}" class="btn btn-primary btn-sm"> View Shipments </a>
      <button data-toggle="modal" href="#updateStatus" onclick="return updateStatus('{{ $container->id }}','{{ $container->name }}','{{ $container->container_number }}','{{ $container->status }}')" class="btn btn-success btn-sm "><i class="fa fa-edit"></i> Update </button>
            </td>
                        </tr>
                         @endforeach
                      </tbody>
                    </table>

	{!! $containers->links() !!}
</div>

<!-- Update modal -->

                  <div class="modal fade" id="updateStatus" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><center>Update Truck Status</center> </h4>
                                        </div>

                                        <div class="modal-body">
                                            <!-- New Task form-->
                          <form name="user_form" action="{{ URL::to('Employee/containers/update')}}" method="POST" class="form-horizontal">
                          {!! csrf_field() !!}

                          <input type="hidden" name="id" id="id">
                          
                          <div class="form-group">
                          <label for="task" class="col-sm-3 control-label">Truck Name</label>
                          <div class="col-sm-6">
                          <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" readonly>
                          @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>

                        <div class="form-group">
                        <label for="task" class="col-sm-3 control-label">Truck Number</label>
                        <div class="col-sm-6">
                        <input type="text" name="container_number" id="container_number" class="form-control" readonly>
                        @if ($errors->has('container_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('container_number') }}</strong>
                            </span>
                        @endif
                        </div>
                      </div>

                       
                       <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Status<strong style="color: red;">*</strong> </label>

                            <div class="col-sm-6">
                          <select class="form-control" id="status" type="text" class="form-control" name="status" >
                            <option>Available</option>
                            <option>In Transit</option>
                          </select>
                                

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                     
                        
                        <input id="role" type="hidden" name="role" value="Admin">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-ok-circle"></i> Update
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
</div>

<script type="text/javascript">
  function updateStatus(id,name,container_number,status)
  {
    $("input[name='id']").val(id);
         $("input[name='name']").val(name);
         $("input[name='container_number']").val(container_number);
         $("select[name='status']").val(status);
  }


</script>
@endsection