@extends('layouts.app', ['title' => $category->name])

@section('content')
    <div class="container">

        <div class="row">

        @include('partials.sidebar')
        <!-- sidebar -->

            <div class="col-lg-9">
                <div class="row my-5">
                    @forelse($products as $product)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="{{ route('products.show', $product->id) }}">
                                    <img class="card-img-top rounded" height="200" width="200"
                                         src="{{ imagePath($product->image) }}" alt="{{ $product->name }}">
                                </a>
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                    </h6>
                                    <h5 class="text-success">${{ $product->price }}</h5>
                                    <span class="text-secondary">({{ $product->quantity }}) peaces available.</span>
                                    <!-- AddToCartButton -->
                                    <livewire:cart.add-to-cart-button :product="$product"/>
                                    <!-- AddToCartButton end -->

                                </div>
                                <div class="card-footer">
                                    <small class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h1 class="text-center">No products available in this category.</h1>
                    @endforelse
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
