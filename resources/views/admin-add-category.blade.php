@extends('layouts.app-admin')

@section('content')

<div class="container">
    <form method="POST" action="{{url('/admin-add-category/addCategory')}}" enctype="multipart/form-data" name="addCategory">
        @csrf
        <h3 class="row justify-content-center">Add Category</h3><br>
        <div class="form-group">
            <h6 class="text-center">Name</h6>
            <input type="text" class="form-control" name="categoryName" rows="1" placeholder="Category Name">
        </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-success mr-sm-2 mt-1">Add Category</button>
        </div>
    </form>
</div>

@endsection