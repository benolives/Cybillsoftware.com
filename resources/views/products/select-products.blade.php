@extends('layouts.auth_base')

@section('content')
<section class="min-h-screen flex flex-col justify-center items-center py-10">
    <div class="text-center">
        <h1 class="text-lg md:text-2xl font-semibold  text-gray-800 mb-6 fade-in">
            Choose Your Security Solution
        </h1>
        <p class="text-sm md:text-md text-gray-600 mb-6 fade-in">
            Select the category of products you're interested in:
        </p>
    </div>

    <!-- Product Categories -->
    <div class="flex flex-col lg:flex-row justify-center gap-4 mt-4 fade-in">

        <!-- Kaspersky Card -->
        <div class="bg-white shadow-lg rounded-lg p-6 w-72 transform transition duration-500 hover:scale-105 hover:shadow-2xl hover:cursor-pointer" 
            onclick="window.location.href='{{ route('products.kaspersky') }}'">
            <div class="text-center">
                <img src="{{ asset('assets/img/kaspersky_logo.png') }}" alt="Kaspersky Logo" class="h-24 mx-auto mb-4">
                <h2 class="text-md md:text-xl font-semibold text-gray-800">Kaspersky Products</h2>
                <p class="text-sm md:text-md text-gray-600 mt-2">Explore Kaspersky's powerful security solutions</p>
            </div>
        </div>

        <!-- Bitdefender Card -->
        <div class="bg-white shadow-lg rounded-lg p-6 w-72 transform transition duration-500 hover:scale-105 hover:shadow-2xl hover:cursor-pointer">
            <div class="text-center">
                <img src="{{ asset('assets/img/bitdefender_logo.jpg') }}"
                    alt="Bitdefender Logo" class="h-24 mx-auto mb-4">
                <h2 class="text-md md:text-xl font-semibold text-gray-800">Bitdefender Products</h2>
                <p class="text-sm md:text-md text-gray-600 mt-2">Discover the protection from Bitdefender</p>
            </div>
        </div>

        <!-- All Products Card -->
        <div class="bg-white shadow-lg rounded-lg p-6 w-72 transform transition duration-500 hover:scale-105 hover:shadow-2xl hover:cursor-pointer"
            onclick="showProducts('all')">
            <div class="text-center">
                <img src=""
                    alt="All Products Logo" class="h-24 mx-auto mb-4">
                <h2 class="text-md md:text-xl font-semibold text-gray-800">All Products</h2>
                <p class="text-sm md:text-md text-gray-600 mt-2">Browse all security solutions in one place</p>
            </div>
        </div>
    </div>
</section>
@endsection