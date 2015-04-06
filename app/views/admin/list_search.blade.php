@extends('layouts.default')

@section('content')

    <table border=0 width="100%">
        <tr>
            <td><h2>List of Books</h2></td>
            <td><input type="text" name="search" id="search" placeholder="Search"></input><a href="/admin/books/search" class="btn btn-default"><i class="fa fa-binoculars"></i> </a>
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
     
        <tbody>
            <?php 
                 $results = DB::table('books')->where('title', $q)->get();
            ?>
            @if(count($results)==0)
                <tr><td colspan="6" align="center">No Books to Display</td></tr>
            @endif

            @foreach($results as $b)

                <tr>
                    <td>{{ $b->bookID }}</td>
                    
                    <td>{{ $b->title }}</td>
                  
                    <td>{{ $b->quantity}}</td>

                    <td> {{ $b->author }} </td>
                    <td> 
                        <a href="/admin/books/edit/{{ $b->bookID  }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top"  title="Edit Book Information"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top"  title="Deactivate Book"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>     

            @endforeach
        </tbody>
    </table>

    

    

    
@stop
