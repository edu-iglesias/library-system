@extends('layouts.default')

@section('content')

	<h2> Create User</h2>
	<hr>

	@if(Session::get('success_user_created'))
      	<div class="alert alert-success fade in" role="alert">
        	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        	<center>{{ Session::get('success_user_created') }}</center>
      	</div>
    @endif

	<div class="form-create col-md-12">

		{{ Form::open() }}

		<div class="forms col-md-12">
			<div class="col-md-6 form-group @if ($errors->has('UserId')) has-error @endif">
		        {{ Form::text('UserId',Session::get('UserId'),array('class' => 'form-control', 'placeholder' => 'User ID','maxlength'=>'9')) }}
		        @if ($errors->has('UserId')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('UserId') }}</p></i> @endif
		    </div>
		</div>

		<div class="forms col-md-12">
			<div class="col-md-3 form-group @if ($errors->has('password')) has-error @endif">
		       	{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password','maxlength'=>'20')) }}
		        @if ($errors->has('password')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('password') }}</p></i> @endif
		    </div>
		    <div class="col-md-3 form-group @if ($errors->has('password_confirmation')) has-error @endif">
		        {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Re-Type Password')) }}
		    </div> 
		</div>

		<div class="forms col-md-12">
			<div class="col-md-6 form-group @if ($errors->has('FirstName')) has-error @endif">
		        {{ Form::text('FirstName',Session::get('FirstName'),array('class' => 'form-control', 'placeholder' => 'First Name','maxlength'=>'50')) }}
		        @if ($errors->has('FirstName')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('FirstName') }}</p></i> @endif
		    </div>
		</div>

		<div class="forms col-md-12">
			<div class="col-md-6 form-group @if ($errors->has('LastName')) has-error @endif">
		        {{ Form::text('LastName',Session::get('LastName'),array('class' => 'form-control', 'placeholder' => 'Last Name','maxlength'=>'50')) }}
		        @if ($errors->has('LastName')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('LastName') }}</p></i> @endif
		    </div>
		</div>

		<div class="forms col-md-12">
			<div class="col-md-6 form-group @if ($errors->has('MiddleName')) has-error @endif">
		        {{ Form::text('MiddleName',Session::get('MiddleName'),array('class' => 'form-control', 'placeholder' => 'Middle Name','maxlength'=>'50')) }}
		        @if ($errors->has('MiddleName')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('MiddleName') }}</p></i> @endif
		    </div>
		</div>

		<div class="forms col-md-12">
			<div class="col-md-6 form-group @if ($errors->has('ContactNo')) has-error @endif">
		        {{ Form::text('ContactNo',Session::get('ContactNo'),array('class' => 'form-control', 'placeholder' => 'Contact No.','maxlength'=>'50')) }}
		        @if ($errors->has('ContactNo')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('ContactNo') }}</p></i> @endif
		    </div>
		</div>

		<div class="forms col-md-12">
			<div class="col-md-6 form-group @if ($errors->has('UserType')) has-error @endif">
		            {{ Form::select('UserType', [''=>'Choose a User Type','2' => 'Student', '3' => 'Faculty'], Input::old('UserType'), ['class'=>'form-control'] ); }}
		            @if ($errors->has('UserType')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('UserType') }}</p></i> @endif
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
