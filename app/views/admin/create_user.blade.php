@extends('layouts.default')

@section('content')

	<a href="#" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</a>
	<h1> Create User</h1>
	<br>

	{{ Form::open() }}

	<div class="forms col-md-12">
		<div class="col-md-6 form-group @if ($errors->has('UserId')) has-error @endif">
	        {{ Form::text('UserId',Session::get('UserId'),array('class' => 'form-control', 'placeholder' => 'User ID','maxlength'=>'9')) }}
	        @if ($errors->has('UserId')) <p class="help-block">{{ $errors->first('UserId') }}</p> @endif
	    </div>
	</div>

	<div class="forms col-md-12">
		<div class="col-md-6 form-group @if ($errors->has('password')) has-error @endif">
	        {{ Form::text('password',Session::get('password'),array('class' => 'form-control', 'placeholder' => 'Password','maxlength'=>'20')) }}
	        {{ Form::text('password_confirmation',Session::get('password'),array('class' => 'form-control', 'placeholder' => 'Password','maxlength'=>'20')) }}
	        @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
	    </div>
	</div>

	<div class="forms col-md-12">
		<div class="col-md-6 form-group @if ($errors->has('FirstName')) has-error @endif">
	        {{ Form::text('FirstName',Session::get('FirstName'),array('class' => 'form-control', 'placeholder' => 'First Name','maxlength'=>'50')) }}
	        @if ($errors->has('FirstName')) <p class="help-block">{{ $errors->first('FirstName') }}</p> @endif
	    </div>
	</div>

	<div class="forms col-md-12">
		<div class="col-md-6 form-group @if ($errors->has('LastName')) has-error @endif">
	        {{ Form::text('LastName',Session::get('LastName'),array('class' => 'form-control', 'placeholder' => 'Last Name','maxlength'=>'50')) }}
	        @if ($errors->has('LastName')) <p class="help-block">{{ $errors->first('LastName') }}</p> @endif
	    </div>
	</div>

	<div class="forms col-md-12">
		<div class="col-md-6 form-group @if ($errors->has('MiddleName')) has-error @endif">
	        {{ Form::text('MiddleName',Session::get('MiddleName'),array('class' => 'form-control', 'placeholder' => 'Middle Name','maxlength'=>'50')) }}
	        @if ($errors->has('MiddleName')) <p class="help-block">{{ $errors->first('MiddleName') }}</p> @endif
	    </div>
	</div>

	<div class="forms col-md-12">
		<div class="col-md-6 form-group @if ($errors->has('ContactNo')) has-error @endif">
	        {{ Form::text('ContactNo',Session::get('ContactNo'),array('class' => 'form-control', 'placeholder' => 'Contact No.','maxlength'=>'50')) }}
	        @if ($errors->has('ContactNo')) <p class="help-block">{{ $errors->first('ContactNo') }}</p> @endif
	    </div>
	</div>

	<div class="forms col-md-12">
		<div class="col-md-6 form-group @if ($errors->has('UserType')) has-error @endif">
	            {{ Form::select('UserType', [''=>'Choose a User Type','1' => 'Student', '2' => 'Faculty'], Input::old('UserType'), ['class'=>'form-control'] ); }}
	            @if ($errors->has('UserType')) <p class="help-block">{{ $errors->first('UserType') }}</p> @endif
	    </div>
	</div>

	<div class="forms col-md-12">
		<div class="col-md-6 form-group @if ($errors->has('UserType')) has-error @endif">
	            {{ Form::submit('Submit', ['id'=>'submit','class' => 'btn btn-lg btn-success btn-block sbmt left-sbs','style'=>'width:40%; float:right;']) }}
	    </div>
	</div>

	{{ Form::close(); }}

	
@stop
