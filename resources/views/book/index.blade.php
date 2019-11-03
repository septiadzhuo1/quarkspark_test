@extends('adminlte::page')
@section('title', 'Books')

@section('content_header')
    <h1>Book List</h1>
@stop

@section('content')
@if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }}</strong>
      </div>
@endif
<div>
	<div class="btn-group">
		<a href="{{route('book.create')}}"><button class="btn btn-block btn-success col-1">Create</button></a>
	</div>
	<br>
	<br>
	<table id="booksTable" class="table table-bordered table-hover dataTable" style="background-color: white;">
    	<thead>
	    	<tr>
	    		<th>Book ID</th>
	    		<th>Title</th>
	    		<th>Author</th>
	    		<th>ISBN</th>
	    		<th>Publish Date</th>
	    		<th>Approval Status</th>
	    		<th>Action</th>
	    	</tr>
    	</thead>
    	<tbody>
    		@foreach($book as $key=>$data)
    			@if(Auth::user()->id == $data->created_by || Auth::user()->role == "admin")
    			<tr>
    				<td>{{$data->book_id}}</td>
    				<td>{{$data->title}}</td>
    				<td>{{$data->author}}</td>
    				<td>{{$data->isbn}}</td>
    				<td>{{$data->publish_date}}</td>
    				<td><span class="label {{$data->approval_status}}">{{$data->approval_status}}</span></td>
    				<td>
	    				<div class="btn-group">
		                  <button type="button" class="btn btn-info">Action</button>
		                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		                    <span class="caret"></span>
		                    <span class="sr-only">Toggle Dropdown</span>
		                  </button>
		                  <ul class="dropdown-menu" role="menu">
			                    <li><a href="{{route('book.show', $data->id)}}" target="_blank">View Book</a></li>
			                    @if ($data->approval_status == "Pending")
			                    <li><a href="{{route('book.edit', $data->id)}}" target="_blank">Edit Book</a></li>
			                    @endif
			                    
			                    <li>
			                    <a class="" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $data->id }}').submit();">Delete Book</a>

								<form action="{{ route('book.destroy', $data->id) }}" method="POST" id="delete-form-{{ $data->id }}" style="display: none;">
								        {{csrf_field()}}
								        {{ method_field('DELETE') }}
								        <input type="hidden" value="{{ $data->id }}" name="id">
								
								</form>
			                    </li>
			              </ul>
		                </div>
    				</td>
    			</tr>
    			@endif
    		@endforeach
		</tbody>
    </table>

</div>
@stop

@section('js')
<script>
	$(document).ready(function(){
	     $('#booksTable').DataTable();
	})
</script>
@endsection