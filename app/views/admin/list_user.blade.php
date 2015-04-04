@extends('layouts.default')

@section('content')

	<h2> List of Users</h2>
	<hr>

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
                    <td>Waitden</td>
                    
                </tr>                
            @endforeach
        </tbody>
    </table>

     <center>{{ $users->links(); }}</center>

	
@stop
