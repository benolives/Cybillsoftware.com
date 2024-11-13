@extends('layouts.base')

@section('content')

<div class="max-w-7xl mx-auto pt-24 md:pt-32">
    <div id="specific_product_page_hero" class="py-10 px-6 flex flex-col justify-between lg:flex-row gap-16 lg:items-start">
        <!-- Product Image -->
        <div class="order-2 md:order-1 lg:w-1/3">
            <img src="{{ asset('assets/img/specific_kaspersky_product.jpg') }}" alt="{{ $product->name }}" class="w-full h-full aspect-square object-cover rounded-xl">
        </div>

        <!-- Product Details -->
        <div class="flex flex-col gap-4 lg:w-2/3">
            <!-- Product Name -->
            <div>
                <h1 class="text-3xl font-bold">{{ $product->product_name }}</h1>
            </div>

            <!-- Product Description & Rating -->
            <div class="flex items-center gap-3">
                <span class="inline-flex text-center items-center px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded-md">
                    {{ $product->description ?? 'No description available' }}
                </span>
                <span class="mt-2 text-gray-700 text-md">
                    ⭐⭐⭐⭐⭐ reviews
                </span>
            </div>

            <!-- Product Price -->
            <div class="flex flex-col">
                <h6 class="text-2xl font-semibold">Ksh {{ number_format($product->price, 2) }}</h6>
            </div>

            <!-- CTA Section (Buy Now or Add to Cart) -->
            <div class="flex flex-col md:flex-row relative gap-12 md:gap-4">
                <div class="mt-4">
                    <a href="{{ route('purchase.receipt', $product->product_api_id) }}" class="bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700 transition duration-300">
                        Buy Now
                    </a>
                </div>
                <div class="mt-4">
                    <a href="#" class="bg-green-600 text-white py-2 px-6 rounded-md hover:bg-green-700 transition duration-300">
                        Add to Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection