<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = DB::table('products')->paginate(3);
        if(!$products->isEmpty()){
            return view('home',['product' => $products]);
        }
        return view('home');
    }
    
    public function search(Request $request)
    {
        
        $search = $request->input('search');
        $products = Product::where('name','like',"%$search%")->paginate(3);
        return view('home',['product' => $products]);
    }
}
