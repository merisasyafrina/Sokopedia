<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DetailController extends Controller
{
    public function index($id)
    {
        
            $product = Product::where('id', $id)->firstOrFail();
            return view('detail',['product' => $product]);
        
    }
}
