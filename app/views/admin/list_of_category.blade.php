@extends('layouts.default')

@section('content')

	<table border=0 width="100%">
		<tr>
			<td><h2><i class="fa fa-tags"></i> List of Catgories</h2></td>
			<td align="right"><a href="/admin/books/category/create" class="btn btn-success" ><i class="fa fa-plus"></i> Add Category</a></td>
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

    @if(Session::get('success_category_updated'))
        <div class="alert alert-success fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <center>{{ Session::get('success_category_updated') }}</center>
        </div>
        {{ Session::forget('success_category_updated') }}
    @endif


	<div class="form-create col-md-12" >
        <table  id="colvixTable" border=0 class="table table-bordered">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @if(count($categories)==0)
                <tr><td colspan="6" align="center">No Crowdies to Display</td></tr>
            @endif

            @foreach($categories as $category)

				<tr>
                    <td>{{ $category->categoryName; }}</td>
                    <td>
                    	<a href="/admin/books/category/edit/{{ $category->categoryID }}" class="btn btn-info" data-toggle="tooltip" data-placement="top"  title="Edit User Information"><i class="fa fa-pencil-square-o"></i></a>
                    </td>
                </tr>     

            @endforeach
        </tbody>
    </table>

@stop
