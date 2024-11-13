@extends('layouts.base')

@if(session('toast'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Toastify({
                text: "{{ session('toast') }}",
                duration: 3000,
                gravity: "top",
                position: 'center',
                backgroundColor: "#28a745",
                stopOnFocus: true
            }).showToast();
        })
    </script>
@endif


@section('content')
<main class="pt-24 md:pt-32 md:px-6">
    <!-- Hero section -->
    <section id="products-page-hero-section" class="relative bg-[#2c2c64] text-white md:rounded-lg">
        <div class="max-w-7xl mx-auto py-6 sm:py-8 flex flex-col md:flex-row justify-between bg-[#1a1a4d] rounded-lg shadow-lg">
            
            <!-- Left Side Content -->
            <div class="md:w-2/3 mb-4 md:mb-0 flex flex-col p-6">
                <div class="flex mb-8">
                    <div class="relative flex items-center gap-x-4 rounded-full px-4 py-1 
                        text-sm leading-6 text-gray-200 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                        <span class="font-semibold text-[#fc4b3b]">System security</span>
                        <span class="h-4 w-px bg-gray-900/30"></span>
                        <span>
                            Products
                            <img src="{{ asset('assets/img/chevron-right.svg') }}" alt="Chevron Right" class="inline-block h-4 w-4" />
                        </span>
                    </div>
                </div>
                <h1 class="text-5xl font-bold tracking-tight">Explore Our Product Range</h1>
                <p class="mt-6 text-md leading-7 text-gray-300">Welcome! Here, you can browse our extensive range of products available for sale.</p>
                <p class="mt-4 text-md leading-7 text-gray-300">
                    Take a look at the offerings, complete with detailed descriptions and benefits, to help you promote them effectively.
                </p>
                <div class="mt-10 flex items-center gap-x-6">
                    <button class="rounded-md bg-[#fc4b3b] px-4 py-2 text-md font-semibold 
                        text-white shadow-sm hover:bg-[#fc4b3b]/90 focus-visible:outline 
                        focus-visible:outline-2">
                        <a href="" class="no-underline">Bitdefender Products</a>
                    </button>
                </div>
            </div>

            <!-- Right Side Image -->
            <div class="hidden md:flex md:w-1/3 justify-center items-center">
                <img src="{{ asset('assets/img/products_image.svg') }}" alt="Promotional Image" class="w-full h-auto">
            </div>
        </div>
    </section>

    
    <!-- Category Buttons -->
    <div class="flex w-full items-center justify-center mt-4">
        <a href="{{ route('products.index') }}" 
            class="{{ request()->is('products') ? 'bg-[#fc4b3b] text-white' : 'bg-gray-400 text-gray-800' }} py-2 px-4 rounded-l-md"
        >
            All Products
        </a>
        <a href="{{ route('products.bitdefender') }}" 
            class="{{ request()->is('products/bitdefender') ? 'bg-[#fc4b3b] text-white' : 'bg-gray-400 text-gray-800' }} rounded-r-md py-2 px-4"
        >
            Bitdefender Products
        </a>
    </div>

    <!-- Product Grid -->
    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ($products as $product)
            @if ($product->category_id == 2) <!-- Only display Bitdefender products -->
                <div class="bg-[#f0f0f0] p-6 rounded-lg shadow-lg">
                    <!-- Product Header -->
                    <div class="bg-[#2c2c64] text-white text-center py-2 rounded-t-lg">
                        {{ $product->product_plan_name }}
                    </div>
                    <!-- Product Details -->
                    <div class="flex items-center space-x-4 py-4">
                        <img 
                            src="{{ asset('assets/img/bitdefender.png') }}" 
                            alt="{{ $product->product_name }}" 
                            class="h-12 w-auto"
                        />
                        <div>
                            <h3 class="text-lg font-semibold">{{ $product->product_name }}</h3>
                            <p class="text-sm text-gray-600">{{ $product->description }}</p>
                        </div>
                    </div>
                    <!-- Product Reviews -->
                    @if ($product->reviews > 0)
                        <div class="flex items-center mb-4">
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="ml-2 text-sm text-gray-600">({{ $product->reviews }} reviews)</span>
                        </div>
                    @endif
                    <!-- Product Price -->
                    <div class="text-center text-xl font-semibold mb-2">
                        <span class="line-through text-red-500 text-lg italic">KSH {{ number_format($product->price) }}/year</span><br>
                        <span>KSH {{ number_format($product->price_offer) }}/year</span>
                    </div>
                    <!-- Discount -->
                    @if ($product->discount_percentage > 0)
                        <div class="text-center mb-4">
                            <span class="inline-block px-3 py-1 text-sm font-semibold text-white rounded-full" 
                                style="background: linear-gradient(to right, #fc4b3b, #2c2c64);">
                                Save {{ $product->discount_percentage }}%
                            </span>
                        </div>
                    @endif
                    <!-- Compatibility -->
                    <div class="flex justify-center space-x-2 mb-4">
                        @foreach (json_decode($product->compatibility) as $os)
                            <div class="flex flex-row items-center justify-between">
                                <span class="text-sm">{{ $os }}</span>
                            </div>
                            <div>|</div>
                        @endforeach
                    </div>
                    <!-- Product Benefits -->
                    <ul class="list-none pl-6 mb-6 space-y-2">
                        @foreach (json_decode($product->benefits) as $benefit)
                            <li class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-check2-circle flex-shrink-0" viewBox="0 0 16 16">
                                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                </svg>
                                <span class="">{{ $benefit }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <!-- Learn More Button -->
                    <a href="{{ route('product.details', ['id' => $product->id]) }}" class="block bg-[#fc4b3b] text-white text-center py-2 rounded-md hover:bg-[#fc4b3b]/90">
                        Learn More
                    </a>
                </div>
            @endif
        @endforeach
    </div>

</main>
@endsection