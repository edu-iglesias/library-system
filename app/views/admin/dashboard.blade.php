@extends('layouts.default')

@section('content')

	<div class="form-create col-md-12">
	
	<?php $user = DB::table('users')->where('id',Auth::id())->get(); ?>
	
		<div class="forms col-md-12">
			<div class="col-md-6 form-group">
			<h3>Accounts</h3>
			<hr>
		       @foreach($user as $u)
		       <p>User ID:<span style="margin-left:5px">{{$u->UserId}}</span></p>
		       <p>Password:<span style="margin-left:5px; margin-right:5px">**********</span>[<a href="/admin/changepass/{{ $u->id }}">Edit</a>]</p>
		        @endforeach
		   
		    <div style="margin-top:8px">
			<h3>Profile</h3>
			<hr>
				@foreach($user as $u1)
		       <p>First Name:<span style="margin-left:5px">{{$u1->Fname }}</span></p>
		       <p>Middle Name:<span style="margin-left:5px; margin-right:5px">{{$u1->Mname }}</p>
		       <p>Last Name:<span style="margin-left:5px; margin-right:5px">{{$u1->Lname }}</p>
		       @if($u1->ContactNo != null)
		       <p>Contact No:<span style="margin-left:5px; margin-right:5px">{{$u1->ContactNo }}</p>
		       @else
		       <p>Contact No:<span style="margin-left:5px; margin-right:5px">None</p>
		       @endif
		        @endforeach
		    </div>

			</div>
		</div>

		
	
	</div>
	
@stop
