<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Validator;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminHome(){
        return view('admin-panel');
    }

    public function addProductPage(){
        $products = DB::table('products')->join('categories','products.categoryId','=','categories.categoryId')->get();
        $categories = Category::all();

        return view('admin-add-product', compact('products','categories'));
    }

    public function addProduct(Request $request){
        $request->validate([
            'category' => 'required',
            'name' =>  'required|unique:products,name',
            'description' => 'required',
            'price' => 'required|numeric|min:100',
            'image' => 'required|image|max:10000',
        ]);

        $category = $request->input('category');
        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $image = $request->file('image')->getClientOriginalName();
        $destination = base_path() . '/public/assets';
        $request->file('image')->move($destination, $image);;
        
                
        DB::table('products')->insert(
            ['categoryId' => $category,
            'name' => $name, 
            'description'=> $description, 
            'price' => $price,
            'image' => $image]
        );
        return redirect('/admin-list-product');
    }

    public function productListPage(){
        
        $list = Product::all();
        if (!$list->isEmpty()) {
            $products = DB::table('products')->join('categories','products.categoryId','=','categories.categoryId')->get()->sortBy('name');
            return view('admin-list-product', ['products' => $products]);
        }
        return view('admin-list-product');
    }

    public function delete($id){
        DB::delete('delete from products where id = ?',[$id]);

        return back();
    }

    public function addCategoryPage(){
        $categories = Category::all();

        return view('admin-add-category', compact('categories'));
    }

    public function addCategory(Request $request){
        $request->validate([
            'categoryName' => 'required|unique:categories,categoryName',
        ]);
        $categoryName = $request->input('categoryName');

        DB::table('categories')->insert(
            ['categoryName' => $categoryName]
        );
        return redirect('/admin-list-category');
    }

    public function categoryPage(){
        $categories = Category::all();
        if(!$categories->isEmpty()){
            return view('admin-list-category', compact('categories'));
        }
        return view('admin-list-category');
        
    }

    public function categoryListPage($id){
        $categories = Category::all();
        $list = Product::where('categoryId', $id);
        if ($list->first()) {
            $products = DB::table('products')->join('categories','products.categoryId','=','categories.categoryId')->where('products.categoryId',$id)->get()->sortBy('name');
            return view('admin-list-category', ['categories' => $categories, 'products' => $products]);
        }
        return view('admin-list-category', ['categories' => $categories]);
    }
}
