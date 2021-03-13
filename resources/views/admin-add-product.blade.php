@extends('layouts.app-admin')

@section('content')

<div class="container">
<form action="{{url('/admin-add-product/addProduct')}}" method="post" enctype="multipart/form-data">
            @csrf
                <h3 class="row justify-content-center">Add Product</h3><br>
                <div class="form-group">
                    <h6 class="text-center">Name</h6>
                    <input class="form-control" type="text" placeholder="Product Name" name="name">
                </div>
                <div class="form-group">
                    <h6 class="text-center">Category</h6>
                    <select class="form-control" name="category">
                        <optgroup label="Categories">
                            @foreach($categories as $category)
                            <option value="{{$category->categoryId}}">{{$category->categoryName}}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <h6 class="text-center">Description</h6><input class="form-control" type="text" name="description" placeholder="Description">
                </div>
                <div class="form-group">
                    <h6 class="text-center">Price</h6><input class="form-control" type="number"  name="price" placeholder="Price">
                </div>
                <div class="form-group">
                    <h6 class="text-center">Choose File</h6><br>
                    <div class="row justify-content-center">
                        <input class="row justify-content-center" type="file" name="image" accept="assets/*" style="width: 260px;">
                    </div>
                </div><br>
                <div class="form-group row justify-content-center">
                <button class="btn btn-success" type="submit">Add Product</button>
                </div>
            </form>
</div>

@endsection