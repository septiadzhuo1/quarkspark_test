@extends('adminlte::page')
@section('title', 'Books')

@section('content_header')
    <h1>Create From</h1>
@stop

@section('content')
<div>
	<div class="box box-info">
		<div class="box-header with-border">
          <h3 class="box-title">Details</h3>
          @if ($book->approval_status == "Pending")
	          @if (Auth::user()->role == 'admin')
	          <div style="float:right;">
	          	<button class="btn btn-success approval" id="Approve">Approve</button>
	          	<button class="btn btn-warning approval" id="Reject">Reject</button>
	          </div>
	          @endif
          @endif
        </div>
        <form class="form-horizontal">
        @csrf
        	<div class="box-body">
        		<div class="form-group">
	              <label for="inputEmail3" class="col-sm-2 control-label">Book ID</label>
	              <div class="col-sm-10">
	                <input type="text" class="form-control" id="inputEmail3"  value="{{$book->book_id}}" readonly="true" >
	              </div>
	            </div>
	            <div class="form-group">
	              <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
	              <div class="col-sm-10">
	                <input type="text" class="form-control" id="inputEmail3" name="title" readonly="true" value="{{$book->title}}">
	              </div>
	            </div>
	            <div class="form-group">
	              <label for="inputEmail3" class="col-sm-2 control-label">Author</label>
	              <div class="col-sm-10">
	                <input type="text" class="form-control" id="inputEmail3" name="author" readonly="true" value="{{$book->author}}">
	              </div>
	            </div>
	            <div class="form-group">
	              <label for="inputEmail3" class="col-sm-2 control-label">ISBN</label>
	              <div class="col-sm-10">
	                <input type="text" class="form-control" id="inputEmail3"  value="{{$book->isbn}}" name="isbn" readonly="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label for="inputEmail3" class="col-sm-2 control-label">Publish Date</label>
	              <div class="col-sm-10">
	                <input type="date" class="form-control" id="datepicker" name="publish_date" value="{{$book->publish_date}}" readonly="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label for="inputEmail3" class="col-sm-2 control-label">Approval Status</label>
	              <div class="col-sm-10">
	                <span class="label {{$book->approval_status}}">{{$book->approval_status}}</span>
	              </div>
	            </div>
	            @if($book->approval_status == "Pending")
	            <a href="{{route('book.edit', $book->id)}}"><button type="button" class="btn btn-info" style="float: right;">Modfiy</button></a>
	            @endif
        	</div>
        </form>
	</div>
</div>
@endsection

@section('js')
<script>
	
	$(document).ready(function(){
		$(".approval").on('click', function(){
			var status = $(this).attr('id');
			var Id= "{{$book->id}}";
			$.ajax({
	            type: "GET",
	            url: '{{url("/approval")}}',
	            data: {'status': status, "id":Id},
	            success: function(data){
	              location.reload();
	            }
	        });
		})
	})
</script>

@endsection