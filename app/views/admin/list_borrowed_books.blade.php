@extends('layouts.default')

@section('content')

    <table border=0 width="100%">
        <tr>
            <td><h2><i class="fa fa-table"></i> List of Borrowed Books</h2></td>
            <td align="right">
                <a href="/admin/books/category" class="btn btn-success" ><i class="fa fa-book"></i> Add Category</a>
                <a href="/admin/books/create" class="btn btn-success" ><i class="fa fa-book"></i> Add Book</a>
            </td>
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
 
@stop
