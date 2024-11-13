@extends('layouts.auth_base')

@section('header')
<!-- Header -->
<header class="hidden md:block fixed top-0 left-0 w-full z-40">
    <div class="container mx-auto flex justify-start py-6">
        <!-- Logo and Company Name in a container -->
        <div class="bg-white shadow-lg rounded-lg py-4 px-6 flex items-center space-x-2">
            <img src="{{ asset('assets/img/cybillogo.png')}}" alt="Cybill Logo" class="h-10 w-auto">
            <span class="text-xl font-semibold text-[#2c2c64]">Cybill Software</span>
        </div>
    </div>
</header>
@endsection

@section('content')
<!-- Main Section for the registration Content -->
<main id="register-page" class="relative z-50 flex items-center justify-center min-h-screen py-4 px-4 md:pt-6">
    <section class="bg-white py-8 lg:py-4 px-6 max-w-md w-full rounded-lg shadow-lg">
        <div class="text-center mb-6">
            <!-- Become a Partner Heading -->
            <h2 class="text-3xl font-bold text-[#2c2c64]">Become a Partner</h2>
            <!-- Option for users who already have an account -->
            <div class="text-start mt-4">
                <p class="text-gray-600">
                    Already a partner? 
                    <a href="{{ route('login') }}" class="text-[#fc4b3b] font-semibold cursor-pointer">
                        Sign In
                    </a>
                </p>
            </div>
        </div>

        <!-- Registration Form -->
        <form action="{{ route('register') }}" method="post" class="space-y-4">
            @csrf
            <!-- Name -->
            <div>
                <label for="name" class="block text-gray-700">Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#fc4b3b] @error('name') border-red-500 @enderror" 
                    placeholder="Your Name" 
                    required 
                    value="{{ old('name') }}"
                >
                @error('name')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#fc4b3b] @error('email') border-red-500 @enderror" 
                    placeholder="Email Address" 
                    required
                    value="{{ old('email') }}"
                >
                @error('email')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Name of company -->
            <div>
                <label for="name_of_company" class="block text-gray-700">Name of Company</label>
                <input 
                    type="text" 
                    id="name_of_company" 
                    name="name_of_company" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#fc4b3b] @error('name_of_company') border-red-500 @enderror" 
                    placeholder="Name of company" 
                    required
                    value="{{ old('name_of_company') }}"
                >
                @error('name_of_company')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone" class="block text-gray-700 mr-2">Phone Number</label>
                <div class="flex items-center">
                    <div class="flex items-center w-full border rounded-lg overflow-hidden">
                        <input 
                            type="text" 
                            id="country_code" 
                            class="w-20 px-2 py-2 border-none bg-gray-200 text-gray-900" 
                            value=" +254" 
                            readonly 
                        >
                        <input 
                            type="text" 
                            id="phone" 
                            name="phone" 
                            class="flex-1 px-4 py-2 border-none focus:outline-none focus:ring-2 focus:ring-[#fc4b3b] @error('phone') border-red-500 @enderror" 
                            placeholder="7..." 
                            required
                        >
                    </div>
                </div>
                @error('phone')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
            
            <!-- Password with Show and Hide Option -->
            <div class="relative">
                <label for="password" class="block text-gray-700">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#fc4b3b] @error('password') border-red-500 @enderror" 
                    placeholder="Password" 
                    required
                >
                <button 
                    id="passwordButton"
                    type="button" 
                    class="absolute inset-y-0 right-4 top-6 focus:outline-none"
                    aria-label="Toggle password visibility"
                >
                    <svg id="eye-open" width="18px" height="18px" viewBox="0 0 24 24" stroke="#000000" class="hidden">
                        <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M1 12C1 12 5 20 12 20C19 20 23 12 23 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg id="eye-closed" width="18px" height="18px" viewBox="0 0 24 24" stroke="#000000">
                        <path d="M2 2L22 22" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.71277 6.7226C3.66479 8.79527 2 12 2 12C2 12 5.63636 19 12 19C14.0503 19 15.8174 18.2734 17.2711 17.2884M11 5.05822C11.3254 5.02013 11.6588 5 12 5C18.3636 5 22 12 22 12C22 12 21.3082 13.3317 20 14.8335" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 14.2362C13.4692 14.7112 12.7684 15.0001 12 15.0001C10.3431 15.0001 9 13.657 9 12.0001C9 11.1764 9.33193 10.4303 9.86932 9.88818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                @error('password')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password with show and hide options-->
            <div class="relative">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#fc4b3b]" 
                    placeholder="Confirm Password" 
                    required
                >
                <button 
                    id="password_confirmation_button"
                    type="button" 
                    class="absolute inset-y-0 right-4 top-6 focus:outline-none" 
                    aria-label="Toggle password visibility"
                >
                    <svg id="eye-open-confirm" width="18px" height="18px" viewBox="0 0 24 24" stroke="#000000" class="hidden">
                        <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M1 12C1 12 5 20 12 20C19 20 23 12 23 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg id="eye-closed-confirm" width="18px" height="18px" viewBox="0 0 24 24" stroke="#000000">
                        <path d="M2 2L22 22" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.71277 6.7226C3.66479 8.79527 2 12 2 12C2 12 5.63636 19 12 19C14.0503 19 15.8174 18.2734 17.2711 17.2884M11 5.05822C11.3254 5.02013 11.6588 5 12 5C18.3636 5 22 12 22 12C22 12 21.3082 13.3317 20 14.8335" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 14.2362C13.4692 14.7112 12.7684 15.0001 12 15.0001C10.3431 15.0001 9 13.657 9 12.0001C9 11.1764 9.33193 10.4303 9.86932 9.88818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <!-- Register Button -->
            <div>
                <button type="submit" class="w-full bg-[#fc4b3b] text-white py-3 rounded-lg font-semibold hover:bg-[#fc4b3b]/80">
                    Become a Partner
                </button>
            </div>

            <!-- Terms and Privacy Policy -->
            <div class="text-center text-gray-700 text-sm mt-4">
                By becoming a partner, you are accepting our <a href="/terms" class="text-[#fc4b3b] hover:underline">terms and services</a> and <a href="/privacy" class="text-[#fc4b3b] hover:underline">privacy policy</a>.
            </div>
        </form>
    </section>
</main>
@endsection