<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class WelcomeController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->paginate(3);
        if(!$products->isEmpty()){
            return view('welcome',['product' => $products]);
        }
        return view('welcome');
    }
    
    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('name','like',"%$search%")->paginate(3);
        return view('welcome',['product' => $products]);
    }
}
