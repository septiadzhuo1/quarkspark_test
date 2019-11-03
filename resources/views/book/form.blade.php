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
        </div>
        @if (isset($book))
	        {{ Form::model($book, ['route' => ['book.update', $book->id], 'method' => 'PUT', 'class'=>'form-horizontal']) }}
        @else
    	    {{ Form::open(['route' => 'book.store', 'class'=>'form-horizontal']) }}
        @endif
        @csrf
        	<div class="box-body">
        		<div class="form-group">
	              <label for="book_id" class="col-sm-2 control-label">Book ID</label>
	              <div class="col-sm-10">
	                {{Form::text('book_id',  isset($book->book_id) ? $book->book_id : $bookId,['class' => 'form-control', 'readonly'=>'true'])}}
	              </div>
	            </div>
	            <div class="form-group">
	              <label for="title" class="col-sm-2 control-label">Title</label>
	              <div class="col-sm-10">
	                {{Form::text('title',  isset($book->title) ? $book->title : null,['class' => 'form-control'])}}
	              </div>
	            </div>
	            <div class="form-group">
	              <label for="author" class="col-sm-2 control-label">Author</label>
	              <div class="col-sm-10">
	                {{Form::text('author',  isset($book->author) ? $book->author : null,['class' => 'form-control'])}}
	              </div>
	            </div>
	            <div class="form-group">
	              <label for="isbn" class="col-sm-2 control-label">ISBN</label>
	              <div class="col-sm-10">
	                {{Form::text('isbn',  isset($book->isbn) ? $book->isbn : null,['class' => 'form-control'])}}
	              </div>
	            </div>
	            <div class="form-group">
	              <label for="inputEmail3" class="col-sm-2 control-label">Publish Date</label>
	              <div class="col-sm-10">
	                {{Form::date('publish_date',  isset($book->publish_date) ? $book->publish_date : null,['class' => 'form-control'])}}
	              </div>
	            </div>
	            <button type="submit" class="btn btn-success" style="float: right;">SAVE</button>
        	</div>
        {{ Form::close() }}
	</div>
</div>
@endsection

@section('js')
<script>
	
	$(document).ready(function(){

	})
</script>

@endsection