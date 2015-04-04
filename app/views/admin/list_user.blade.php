@extends('layouts.default')

@section('content')

	<table border=0 width="100%">
		<tr>
			<td><h2>List of Users</h2></td>
			<td align="right"><a href="users/create" class="btn btn-success" ><i class="fa fa-user-plus"></i> Add User</a></td>
		</tr>
	</table>
	

	<hr>

	@if(Session::get('status'))
      	<div class="alert alert-success fade in" role="alert">
        	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        	<center>{{ Session::get('status') }}</center>
      	</div>
      	{{ Session::forget('status') }}
    @endif

	<div class="table-responsive" >
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Contact No.</th>
                <th>User Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @if(count($users)==0)
                <tr><td colspan="6" align="center">No Crowdies to Display</td></tr>
            @endif

            @foreach($users as $user)

				<tr class="@if($user->status != 1) deactivated @endif">
                    <td>{{ $user->UserId; }}</td>
                    <td>{{ $user->Fname . ' ' . $user->Mname . ' ' . $user->Lname;  }}</td>
                    <td>{{ $user->ContactNo; }}</td>
                    <td>{{ $user->name; }}</td>
                    <td>
                    	@if($user->status == 1)
                    		Activated
                    	@else
                    		Deactivated
                    	@endif

                    </td>
                    <td>
                    	<a href="/admin/merchant/{{ $user->id  }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top"  title="Edit User Information"><i class="fa fa-pencil-square-o"></i></a>
                    	
                    	@if($user->status == 1)
                        	<button class="btn btn-default" type="button" data-toggle="modal" data-target="{{ '#deactivate_' . $user->id }}"  data-toggle="tooltip" data-placement="top"  title="Deactivate User"><i class="fa fa-ban"></i></button>
                        @else
                        	<button class="iframe btn btn-default" type="button" data-toggle="modal" data-target="{{ '#activate_' . $user->id }}"  data-toggle="tooltip" data-placement="top"  title="Activate User"><i class="fa fa-check"></i></button>
                        @endif



                    </td>
                </tr>     

            @endforeach
        </tbody>
    </table>

    <center>{{ $users->links(); }}</center>

    @foreach($users as $user)       

		<?php
			if($user->status == 1)
	        {
	            $modalTitle = "Deactivate";
	            $modalName = "deactivate";
	            $message = "Are you sure you want to deactivate this user account?";
	        }
        	else
        	{
            	$modalTitle = "Activate";
            	$modalName = "activate";
            	$message = "Are you sure you want to activate this user account?";
            }
       ?>

    	<div class="modal fade" id="{{ $modalName . '_' . $user->id }}" aria-hidden="true">
       		<div class="modal-dialog">
            	<div class="modal-content">
                	<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    	<b style="color:black;">{{ $modalTitle }} User Account</b>
                	</div>
                	<div class="modal-body">
                    	<font color="black">{{ $message }}</font>
                	</div>
                	<div class="modal-footer">
                    	<button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    	<a href="/admin/users/{{ $modalName }}/{{$user->id}}" class="@if($user->status == 1) btn btn-warning @else btn btn-primary @endif" id="confirm">@if($user->status == 1) Deactivate @else Activate @endif</a>
                </div>
            </div>
        </div>
    </div>

@endforeach

	
@stop
