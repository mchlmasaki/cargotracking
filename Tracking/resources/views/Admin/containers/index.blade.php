@extends('layouts.adminlayout')
@section('content')
@include('flash::message')

<div class="container">
<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-truck"></i> Delivery Trucks</div>

<div class="panel-body">

<!-- New Task form-->
<form name="container_form" action="{{ URL::to('Admin/containers')}}" method="POST" class="form-horizontal">
{!! csrf_field() !!}
<input type="hidden" name="id" id="id">
        <?php 
        function createRandomTransactionum() {
          $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
          srand((double)microtime()*1000000);
          $i = 0;
          $pass = '' ;
          while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
          }
          return $pass;
        }
                $container_No = createRandomTransactionum();
         ?>
<!--Task name-->
<div class="form-group">
	<label for="task" class="col-sm-3 control-label">Delivery Truck Name</label>
	<div class="col-sm-6">
	<input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
	@if ($errors->has('name'))
        <span class="help-block" style="color: red;">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
	</div>
</div>
<div class="form-group">
	<label for="task" class="col-sm-3 control-label">Truck Number</label>
	<div class="col-sm-6">
	<input type="text" name="container_number" id="container_number" class="form-control" value="{{ $container_No }}" readonly>
	@if ($errors->has('container_number'))
      <span class="help-block" style="color: red;">
          <strong>{{ $errors->first('container_number') }}</strong>
      </span>
  @endif
	</div>
</div>

<div class="form-group">
  <label for="task" class="col-sm-3 control-label">Max Weight (kg)</label>
  <div class="col-sm-6">
  <input type="text" name="max_weight" id="max_weight" class="form-control" value="{{ old('max_weight') }}">
  @if ($errors->has('max_weight'))
      <span class="help-block" style="color: red;">
          <strong>{{ $errors->first('max_weight') }}</strong>
      </span>
  @endif
  </div>
</div>
<input type="hidden" name="status" id="status" value="Available">
<!--Add Containers Button-->
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-6">
		<button type="submit" class="btn btn-default">
			<i class="fa fa-plus"></i>Add Truck
		</button>
	</div>
</div>
	
</form>



	<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Truck Name</th>
                          <th>Truck Number</th>
                          <th>Max Weight</th> <th>Status</th> <th>Office</th> 
                          <th>Action</th>
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
      <td>{{ $container->max_weight }}</td> <td>{{ $container->status }}</td> <td>{{ $container->office }}</td>
			<td><button onclick="return editContainer('{{ $container->id }}','{{ $container->name }}','{{ $container->container_number }}','{{ $container->max_weight }}')" class="btn btn-success btn-sm "><i class="fa fa-edit"></i> edit </button> 
      <button data-toggle="modal" href="#updateStatus" onclick="return updateStatus('{{ $container->id }}','{{ $container->name }}','{{ $container->container_number }}','{{ $container->status }}')" class="btn btn-success btn-sm "><i class="fa fa-edit"></i> Update </button>
			<a class="btn btn-danger btn-sm waves-effect waves-light remove-record" onclick="return confirmDelete('{{ $container->id }}')" data-toggle="modal" data-url="{!! URL::to('Admin/containers/delete', $container->id) !!}" data-id="{{$container->id}}" data-target="#confirmDelete"><i class="fa fa-trash"></i>&nbsp;Delete</a>
            </td>
                        </tr>
                         @endforeach
                      </tbody>
                    </table>

	{!! $containers->links() !!}
</div>
	
</div>
</div>

<!-- Delete confirm modal -->
<form action="{{ URL::to('Admin/containers/delete/') }}" method="POST" class="remove-record-model">
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
                    <H4 class="text-center">Are you sure you want to delete this?</H4>
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
 <!-- Update modal -->

                  <div class="modal fade" id="updateStatus" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><center>Update Container Status</center> </h4>
                                        </div>

                                        <div class="modal-body">
                                            <!-- New Task form-->
                          <form name="user_form" action="{{ URL::to('Admin/containers/update')}}" method="POST" class="form-horizontal">
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
                        <input type="text" name="container_number" id="container_number" class="form-control" value="{{ $container_No }}" readonly>
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
                        <div class="form-group">
      <label for="number_plate" class="col-sm-3 control-label">Assign Brach City</label>

      <div class="col-md-6">
      
    <select class="form-control" id="office_name" type="text" class="form-control" name="office_name" required="">
    @foreach($offices as $office)
      <option>{{ $office->city }}</option>
      @endforeach
    </select>
          

          @if ($errors->has('office_name'))
              <span class="help-block">
                  <strong>{{ $errors->first('office_name') }}</strong>
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
              


<script type="text/javascript">
	function editContainer(id,name,container_number,max_weight)
	{
		$("input[name='id']").val(id);
         $("input[name='name']").val(name);
         $("input[name='container_number']").val(container_number);
         $("input[name='max_weight']").val(max_weight);
	}
  function updateStatus(id,name,container_number,status)
  {
    $("input[name='id']").val(id);
         $("input[name='name']").val(name);
         $("input[name='container_number']").val(container_number);
         $("select[name='status']").val(status);
  }

  function confirmDelete(id){
    $("input[name='id']").val(id);
  }

</script>
@endsection