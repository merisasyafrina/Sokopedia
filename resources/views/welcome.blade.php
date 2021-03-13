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
    
</style>
@if(!empty($product))
<div class="container ">
    <div class="row justify-content-center">
        @foreach($product as $p)
        <div class="col-auto mb-3">
            <div class="card" style="width: 20rem;">
                <img class="card-img-top" src="/assets/{{$p->image}}">
                <div class="card-body">
                    <h5 class="card-title">{{$p->name}}</h5>
                    <p class="card-text">IDR. {{number_format($p->price)}}</p>
                    @guest
                    <a href="{{url('/login/')}}" type="button" class="btn btn-success">Product Detail</a>
                    @else
                    <a href="{{url('/detail/'.$p->id.'/')}}" type="button" class="btn btn-success">Product Detail</a>
                    @endguest
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <br>
    <div class="d-flex justify-content-center">{{ $product->withQueryString()->links() }}</div>
    
</div>
@else
<h5 style="text-align: center; color:darkgrey;">List of product is empty.</h5>
@endif
@endsection
