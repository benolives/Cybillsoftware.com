@extends('layouts.base')

@section('content')
<!-- Shopping Cart Page -->
<div class="pt-24 md:pt-32 bg-teal-400">
    <section id="receipt_page_hero" class="container mx-auto py-10 p-6">
        <!-- Title you have made an excellent choice-->
        <div class="mb-8">
            <h1 class="text-center text-2xl md:text-4xl font-bold text-gray-900">You've made an excellent choice!</h1>
        </div>
        <!-- Product Details Section -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center md:text-left">
                <!-- Product description-->
                <div class="flex items-center space-x-4 py-4">
                    <img 
                        src="{{ asset($product->category_id == 2 ? 'assets/img/bitdefender.png' : 'assets/img/kaspersky_logo.png') }}" 
                        alt="{{ $product->name }} Logo" 
                        class="h-12 w-auto"
                    >
                    <div class="flex flex-col">
                        <h3 class="text-lg font-semibold">{{ $product->product_name }}</h3>
                        <p class="text-sm text-gray-600">{{ $product->description }}</p>
                    </div>
                </div>
            </div>
            <!-- Subscription Info and Total Price -->
            <div class="flex flex-col md:flex-row justify-between mt-8">
                <div class="md:w-2/3 md:pr-4">
                    <p class="text-sm text-black">
                        <span class="font-semibold">How subscription works:</span>
                        <span class="text-gray-600">
                            Your subscription starts the day of purchase and will automatically renew each term so your 
                            protection is uninterrupted. We will email you a reminder about the upcoming charge, 
                            and you will be charged at the undiscounted price (subject to change) before the 
                            next subscription term begins. You can cancel anytime. 
                            <a href="#" class="text-blue-600 underline">Read more</a>
                        </span>
                    </p>
                </div>
                <!-- price section -->
                <div class="text-center mt-4 md:mt-0 md:w-1/4">
                    <div class="bg-red-600 text-white p-4 rounded-lg shadow-md">
                        <p class="text-xl font-bold">Total</p>
                        <p class="text-3xl font-extrabold mt-2">KSH {{ number_format($product->price_partner) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Billing and Payment Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <!-- Billing Information -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h2 class="text-xl font-semibold mb-6">Enter Your Customers Details</h2>
                <form id="paymentForm" class="flex flex-col gap-3" method="POST" action="{{ route('initiateStkPush', $product->product_api_id) }}">
                    @csrf
                    <input 
                        type="text" 
                        name="fullname" 
                        placeholder="Full Name" 
                        class="w-full p-3 border border-gray-300 rounded-lg" 
                        required 
                    />
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        class="w-full p-3 border border-gray-300 rounded-lg"
                        required
                    />
                    <div class="flex items-center w-full border rounded-lg overflow-hidden">
                        <input 
                            type="text" 
                            id="country_code" 
                            class="w-20 px-3 py-3 border-none bg-gray-200 text-gray-900" 
                            value=" +254" 
                            readonly 
                        >
                        <input 
                            type="tel"  
                            name="phoneNumber" 
                            class="flex-1 px-3 py-3 border-none focus:outline-none focus:ring-2 focus:ring-[#fc4b3b]" 
                            placeholder="7..." 
                            required
                        >
                    </div>
                    <input 
                        type="text" 
                        name="country" 
                        placeholder="Country of Residence" 
                        class="w-full p-3 border border-gray-300 rounded-lg" 
                        required 
                    />
                    <input 
                        type="text" 
                        name="city" 
                        placeholder="Town or City" 
                        class="w-full p-3 border border-gray-300 rounded-lg" 
                        required 
                    />
                    <input 
                        type="text" 
                        name="address" 
                        placeholder="Address e.g CBD, Moi avenue" 
                        class="w-full p-3 border border-gray-300 rounded-lg" 
                        required 
                    />
                    <input 
                        type="text" 
                        name="productPrice" 
                        value="{{ $product->price_partner}}" 
                        class="w-full p-3 border border-gray-300 rounded-lg" 
                        readonly 
                    />
                </form>
            </div>
            <!-- Payment Section -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h2 class="text-xl font-semibold mb-4">Payment Method</h2>
                <div class="flex flex-col justify-between w-full">
                    <div>
                        <!-- Checkbox for Subscription & Auto-Renewal Conditions -->
                        <div class="flex items-start mb-4">
                            <input type="checkbox" id="subscriptionCheckbox" class="w-4 h-4 text-red-600 focus:ring-red-500 border-gray-300 rounded" required>
                            <label class="ml-2 text-sm text-gray-600">
                                I accept the <a href="#" class="text-blue-600 underline">Subscription & Auto-Renewal Conditions</a>, <a href="#" class="text-blue-600 underline">Terms & Conditions</a>, and <a href="#" class="text-blue-600 underline">Privacy Policy</a> of official reseller Cybill.
                            </label>
                        </div>
                        <!-- Checkbox for My Kaspersky account creation -->
                        <div class="flex items-start mb-4">
                            <input type="checkbox" id="dataCheckbox" class="w-4 h-4 text-red-600 focus:ring-red-500 border-gray-300 rounded" required>
                            <label class="ml-2 text-sm text-gray-600">
                                I understand and agree that my data will be stored as described in the <a href="#" class="text-blue-600 underline">Privacy Policy</a>.
                            </label>
                        </div>
                    </div>
                    <!-- Payment Button -->
                    <div class="mt-4">
                        <button type="button" id="payButton" class="w-full bg-red-600 text-white font-semibold py-3 px-8 rounded-lg text-lg hover:bg-red-700 transition-colors">
                            Pay with MPESA
                        </button>
                    </div>
                    <!-- Error Message (Hidden by default) -->                        
                    <div id="errorMessage" class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded-lg mt-4 hidden">
                        <strong class="font-semibold">Warning!</strong>
                        <p>Please accept both the Subscription & Auto-Renewal Conditions and Account creation terms to proceed with payment.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- STK Push Modal to show if the initiate is successful or not -->
    <div id="stkPushModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-80">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md mx-4">
            <div id="stkPushModalContent" class="flex flex-col items-center">
                <div id="stkPushModalIcon" class="mb-4"></div>
                <p id="stkPushModalMessage" class="text-md text-center"></p>
            </div>
            <div class="flex justify-end mt-4">
                <button id="closeStkPushModal" class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg">Close</button>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-80">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md mx-4">
            <h2 class="text-xl font-semibold mb-4">Confirm Payment</h2>
            <p>Are you sure you want to pay <strong>KSH {{ number_format($product->price_partner) }}</strong> for <strong>{{ $product->product_name }}</strong>?</p>
            <div class="flex flex-col sm:flex-row justify-end mt-4">
                <button id="cancelButton" class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg mb-2 sm:mb-0 sm:mr-2">Cancel</button>
                <button id="confirmButton" class="bg-red-600 text-white font-semibold py-2 px-4 rounded-lg">Sure, Pay</button>
            </div>
        </div>
    </div>

    <!-- Custom Error Alert Modal instead of using the alert Modal of javascript-->
    <div id="customAlert" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
        <div class="bg-white rounded-lg p-6 max-w-sm mx-auto">
            <div class="flex items-center gap-2 text-[#fc4b3b]">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
                    <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                </svg>
                <p class="text-red-600 text-lg font-medium">Please fill in all required fields.</p>
            </div>
            <div class="mt-4 float-right">
                <button id="closeAlertBtn" class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700">Close</button>
            </div>
        </div>
    </div>

</div>
@endsection