@extends('layouts.default')

@section('content')

    <table border=0 width="100%">
        <tr>
            <td><h2>List of Books</h2></td>
            <td align="right"><a href="users/create" class="btn btn-success" ><i class="fa fa-user-plus"></i> Add Book</a></td>
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
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter sortable" id="main-table" border=0>
        <thead>
            <tr>
                <th>Book ID</th>
                
                <th>Title</th>
                
                <th>Quantity</th>
                <th>Author</th>
                <th>Action</th>
            </tr>
        </thead>
       <?php 

         $books = DB::table('books')->select(array('books.bookID as bookId', 'books.title as title', 'books.quantity as quantity', 'author.fName as fname', 'author.lname as lname'))->join('author', 'author.authorID','=','books.author_authorID')
         
         ->paginate(10);

         ?>
        <tbody>

            @if(count($books)==0)
                <tr><td colspan="6" align="center">No Books to Display</td></tr>
            @endif

            @foreach($books as $b)

                <tr>
                    <td>{{ $b->bookId; }}</td>
                    
                    <td>{{ $b->title }}</td>
                    
                    <td>{{ $b->quantity}}</td>
                    <td> {{ $b->fname .' '. $b->lname }} </td>
                    <td></td>
                </tr>     

            @endforeach
        </tbody>
    </table>

    <center>{{ $books->links(); }}</center>

    

    
@stop
