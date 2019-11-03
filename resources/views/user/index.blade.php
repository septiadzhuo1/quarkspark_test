@extends('adminlte::page')

@section('title', 'User List')
@section('css')
<style>
	.deleteButton {
		background-color: white;
		width:94%; 
		text-align: left;
		padding:0px;
		padding-bottom: 5px;
	}
</style>
@stop
@section('content_header')
    <h1>User List</h1>
@stop

@section('content')
{{Gate::check('admin')}}

@if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }}</strong>
      </div>
@endif
    <table id="userTable" class="table table-bordered table-hover dataTable" style="background-color: white;">
    	<thead>
	    	<tr>
	    		<th>Name</th>
	    		<th>Email</th>
	    		<th>Role</th>
	    		<th>Status</th>
	    		<th>Action</th>
	    	</tr>
    	</thead>
    	<tbody>
    	@foreach ($user as $key=>$data)
			<tr>
				<td>{{$data->name}}</td>
				<td>{{$data->email}}</td>
				<td>{{$data->role}}</td>
				<td> 
				<input data-id="{{$data->id}}" id="toggle-two" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="active" data-off="inactive" {{ $data->status == 'active' ? 'checked' : '' }} {{ $data->role == 'admin' ? 'disabled="true"' : '' }}></td>
				<td>
					<div class="btn-group">
	                  <button type="button" class="btn btn-info">Action</button>
	                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	                    <span class="caret"></span>
	                    <span class="sr-only">Toggle Dropdown</span>
	                  </button>
	                  <ul class="dropdown-menu" role="menu">
		                    <li><a href="{{route('users.edit', $data->id)}}" target="_blank">View User</a></li>
		                    <li class="divider"></li>
	                      	@if ($data->role =="user")
	                      	<li>
	                      	   <a class="" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $data->id }}').submit();">Delete</a>

							   <form action="{{ route('users.destroy', $data->id) }}" method="POST" id="delete-form-{{ $data->id }}" style="display: none;">
							        {{csrf_field()}}
							        {{ method_field('DELETE') }}
							        <input type="hidden" value="{{ $data->id }}" name="id">
							   </form>
							</li>
		                    @endif
	                  </ul>
	                </div>
                </td>
			</tr>
    	@endforeach
    	</tbody>
    </table>


@stop

@section('js')
<script>
	$( document ).ready(function() {
		$(function() {
		    $('#toggle-two').bootstrapToggle({
		      on: 'active',
		      off: 'inactive'
		    });
		  })
	     $('#userTable').DataTable();
	     $('.toggle-class').change(function() {
	        var status = $(this).prop('checked') == true ? 'active' : 'inactive'; 
	        var user_id = $(this).data('id'); 
	         
	        $.ajax({
	            type: "GET",
	            dataType: "json",
	            url: '{{url("/changeStatus")}}',
	            data: {'status': status, 'user_id': user_id},
	            success: function(data){
	              console.log(data.success)
	            }
	        });
	    })
	});
	
</script>
@endsection