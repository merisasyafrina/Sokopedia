@extends('layouts.app-admin')

@section('content')

@if(!empty($products))
<div class="container ">
    <div class="row justify-content-center">
        <h3 class="row justify-content-center">Product</h3><br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">Product Id</th>
                <th scope="col">Product Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Category</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Description</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            @foreach($products as $p)
            <tbody>
                <tr>
                <th scope="row">{{$p->id}}</th>
                <td>
                    <div class="col-img">
                        <img class="card-img-top" src="/assets/{{$p->image}}" style="width: 150px;">
                    </div>
                </td>
                <td>{{$p->name}}</td>
                <td>{{$p->categoryName}}</td>
                <td>{{$p->price}}</td>
                <td>{{$p->description}}</td>
                <td>
                    <div class="row justify-content-center">
                        <form action="{{'/admin-list-product/'.$p->id.'/'}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger btn-sm" id="deleteBtn">Delete</button>
                        </form>
                    </div>
                </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@else
<h5 style="text-align: center; color:darkgrey;">List of product is empty.</h5>
@endif
@endsection