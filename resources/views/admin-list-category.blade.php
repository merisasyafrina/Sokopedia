@extends('layouts.app-admin')

@section('content')
@if(!empty($categories))
<div class="container">
    <div class="row justify-content-center">
        <h3 class="row justify-content-center">Category</h3><br><br>
        @foreach($categories as $c)

        <a href="{{url('admin-list-category/'.$c->categoryId)}}" type="button" class="btn btn btn-outline-dark btn-lg btn-block ">{{$c->categoryName}}</a>

        @endforeach
    </div>
    <br><br>

    @if(\Request::is('admin-list-category/*'))
    @if(!empty($products))
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
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <h5 style="text-align: center; color:darkgrey;">List of product is empty.</h5>
    @endif

    @endif
</div>
@else
<h5 style="text-align: center; color:darkgrey;">List of category is empty.</h5>
@endif

@endsection