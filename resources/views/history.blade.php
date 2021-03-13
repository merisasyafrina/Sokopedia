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

    .input {
        width: 60px;
        margin-bottom: 10px;
        margin-left: 5px;
    }

    .th-color {
        color: white;
        background-color: #02cf13;
    }
</style>
@if(!empty($transaction))
<div class="container">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="th-color pl-4" scope="col">Transaction History</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction as $t)
            <tr onclick="window.location='{{url('/history/detail-transaction/'.$t->id.'/')}}';">
                <td href="#" class="pl-4">{{$t->updated_at}}</td>
            </tr>
            
            @endforeach
        </tbody>
    </table>
</div>
@else
<h5 style="text-align: center; color:darkgrey;">Transaction is empty.</h5>
@endif
@endsection