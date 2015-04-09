@extends('layouts.default')

@section('content')

	<div class="form-create col-md-12">
		<div class="forms col-md-12">
			{{ Form::open() }}
			<div class="forms col-md-12">
			<h3>Password</h3>
			<hr>
			
			 {{ $user->id}}
			
			<div class="forms col-md-12">
			<div class="col-md-3 form-group @if ($errors->has('oldpass')) has-error @endif">
		       	{{ Form::text('oldpass','', array('class' => 'form-control', 'placeholder' => 'Old Password','maxlength'=>'20')) }}
		        @if ($errors->has('oldpass')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('oldpass') }}</p></i> @endif
		    </div>
			</div>
		    <div class="forms col-md-12">
		    <div class="col-md-3 form-group @if ($errors->has('newpass')) has-error @endif">
		       	{{ Form::text('newpass','', array('class' => 'form-control', 'placeholder' => 'New Password','maxlength'=>'20')) }}
		        @if ($errors->has('newpass')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('newpass') }}</p></i> @endif
		    </div>
			</div>
		    <div class="forms col-md-12">	
		    <div class="col-md-3 form-group @if ($errors->has('confirmpass')) has-error @endif">
		       	{{ Form::text('confirmpass','', array('class' => 'form-control', 'placeholder' => 'Confirm New Password','maxlength'=>'20')) }}
		        @if ($errors->has('confirmpass')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('confirmpass') }}</p></i> @endif
		    </div>
			</div>
			<div class="forms col-md-12">
			<div class="col-md-3 ">
		            {{ Form::submit('Submit', ['id'=>'submit','class' => 'btn btn-lg btn-success btn-block sbmt left-sbs','style'=>'width:40%; float:left;']) }}
		    </div>
		</div>
		</div>
			{{Form::close() }}
		</div>
	</div>
	
@stop
