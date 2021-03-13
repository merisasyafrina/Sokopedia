
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

@if(!empty($tdetail) && $transaction->totalPrice != 0 && $transaction->status != 1)
<div class="container ">
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
                            <div class="row" style="width: 185px;">
                                <div class="col pr-0">
                                    <form action="{{'/cart/'.$t->id.'/'}}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger" id="deleteBtn">Delete</button>
                                    </form>
                                </div>
                                <div class="col">
                                    <a href="{{url('/cart/edit-page/'.$t->id.'/')}}" type="button" class="btn btn-success">Edit</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
    
    <a href="{{'/cart/checkout/'}}" type="button" class="btn btn-danger center">Checkout</a>
    
</div>
@else
<h5 style="text-align: center; color:darkgrey;">Cart is empty.</h5>
@endif

@endsection