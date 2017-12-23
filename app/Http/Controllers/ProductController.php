<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        //dispaly all products
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        //show form to create publication
        return view('/products.create');
    }

    public function store(Request $request)
    {
        //create new product
        //first validate input
        $this->validate(request(), ['productName'=>'required|min:2', 'price'=>'required|integer']);
        //database transaction
        Product::create(['product_name'=>request('productName'), 'price'=>request('price')]);
        return redirect('/products');
    }

    
    public function show(Product $product)
    {
        //get product instance
        return view('products.show', compact('product'));
    }

    
    public function edit(Product $product)
    {
        //get details and post to form for change
        return view('products.edit', compact('product'));
    }

    
    public function update(Request $request, $id)
    {
        //validate the patch request
        $product = Product::find($id);
        $this->validate(request(), ['productName'=>'required|min:2', 'price'=>'required|integer']);
        //save to database
        $product->update(['product_name'=>request('productName'), 'price'=>request('price')]);
        return view('products.show', compact('product'));

    }

   
    public function destroy($id)
    {
        //get product instance
        $product = Product::find($id);
        if($product <> null){
            $product->delete();
            return redirect('/products');
        }else{
            //404
            return view('layouts.deadend', ['error'=>'Seems what you are trying to delete has already been deleted!']);
        }

    }
}
