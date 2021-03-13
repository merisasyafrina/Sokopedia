@extends('layouts.app')

@section('content')

<style>
    #searchbar {
        display: block;
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

    .card-body {
        background-color: #e9e9e9;
        height: 430px;
    }

    .card-content {
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 20px;
    }

    .container.custom-container {
        max-width: 60%;
    }
    .input{
        width: 70px;
        margin-bottom: 10px;
    }
    .col-sm-3half{
        position: relative;
        min-height: 1px;
        padding-right: 8px;
        padding-left: 15px;
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
                    
                    <form method="post" action="{{'/add-to-cart/order/'.$product->id.'/'}}">
                    {{ csrf_field() }}
                    <p class="card-text form-group row">
                        <label class="col-sm-3half col-form-label">Quantity : </label>
                        <input type="number" name="quantity" class="form-control input" value="1" min="1">
                    </p>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Add to Cart">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection