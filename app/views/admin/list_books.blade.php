@extends('layouts.default')

@section('content')

    <table border=0 width="100%">
        <tr>
            <td><h2><i class="fa fa-book"></i> List of Books</h2></td>
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
                <th>Quantity</th>
                <th>Author</th>
                <th>Action</th>
            </tr>
        </thead>
     
        <tbody>

            @if(count($books)==0)
                <tr><td colspan="6" align="center">No Books to Display</td></tr>
            @endif

            @foreach($books as $b)

                <tr>
                    <td>{{ $b->bookId; }}</td>
                    
                    <td>{{ $b->title }}</td>
                  
                    <td>{{ $b->quantity}}</td>

                    <td> {{ $b->author }} </td>
                    <td> 
                        <a href="/admin/books/edit/{{ $b->bookId  }}" class="btn btn-info" data-toggle="tooltip" data-placement="top"  title="Edit Book Information"><i class="fa fa-pencil-square-o"></i></a>
                       <!--  <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top"  title="Deactivate Book"><i class="fa fa-trash"></i></a> -->
                    </td>
                </tr>     

            @endforeach
        </tbody>
    </table>
 
@stop
