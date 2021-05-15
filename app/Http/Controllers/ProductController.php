<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {      
        $products = Product::all();
        return view('products.index')->with([
            'products' => $products,
        ]);
    }

    public function create() 
    {
        return view('products.create');
    }

    public function store(ProductRequest $request) 
    {   
        $product = Product::create($request->validated());
       
        return redirect()
            ->route('products.index')
            ->withSuccess("The new product with id {$product->id} was created");
    }

    public function show(Product $product) 
    {
        return view('products.show')->with([
            'product' => $product,
        ]);
    }

    public function edit(Product $product) 
    {
        return view('products.edit')->with([
            'product' => $product,
        ]);
    }

    public function update(ProductRequest $request, Product $product) 
    {
        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->withSuccess("The product with id {$product->id} was edited");
    }

    public function destroy(Product $product) 
    {
        $product->delete();
        return redirect()
            ->route('products.index')
            ->withSuccess("The product with id {$product->id} was deleted");
    }
}
