<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\PanelProduct;
use App\Http\Requests\ProductRequest;
use App\Scopes\AvailableScope;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    { 
        return view('products.index')->with([
            // Consultar los productos sin la relacion a imagenes
            'products' =>  PanelProduct::without('images')->get(),
        ]);
    }

    public function create() 
    {
        return view('products.create');
    }

    public function store(ProductRequest $request) 
    {   
        dd($request->validated());
        $product = PanelProduct::create($request->validated());
       
        return redirect()
            ->route('products.index')
            ->withSuccess("The new product with id {$product->id} was created");
    }

    public function show(PanelProduct $product) 
    {
        return view('products.show')->with([
            'product' => $product,
        ]);
    }

    public function edit(PanelProduct $product) 
    {
        return view('products.edit')->with([
            'product' => $product,
        ]);
    }

    public function update(ProductRequest $request, PanelProduct $product) 
    {
        dd($request->validated());
        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->withSuccess("The product with id {$product->id} was edited");
    }

    public function destroy(PanelProduct $product) 
    {
        $product->delete();
        return redirect()
            ->route('products.index')
            ->withSuccess("The product with id {$product->id} was deleted");
    }
}
