@extends('layouts.auth_base')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <!-- Main container with some padding -->
        <div class="max-w-4xl w-full p-6">
            <!-- Title/Heading: Choose a Product to Sell -->
            <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Choose a Product to Sell</h2>

            <!-- Container for the two product selection cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <!-- Bitdefender Button -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center cursor-pointer hover:scale-105 transform transition duration-300">
                    <img src="{{ asset('assets/img/bitdefender.png') }}" alt="Bitdefender" class="mx-auto max-h-32 object-contain mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Bitdefender</h3>
                </div>

                <!-- Kaspersky Button -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center cursor-pointer hover:scale-105 transform transition duration-300"
                    onclick="window.location.href='{{ route('products.kaspersky') }}'">
                    <img src="{{ asset('assets/img/kaspersky_logo.png') }}" alt="Kaspersky" class="mx-auto max-h-32 object-contain mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Kaspersky</h3>
                </div>
            </div>

            <!-- View All Products Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('products.index') }}" 
                    class="inline-block bg-[#fc4b3b] text-white py-3 px-6 rounded-md hover:bg-[#fc4b3b]/90 focus:outline-none focus:ring-2 focus:ring-[#fc4b3b] focus:ring-opacity-50 transition duration-300">
                    View All Products
                </a>
            </div>
        </div>
    </div>
@endsection