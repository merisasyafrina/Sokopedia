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

    .card-img-top {
        width: 200px;
        padding-left: 20px;
        margin-top: 5px;
        margin-left: 5px;
    }

    .col.col-img {
        width: 200px;
    }

    .center {
        margin-left: 500px;
        margin-top: 20px;
    }

    .input{
        width: 60px;
        margin-bottom: 10px;
        margin-left: 5px;
    }

    
</style>

<div class="container ">
    <h3 class="ml-2 mb-4">Detail Transaction</h3>
    <div class="row justify-content-center">
        @foreach($tdetail as $t)
        <div class="col-auto mb-4">
            <div class="card" style="width: 530px; height: 220px;">
                <div class="row">
                    <div class="col-img">
                        <img class="card-img-top" src="/assets/{{$t->product->image}}">
                    </div>
                    <div class="col">
                        <div class="card-body mt-2">
                            <h5 class="card-title">{{$t->product->name}}</h5>
                            <p class="card-text">Product Price : IDR. {{number_format($t->product->price)}}</p>
                            <p class="card-text">Quantity : {{$t->quantity}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection