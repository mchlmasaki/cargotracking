@extends('layouts.employeelayout')
@section('content')
<?php $title='Containers';?>

<div class="container">
<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-truck"></i> Containers</div>
<div class="panel-body">

	<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Name</th>
                          <th>Container Number</th>
                          <th>Max Weight</th>
                          <th>Status</th>
                          <th>From</th>
                          <th>To</th>
                          <th>Current Location</th>
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
			<td>{{ $container->from }}</td>
			<td>{{ $container->to }}</td>
			<td>{{ $container->current_location }}</td>
                        </tr>
                         @endforeach
                      </tbody>
                    </table>

	{!! $containers->links() !!}
</div>
	
</div>
</div>

@endsection