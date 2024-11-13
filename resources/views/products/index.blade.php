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
<main>
    <!-- Hero section of the products page-->
    <section id="products-page-hero-section" class="relative min-h-[510px] w-full">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
            <picture class="block h-full w-full">
                <source srcset="{{ asset('assets/img/products_page_hero_image.webp') }}" media="(min-width: 1440px)">
                <source srcset="{{ asset('assets/img/products_page_hero_image.webp') }}" media="(max-width: 640px)">
                <img src="{{ asset('assets/img/products_page_hero_image.webp') }}" class="w-full h-full object-cover" alt="hero section background">
            </picture>
        </div>
        <div class="img_overlay absolute top-0 left-0 w-full h-full bg-[rgba(25,27,38,0.6)]"></div>
        <div class="content_section relative w-full flex items-center justify-center flex-col text-center min-h-[510px] px-[32px] text-white">
            <div class="content-wrapper w-full max-w-[840px] flex flex-col items-start">
                <h1 class="mb-2 text-[1.8rem] font-extrabold text-white capitalize text-center w-full">
                    Explore Our Product Range
                </h1>
                <p class="font-normal text-sm mb-6 text-white">
                    Welcome! Here, you can browse our extensive range of products available for sale. 
                    Take a look at the offerings, complete with detailed descriptions and benefits, to help you promote them effectively.
                </p>            
                <div class="bg-white shadow-md border border-[#ebecf0] h-[56px] pl-6 rounded-full w-full flex items-center relative">
                    <form class="flex-1 flex items-center justify-center min-w-[32px]" action="#" method="get">
                        <button class="flex items-center justify-center border-0 bg-none cursor-pointer text-[24px] text-[#00ab6b]" aria-label="Search products and partners">
                            <span class="font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg>
                            </span>
                        </button>
                        <input 
                            type="search" 
                            name="search" 
                            placeholder="Search for a product that you want to sell..." 
                            value="" 
                            class="text-[#191b26] flex-1 p-2 border-0 bg-none m-0 min-w-[30px] text-[14px] focus:outline-none" 
                        />
                    </form>
                    <div class="inline-flex relative overflow-visible text-left">
                        <div class="flex">
                            <button id="dropdownButton" class="mr-2 rounded-[56px] bg-transparent text-[rgba(25,27,38,.64)] border-0 h-[40px] px-4 
                                inline-flex items-center justify-center cursor-pointer transition-all duration-100 ease-in text-none whitespace-nowrap font-semibold text-[14px]">
                                <span class="label">All Products</span>
                                <span class="ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"
                                            stroke="currentColor" stroke-width="1.3"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    
                        <div id="dropdownMenu" class="text-[rgba(25,27,38,.64)] bg-white absolute top-[calc(100%+4px)] right-0 min-w-[216px] rounded-lg mt-1 hidden border shadow-lg z-[90]">
                            <div class="flex flex-col p-3">
                                <div class="dropdown-item flex items-center px-4 py-2 cursor-pointer">
                                    <span class="icon-image mr-2"></span>
                                    <label>Kaspersky products</label>
                                </div>
                                <div class="dropdown-item flex items-center px-4 py-2 border-t cursor-pointer">
                                    <span class="icon-photo mr-2"></span>
                                    <label>Bitdefender products</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
            <div class="absolute left-8 bottom-6 flex items-center gap-x-4 rounded-full px-4 py-1 text-sm leading-6 ring-1 ring-white">
                <span class="font-semibold">Home</span>
                <span class="h-4 w-px bg-white"></span>
                <span class="flex gap-1">
                    <span class="text-[#fc4b3b]">Products</span>
                    <span><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg></span>
                </span>
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