@extends('layouts.app')

@section('content')
        <h1 class="text-center">Welcome</h1>
        @empty($products)
            <div class="alert alert-danger" role="alert">
              No products yet!         
            </div>
        @else
            <div class="row">
              @foreach ($products as $product)
                <div class="col-3 mb-4">

                  @include('components.product-card')

                </div>       
              @endforeach    
            </div>
        @endempty
@endsection

