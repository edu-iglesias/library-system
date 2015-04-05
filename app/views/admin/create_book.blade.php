@extends('layouts.default')

@section('content')

	<h2> Create User</h2>
	<hr>

	@if(Session::get('success_user_created'))
      	<div class="alert alert-success fade in" role="alert">
        	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        	<center>{{ Session::get('success_user_created') }}</center>
      	</div>
      	{{ Session::forget('success_user_created') }}
    @endif

	<div class="form-create col-md-12">

		{{ Form::open() }}

		

		<div class="forms col-md-12">
			<div class="col-md-3 form-group @if ($errors->has('title')) has-error @endif">
		       	{{ Form::text('title', array('class' => 'form-control', 'placeholder' => 'Book Title','maxlength'=>'50')) }}
		        @if ($errors->has('title')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('title') }}</p></i> @endif
		    </div>
		</div>

		<div class="forms col-md-12">
			<div class="col-md-3 form-group @if ($errors->has('quantity')) has-error @endif">
		       	{{ Form::text('quantity', array('class' => 'form-control', 'placeholder' => 'Quantity','maxlength'=>'1')) }}
		        @if ($errors->has('quantity')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('quantity') }}</p></i> @endif
		    </div>
		</div>

		<div class="forms col-md-12">
			<?php $c = DB::table('category')->get();?>
          
			<div >
		        @foreach($c as $xx)
                      
                            <option value="{{ $xx->categoryID }}">{{ $xx->categoryName }}</option>
                       
                    @endforeach
		    </div>
		</div>

		<div class="forms col-md-12">
			<div class="col-md-6 form-group @if ($errors->has('author')) has-error @endif">
		        {{ Form::text('author', array('class' => 'form-control', 'placeholder' => 'Author(s)','maxlength'=>'70')) }}
		        @if ($errors->has('author')) <i><p class="help-block" style="margin-left:5px">{{ $errors->first('author') }}</p></i> @endif
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