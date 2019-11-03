@extends('adminlte::page')

@section('content_header')
    <h1>View User</h1>
@stop

@section('content')

@if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }}</strong>
      </div>
@endif
<div>
	<div class="box box-info">
		<div class="box-header with-border">
          <h3 class="box-title">Details</h3>
        </div>
        <form class="form-horizontal">
        	<div class="box-body">
        		<div class="form-group">
	              <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
	              <div class="col-sm-10">
	                <input type="text" class="form-control" id="inputEmail3" placeholder="Email" value="{{$user->name}}" readonly="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
	              <div class="col-sm-10">
	                <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{$user->email}}" readonly="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label for="inputEmail3" class="col-sm-2 control-label">Role</label>
	              <div class="col-sm-10">
	                <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{$user->role}}" readonly="true">
	              </div>
	            </div>
	            @if (Auth::user()->role == "admin")
		            @if ($user->role == 'user')
			        	<div class="form-group">
			              <label for="inputEmail3" class="col-sm-2 control-label">Reset Password</label>
			              <div class="col-sm-1">
		                	<a href="{{route('passwordreset.reset', $user->id)}}"><button class="btn btn-block btn-success" type="button">Reset</button></a>
			              </div>
			            </div>
			        @endif
	            @endif
        	</div>
        </form>
	</div>
</div>

@stop