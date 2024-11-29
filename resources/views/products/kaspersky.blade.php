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
<main class="">
    <!-- Hero Section -->
    <section id="kaspersky-hero-section" class="relative min-h-[510px] w-full">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
            <picture class="block h-full w-full">
                <source srcset="{{ asset('assets/img/kaspersky_background.jpg') }}" media="(min-width: 1440px)">
                <source srcset="{{ asset('assets/img/kaspersky_background.jpg') }}" media="(max-width: 640px)">
                <img src="{{ asset('assets/img/kaspersky_background.jpg') }}" class="w-full h-full object-cover" alt="Kaspersky hero section background">
            </picture>
        </div>
        <div class="img_overlay absolute top-0 left-0 w-full h-full bg-[rgba(25,27,38,0.6)]"></div>
        <div class="content_section relative w-full flex items-center justify-center flex-col text-center min-h-[510px] px-[32px] text-white">
            <div class="content-wrapper w-full max-w-[840px] flex flex-col items-start">
                <h1 class="mb-2 text-[1.8rem] font-extrabold text-white capitalize text-center w-full">
                    Kaspersky Software Products
                </h1>
                <p class="font-normal text-sm mb-6 text-white">
                    With Kaspersky Software, you can easily start reselling and earn commission with just a few clicks. Our platform is designed to help you maximize your earnings with a user-friendly interface, marketing tools, and comprehensive support.
                </p>            
                <!-- Search Form -->
                <div class="bg-white shadow-md border border-[#ebecf0] h-[56px] pl-6 rounded-full w-full flex items-center relative">
                    <form class="flex-1 flex items-center justify-center min-w-[32px]" action="#" method="GET">
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
                            placeholder="Search for Kaspersky products..." 
                            class="text-[#191b26] flex-1 p-2 border-0 bg-none m-0 min-w-[30px] text-[14px] focus:outline-none" 
                        />
                    </form>
                    <div class="inline-flex relative overflow-visible text-left">
                        <div class="flex">
                            <button id="dropdownButton" class="mr-2 rounded-[56px] bg-transparent text-[rgba(25,27,38,.64)] border-0 h-[40px] px-4 
                                inline-flex items-center justify-center cursor-pointer transition-all duration-100 ease-in text-none whitespace-nowrap font-semibold text-[14px]">
                                <span class="label">{{ request()->input('category') ?? 'All Products' }}</span>
                                <span class="ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"
                                            stroke="currentColor" stroke-width="1.3"/>
                                    </svg>
                                </span>
                            </button>
                        </div>

                        <!-- Dropdown menu for categories -->
                        <div id="dropdownMenu" class="text-[rgba(25,27,38,.64)] bg-white absolute top-[calc(100%+4px)] right-0 min-w-[216px] rounded-lg mt-1 hidden border shadow-lg z-[90]">
                            <div class="flex flex-col p-3">
                                <form action="#" method="GET">
                                    <div class="dropdown-item flex items-center px-4 py-2 cursor-pointer">
                                        <input type="radio" name="category" value="" class="mr-2" {{ request()->input('category') == '' ? 'checked' : '' }}>
                                        <label>All Products</label>
                                    </div>
                                    <div class="dropdown-item flex items-center px-4 py-2 border-t cursor-pointer">
                                        <input type="radio" name="category" value="Antivirus" class="mr-2" {{ request()->input('category') == 'Antivirus' ? 'checked' : '' }}>
                                        <label>Antivirus Solutions</label>
                                    </div>
                                    <div class="dropdown-item flex items-center px-4 py-2 border-t cursor-pointer">
                                        <input type="radio" name="category" value="Security" class="mr-2" {{ request()->input('category') == 'Security' ? 'checked' : '' }}>
                                        <label>Security Products</label>
                                    </div>
                                    <div class="dropdown-item flex items-center px-4 py-2 border-t cursor-pointer">
                                        <input type="radio" name="category" value="Partner Sales" class="mr-2" {{ request()->input('category') == 'Partner Sales' ? 'checked' : '' }}>
                                        <label>Partner Sales</label>
                                    </div>
                                    <div class="dropdown-item flex items-center px-4 py-2 border-t cursor-pointer">
                                        <button type="submit" class="w-full text-center bg-[#fc4b3b] text-white p-2 rounded-full">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
    </section>
    <!-- Product Grid for Kaspersky -->
    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-6 md:px-8">
        @foreach ($kasperskyProducts as $product)
            <div class="bg-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                <!-- Product Header -->
                <div class="bg-[#2c2c64] text-white text-center py-4 rounded-t-lg">
                    <h3 class="text-xl font-bold">{{ $product->product_name }}</h3>
                </div>

                <!-- Product Image and Details -->
                <div class="flex flex-col items-center py-6">
                    <img 
                        src="{{ asset('assets/img/kaspersky_api_img.webp') }}" 
                        alt="{{ $product['name'] }}" 
                        class="h-24 md:h-32 w-auto mb-6 rounded-lg shadow-md"
                    />
                    <p class="text-sm text-gray-600 text-center max-w-xs md:max-w-sm">A trusted security solution for your system. Keep your data and devices protected with Kaspersky.</p>
                </div>

                <!-- Product Pricing -->
                <div class="text-center text-xl font-semibold mb-6">
                    <!-- <span class="line-through text-red-500 text-lg italic">KSH {{ number_format($product['price']) }}/year</span><br> -->
                    <span class="text-xl font-semibold text-black italic">Ksh {{ number_format($product->price_partner) }}/month</span>
                </div>

                <!-- Learn More Button -->
                <a href="{{ route('product.details', ['id' => $product->id]) }}" 
                    class="block bg-[#fc4b3b] text-white text-center py-3 rounded-md transition duration-300 ease-in-out transform hover:bg-[#fc4b3b]/90 hover:scale-105">
                    Buy product
                </a>
            </div>
        @endforeach
    </div>

</main>
@endsection
