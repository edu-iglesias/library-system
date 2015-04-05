<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Library System</title>
        {{ HTML::style('css/font-awesome.css') }}
        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/bootstrap-theme.min.css') }}
        {{ HTML::style('css/sb-admin.css') }}
        {{ HTML::style('css/custom.css') }}
        {{ HTML::style('css/signin.css') }}

        <style type="text/css">
	        body {
	            background-color: #333333;
	        }
	    </style>
       
    </head>


    <body role="document"  >
		 <div class="container theme-showcase" role="main">

			<!-- Creates the form -->
		    {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}

		    	@if(Session::get('login_failure'))
			      	<div class="alert alert-danger fade in" role="alert">
			        	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			        	<center>{{ Session::get('login_failure') }}</center>
			      	</div>
			      	{{ Session::forget('login_failure') }}
			    @endif

			    @if(Session::get('logout_successful'))
			      	<div class="alert alert-success fade in" role="alert">
			        	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			        	<center>{{ Session::get('logout_successful') }}</center>
			      	</div>
			      	{{ Session::forget('logout_successful') }}
			    @endif

				{{ Form::text('userId', null, array('class' => 'form-control', 'placeholder' => 'Username')) }}
				{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
				<br/>
				{{ Form::submit('Log in', array('class' => 'btn btn-lg btn-success btn-block')) }}
			{{ Form::close() }}
		</div>

		<div class="container" style="width: 100%">
	        <p class="text-muted" style="text-align: center; font-size: 11px;padding-top: 60px;">Developed by 
	            <a href="#">
	            Web Synergy 2.0</a><br/>
	            Powered by <a href="http://laravel.com/" style="color: #f47063">Laravel</a>.
	        </p>
    	</div>
	</body>

        <!-- JavaScript -->
        {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}

    </body>
</html>