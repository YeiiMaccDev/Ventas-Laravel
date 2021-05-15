<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

    public function store() 
    {   
        
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];

        request()->validate($rules);

        if (request()->status == 'available' && request()->stock == 0) {
            return redirect()
            ->back()
            ->withInput(request()->all())
            ->withErrors('If available must have stock');
        }


        $product = Product::create(request()->all());
       
        return redirect()
            ->route('products.index')
            ->withSuccess("The new product with id {$product->id} was created");
            // ->with(['success' => "The new product with id {$product->id} was created"]);

    }

    public function show(Product $product) 
    {
        // $product = Product::findOrFail($product);
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

    public function update(Product $product) 
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];

        request()->validate($rules);

        $product->update(request()->all());

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
