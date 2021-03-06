@extends('user.layout.default')

@section('content')

	<div class="form-create col-md-12" style="margin-top:65px">

		@if(Session::get('borrowing_error'))
	      	<div class="alert alert-danger fade in" role="alert">
	        	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	        	<center>{{ Session::get('borrowing_error') }}</center>
	      	</div>
	      	{{ Session::forget('borrowing_error') }}
	    @endif

	    @if(Session::get('borrowing_success'))
	      	<div class="alert alert-success fade in" role="alert">
	        	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	        	<center>{{ Session::get('borrowing_success') }}</center>
	      	</div>
	      	{{ Session::forget('borrowing_success') }}
	    @endif


        <div class="input-group col-md-12" >

			<div class="table-responsive" >
		        <table  id="colvixTable" border=0 class="table table-bordered">
			        <thead>
			            <tr>
			                <th>Book ID</th>
			                <th>Title</th>
			                <th>Author</th>
			                <th>Quantity</th>
			                <th>Date Borrowed</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>

			            @if(count($books)==0)
			                <tr><td colspan="6" align="center">No Books to Display</td></tr>
			                
			            @endif

			            @foreach($books as $book)

			                <tr>
			                    <td>{{ $book->bookID; }}</td>
			                    <td>{{ $book->title }}</td>
			                    <td>{{ $book->author }}</td>
			                    <td>{{ $book->quantity }}</td>
			                    <td>{{ $book->created_at }}</td>
			                    <td> <button class="btn btn-danger" @if( $book->quantity  <= 0) disabled @endif type="button" data-toggle="modal" data-target="{{ '#book_' . $book->bookID }}"  data-toggle="tooltip" data-placement="top"  title="Return Book"><i class="fa fa-reply"></i></i> Return </button> </td>
			                </tr>     

			            @endforeach
			        </tbody>
		    </table>
		</div>
	</div>

	<?php $modalName = 'book' ?>
	@foreach($books as $book)       
    	<div class="modal fade" id="{{ $modalName . '_' . $book->bookID }}" aria-hidden="true">
       		<div class="modal-dialog">
            	<div class="modal-content">
                	<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    	<b style="color:black;">Return Book</b>
                	</div>
                	<div class="modal-body">
                		{{ Form::open() }}
                    	<font color="black">How many copies would you like to return?</font> <br><br>
                    	<input type="number" name="quantity" class="form-control" min=1 max="{{ $book->quantity }}"value=1 /> 
                	</div>
                	<div class="modal-footer">
                		<div class="col-md-12">
                				<input type="hidden" name="bookID" value="{{$book->bookID}}" />
                				<input type="hidden" name="maxQuantity" value="{{$book->quantity}}" />
                    			{{ Form::submit('Return', ['id'=>'submit','class' => 'btn btn-danger']) }}
	                		{{ Form::close ()}}
	                	</div>
	                </div>
	            </div>
	        </div>
	    </div>

	@endforeach

@stop
