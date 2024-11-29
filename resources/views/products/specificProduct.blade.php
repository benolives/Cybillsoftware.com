@extends('layouts.base')

@section('content')
<div class="pt-24 md:pt-32 bg-teal-400">
    <div id="specific_product_page_hero" class="py-10 px-6 flex flex-col justify-between lg:flex-row gap-16 lg:items-start">
        <div class="order-2 md:order-1 lg:w-1/3">
            <img 
                src="
                @if($product->product_name === 'Bitdefender Antivirus Plus')
                    {{ asset('assets/img/bitdefender_antivirus_image.webp') }}
                @elseif($product->product_name === 'Bitdefender Total Security')
                    {{ asset('assets/img/bitdefender_total_security_image.webp') }}
                @elseif($product->product_name === 'Bitdefender PREMIUM SECURITY')
                    {{ asset('assets/img/bitdefender_premium_image.webp') }}
                @else
                    {{ asset('assets/img/Kaspersky-Internet-Security-11-Users.png') }}
                @endif
                " 
                alt="{{ $product->product_name }}" 
                class="w-full h-full aspect-square object-cover rounded-xl"
            >
        </div>
        <div class="flex flex-col gap-4 lg:w-2/3">
            <div>
                <h1 class="text-3xl font-bold">{{ $product->product_name }}</h1>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex text-center items-center px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded-md">
                    {{ $product->description }}
                </span>
                @if ($product->reviews > 0)
                    <span class="mt-2 text-gray-700 text-md">
                        ⭐⭐⭐⭐⭐ {{ $product->reviews }} reviews
                    </span>
                @else
                    <span class="">
                    </span>
                @endif
            </div>
            <!-- Product Price -->
            <div class="flex flex-col">
                @if($product->discount_percentage > 0)
                    <div class="flex items-center">
                        <span class="line-through text-gray-500 text-lg mr-2">Ksh {{ number_format($product->price, 2) }}</span>
                        <span class="text-red-600 font-bold text-2xl">Ksh {{ number_format($product->price_offer, 2) }}</span>
                    </div>
                @else
                    <h6 class="text-2xl font-semibold">Ksh {{ number_format($product->price_partner, 2) }}</h6>
                @endif
            </div>
            <!-- Compatibility -->
            <div class="flex justify-start space-x-2 mb-2">
                @foreach (json_decode($product->compatibility) as $os)
                    <div class="flex flex-row items-center justify-between">
                        <span class="text-sm font-semibold text-[#2c2c64]">{{ $os }}</span>
                    </div>
                    <div>|</div>
                @endforeach
            </div>
            <!-- CTA SECTION -->
            <div class="flex flex-col md:flex-row relative gap-12 md:gap-4">
                <div class="py-4 w-full md:w-2/3">
                    <h2 class="text-xl font-bold text-gray-900">{{ $product->product_plan_name }}</h2>
                    <p class="text-sm text-gray-500">Explore our features and pricing</p>
                    <a href="{{ $product->learn_more_link }}" target="_blank" rel="noopener noreferrer" class="mt-4 inline-block bg-[#fc4b3b] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#e03e32] transition">
                        Learn more about this product
                    </a>
                </div>
                <div class="relative flex flex-col justify-center items-center bg-blue-900 text-white p-6 w-full md:w-1/3 rounded-sm">
                    @if($product->discount_percentage > 0)
                        <div class="absolute top-0 right-0 transform translate-x-4 -translate-y-4 bg-red-600 text-white font-bold rounded-full px-3 py-1 text-xs">
                            {{ $product->discount_percentage }}% OFF
                        </div>
                        <div class="flex items-center">
                            <span class="line-through text-gray-300 text-lg mr-2">KSH {{ number_format($product->price_partner, 2) }}</span>
                            <span class="text-red-300 font-bold text-2xl">KSH {{ number_format($product->price_offer, 2) }}</span>
                        </div>
                    @else
                        <div class="text-2xl font-bold mt-4 md:mt-0">KSH {{ number_format($product->price_partner, 2) }}</div>
                    @endif
                    <div class="mt-4 flex flex-col space-y-2">
                        <a href="{{ route('purchase.receipt', $product->product_api_id) }}" class="bg-white text-blue-900 font-semibold py-3 px-8 rounded-lg text-lg hover:bg-gray-100 transition-colors text-center">
                            Buy Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- What's Included Section -->
    <section class="px-6 py-8 bg-gray-200 rounded-md">
        <div class="w-full text-center">
            <h2 class="text-2xl md:text-4xl font-bold text-gray-900">What is included in {{ $product->product_plan_name }}?</h2>
            <p class="text-md md:text-lg text-gray-600 mb-6">Explore all the protection, performance, and privacy features in our new security plan.</p>
        </div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @if (isset($product->benefits) && count(json_decode($product->benefits)) > 0)
        @foreach(json_decode($product->benefits) as $benefit)
            <div class="bg-white p-6 shadow-md rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                </svg>
                <p class="text-gray-600 mb-4">{{ $benefit }}</p>
                <button class="text-blue-900 font-semibold">
                    <a href="{{ $product->learn_more_link }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3">
                        More Info
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="blue" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                        </svg>
                    </a>
                </button>
            </div>
        @endforeach
    @else
        <!-- Fallback message with a suggestion to visit the company website -->
        <div class="bg-white p-6 shadow-md rounded col-span-3">
            <p class="text-gray-600 mb-4">No benefits are listed for this product at the moment. For more information, please check the company's official website or contact customer support.</p>
            <p class="text-blue-600 font-semibold">
                <a href="https://www.kaspersky.co.za" target="_blank" rel="noopener noreferrer">Visit the official website</a> for more details.
            </p>
        </div>
    @endif
</div>


    </section>
</div>
@endsection