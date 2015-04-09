@extends('layouts.default')

@section('content')

	<h2> Create Category</h2>
	<hr>

	@if(Session::get('success_category_created'))
      	<div class="alert alert-success fade in" role="alert">
        	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        	<center>{{ Session::get('success_category_created') }}</center>
      	</div>
      	{{ Session::forget('success_category_created') }}
    @endif

	<div class="form-create col-md-12">

		{{ Form::open() }}

		<div class="forms col-md-12">
			<div class="col-md-6 form-group @if ($errors->has('categoryName')) has-error @endif">
		        {{ Form::text('categoryName',Session::get('categoryName'),array('class' => 'form-control', 'placeholder' => 'Category Name','maxlength'=>'')) }}
		        @if ($errors->has('categoryName')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('categoryName') }}</p></i> @endif
		    </div>
		</div>

		<div class="forms col-md-12">
			<div class="col-md-6 form-group @if ($errors->has('UserType')) has-error @endif">
		            {{ Form::submit('Submit', ['id'=>'submit','class' => 'btn btn-lg btn-success btn-block sbmt left-sbs','style'=>'width:40%; float:right;']) }}
		    </div>
		</div>


		{{ Form::close(); }}

	</div>
	
@stop
