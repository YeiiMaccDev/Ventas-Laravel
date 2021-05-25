@extends('layouts.app')

@section('content')
        <h1 class="text-center">Your Cart</h1>
        @empty($cart->products)
            <div class="alert alert-warning" role="alert">
              Your cart is empty!         
            </div>
        @else
            <div class="row justify-content-center">
              @foreach ($cart->products as $product)
                <div class="col-10	col-sm-5	col-md-4	col-lg-4	col-xl-3 ">

                  @include('components.product-card')

                </div>       
              @endforeach    
            </div>
        @endempty
@endsection