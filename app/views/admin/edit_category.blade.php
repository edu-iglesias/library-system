@extends('layouts.default')

@section('content')

	<h2> Create Category</h2>
	<hr>

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
