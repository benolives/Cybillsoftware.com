@extends('layouts.auth_base')

@section('header')
<!-- Header -->
<header class="hidden md:block fixed top-0 left-0 w-full z-50">
    <div class="container mx-auto flex justify-start py-6">
        <!-- Logo and Company Name in a container -->
        <div class="bg-white shadow-lg rounded-lg py-4 px-6 flex items-center space-x-2">
            <a href="/" class="flex items-center space-x-2">
                <img src="{{ asset('assets/img/cybillogo.png')}}" alt="Cybill Logo" class="h-10 w-auto">
                <span class="text-xl font-semibold text-[#2c2c64]">Cybill Software</span>
            </a>
        </div>
    </div>
</header>
@endsection

@section('content')
<!-- Main Section for the login Content -->
<main id="login-page" class="flex items-center justify-center min-h-screen py-4 px-4 md:pt-6">
    <section class="bg-white py-8 lg:py-4 px-6 max-w-md w-full rounded-lg shadow-lg">
        <div class="text-center mb-6">
            <!-- Sign in heading -->
            <h2 class="text-3xl font-bold text-[#2c2c64]">Sign In</h2>
        </div>

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="post" class="space-y-4">
            @csrf
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
                    type="button" 
                    id="toggle-password-button" 
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
            
            <!-- Login Button -->
            <div>
                <button type="submit" class="w-full bg-[#fc4b3b] text-white py-3 rounded-lg font-semibold hover:bg-[#fc4b3b]/80">
                    Sign In
                </button>
            </div>
        </form>

        <!-- Options for users without an account -->
        <div class="text-center mt-4">
            <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="text-[#fc4b3b] font-semibold">Register</a></p>
        </div>
    </section>
</main>
@endsection