<?php

use App\TransactionHeaders;
use Illuminate\Support\Facades\Auth;
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>$okopedia</title>


    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>

<body>
    <style>
        .navbar-brand.navbar-brand-custom {
            color: #38c171;
            font-weight: bold;
        }

        .navbar-brand.navbar-brand-custom:hover {
            color: #299355;
        }

        body {
            background-color: #f8f8f8;
        }

        #searchbar {
            display: none;
        }
    </style>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand navbar-brand-custom" href="{{ url('/') }}">
                    $okopedia
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <form class="form-inline" id="searchbar" action="/search" method="GET">
                            <input class="form-control mr-sm-2 searchBox1" type="text" name="search" value="{{ old('search') }}" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success mt-1 mr-sm-2" type="submit">Search</button>
                        </form>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <form class="form-inline" id="searchbar" action="/search" method="GET">
                            <input class="form-control mr-sm-2 searchBox2" type="text" name="search" value="{{ old('search') }}" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success mr-sm-2 mt-1" type="submit">Search</button>
                            <?php
                                $notif = 0;
                                $transaction = \App\TransactionHeaders::where('userId', Auth::user()->id)->where('status', 0)->first();
                                if($transaction != null){
                                    $notif = \App\TransactionDetails::where('transactionHeaderId', $transaction->id)->count();
                                }                            
                            ?>
                            <a href="{{url('/cart/')}}" type="button" class="btn btn-success mr-sm-2 mt-1">
                                Cart <span class="badge badge-light">{{$notif}}</span>
                            </a>
                            <a href="{{url('/history/')}}" type="button" class="btn btn-success mr-sm-2 mt-1">
                                History
                            </a>
                        </form>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <br>
            @yield('content')
        </main>
    </div>
</body>

</html>