@extends('layouts.default')

@section('content')

    <table border=0 width="100%">
        <tr>
            <td><h2><i class="fa fa-book"></i> List of Books</h2></td>
            <td align="right"><a href="/admin/books/create" class="btn btn-success" ><i class="fa fa-book"></i> Add Book</a></td>
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

    <div class="form-create col-md-12" >
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

@stop
