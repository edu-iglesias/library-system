@extends('user.layout.default')

@section('content')

	<div class="form-create col-md-12" style="margin-top:65px">
        <div class="input-group col-md-12" >
			<div class="table-responsive" >
		        <table  id="colvixTable" border=0 class="table table-bordered">
			        <thead>
			            <tr>
			                <th>Book ID</th>
			                <th>Book Title</th>
			                <th>Author</th>
			                <th>Quantity</th>
			                <th>Date Borrowed</th>
			                <th>Date Returned</th>
			            </tr>
			        </thead>
			        <tbody>

			            @if(count($archives)==0)
			                <tr><td colspan="6" align="center">No Archives Found.</td></tr>
			            @endif

			            @foreach($archives as $archive)

			                <tr>
			                    <td>{{ $archive->bookID; }}</td>
			                    <td>{{ $archive->title; }}</td>
			                    <td>{{ $archive->author }}</td>
			                    <td>{{ $archive->quantity }}</td>
			                    <td>{{ $archive->date_borrowed }}</td>
			                    <td>{{ $archive->date_returned }}</td>
			                </tr>     

			            @endforeach
			        </tbody>
		    </table>

		</div>
	</div>
@stop
