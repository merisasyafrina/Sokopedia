@extends('layouts.app')

@section('content')
<style>
    #searchbar{
        display:block;
        margin-right: 30px;
    }
    .searchBox1 {
        margin-top: 5px;
        padding-right: 520px;
        
    }
    .searchBox2 {
        margin-top: 5px;
        padding-right: 380px;
    }
    .card-body{
        background-color: #e9e9e9;
        height: 430px;
    }
    .card-content{
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 20px;
    }
    .container.custom-container{
        max-width: 60%;
    }
</style>
<div class="custom-container container">
    <div class="row">
        <div class="col">
            <img class="card-img-top" src="/assets/{{$product->image}}">
        </div>
        <div class="col">
            <div class="card-body">
                <div class="card-content">
                <h5 class="card-title">{{$product->name}}</h5>
                <hr>
                <p class="card-text">Price : <b style="color: #ff7908;">IDR. {{number_format($product->price)}}</b></p>
                <hr>
                <p class="card-text">Description : {{$product->description}}</p>
                <br>
                <a href="{{url('/add-to-cart/'.$product->id.'/')}}" type="button" class="btn btn-success">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

