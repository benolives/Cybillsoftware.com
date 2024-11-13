@extends('layouts.base')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/home_page.css') }}">
@endpush

@section('content')
<!--=================================== HOME ==============================================-->
<section id="home_image_section" class="relative min-h-[510px] w-full">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
        <picture class="block h-full w-full">
            <source srcset="{{ asset('assets/img/about_us.jpg') }}" media="(min-width: 1440px)">
            <source srcset="{{ asset('assets/img/about_us.jpg') }}" media="(max-width: 640px)">
            <img src="{{ asset('assets/img/about_us.jpg') }}" class="w-full h-full object-cover" alt="hero section background">
        </picture>
    </div>
    <div class="img_overlay absolute top-0 left-0 w-full h-full bg-[rgba(25,27,38,0.7)]"></div>
    <div class="content_section relative w-full flex items-center justify-center flex-col text-center min-h-[510px] px-[32px] text-white">
        <div class="content-wrapper w-full max-w-[840px] flex flex-col items-start">
            <h1 class="mb-2 text-[1.8rem] font-extrabold text-white capitalize text-center w-full">
                Start Reselling & Earning with Cybill Software
            </h1>
            <p class="font-normal text-sm mb-6 text-white">
                With Cybill Software, you can easily start reselling and earn commission with just a few clicks. Our platform is designed to help you maximize your earnings with a user-friendly interface, marketing tools, and comprehensive support.
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
                        placeholder="Search for products, partners, or sales opportunities..." 
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
                
                    <!-- Dropdown menu -->
                    <div id="dropdownMenu" class="text-[rgba(25,27,38,.64)] bg-white absolute top-[calc(100%+4px)] right-0 min-w-[216px] rounded-lg mt-1 hidden border shadow-lg z-[90]">
                        <div class="flex flex-col p-3">
                            <div class="dropdown-item flex items-center px-4 py-2 cursor-pointer">
                                <span class="icon-image mr-2"></span>
                                <label>All Products</label>
                            </div>
                            <div class="dropdown-item flex items-center px-4 py-2 border-t cursor-pointer">
                                <span class="icon-photo mr-2"></span>
                                <label>Antivirus Solutions</label>
                            </div>
                            <div class="dropdown-item flex items-center px-4 py-2 border-t cursor-pointer">
                                <span class="icon-illustration mr-2"></span>
                                <label>Security Products</label>
                            </div>
                            <div class="dropdown-item flex items-center px-4 py-2 border-t cursor-pointer">
                                <span class="icon-partner mr-2"></span>
                                <label>Partner Sales</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10 flex items-center gap-x-6 justify-between w-full">
                @if (auth()->check())
                    <!-- User is logged in -->
                    <button class="md:block bg-[#fc4b3b] rounded-md px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#fc4b3b]/90 focus-visible:outline">
                        <a href="{{ route('about-us') }}" class="no-underline">
                            <span class="text-sm leading-6">
                                Learn more about us
                                <img src="{{ asset('assets/img/arrow-right.svg') }}" alt="Arrow Right" class="inline-block h-4 w-4" />
                            </span>
                        </a>
                    </button>
                @else
                    <!-- User is not logged in -->
                    <button class="rounded-md bg-[#2c2c64] px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#2c2c64]/90 focus-visible:outline focus-visible:outline-2">
                        <a href="{{ route('register') }}" class="no-underline">Become a partner</a>
                    </button>

                    <!-- Sign In button on mobile screens -->
                    <button class="block md:hidden bg-[#fc4b3b] rounded-md px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#fc4b3b]/90 focus-visible:outline">
                        <a href="{{ route('login') }}" class="no-underline">
                            <span class="leading-6">Sign In</span>
                        </a>
                    </button>
                @endif
            </div>           
        </div>
        <div class="learnMoreAboutUsContainer absolute left-8 bottom-6">
                <a href="{{ route('about-us') }}" class="flex items-center gap-2 text-sm text-white">
                    <span>Learn more about Us</span>
                    <span class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                        </svg>
                    </span>
                </a>
        </div>
        <!-- <div id="showHomeModal" class="relative w-[265px] flex items-center gap-x-4 p-4 text-md uppercase leading-6 text-white cursor-pointer">
            <svg class="absolute top-0 left-0 w-full h-full fill-transparent">
                <rect width="100%" height="100%" rx="10" ry="10"></rect>
            </svg>
            <span class="font-semibold">System Security</span>
            <span class="flex items-center">
                Home
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right ml-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </span>
        </div> -->
    </div>
</section>
<!--======================= Why Cybill Software Section ===================================-->
<section class="py-16 bg-gradient-to-r from-[#394b62] to-[#5e6f83]">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-semibold text-white mb-4 opacity-0 animate__animated animate__fadeIn animate__delay-1s">
                Why Choose <span class="text-[#fc4b3b]">Us</span>
            </h2>
            <p class="text-lg text-white opacity-0 animate__animated animate__fadeIn animate__delay-2s max-w-3xl mx-auto">
                We provide seamless, fast, and secure software solutions delivered digitally. No physical delivery, no hassle.
            </p>
        </div>

        <!-- Grid of Reasons -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="reason-card bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition-all duration-300 opacity-0 animate__animated animate__fadeIn animate__delay-3s">
                <div class="icon bg-[#fc4b3b] text-white p-4 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 3a1 1 0 011-1h10a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#394b62] mb-2">Fast Access</h3>
                <p class="text-[#747078]">Instant access to software downloads and activation codes for a quick start.</p>
            </div>

            <div class="reason-card bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition-all duration-300 opacity-0 animate__animated animate__fadeIn animate__delay-4s">
                <div class="icon bg-[#fc4b3b] text-white p-4 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 3a1 1 0 011-1h10a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#394b62] mb-2">No Physical Delivery</h3>
                <p class="text-[#747078]">All purchases are sent digitally—no waiting for shipping.</p>
            </div>

            <div class="reason-card bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition-all duration-300 opacity-0 animate__animated animate__fadeIn animate__delay-5s">
                <div class="icon bg-[#fc4b3b] text-white p-4 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16 3a1 1 0 00-1 1v12a1 1 0 001 1h2a1 1 0 001-1V4a1 1 0 00-1-1h-2zm-6 0a1 1 0 00-1 1v12a1 1 0 001 1h2a1 1 0 001-1V4a1 1 0 00-1-1h-2z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#394b62] mb-2">Secure Transactions</h3>
                <p class="text-[#747078]">Your transactions are always secure, with top-notch encryption protocols.</p>
            </div>

            <div class="reason-card bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition-all duration-300 opacity-0 animate__animated animate__fadeIn animate__delay-6s">
                <div class="icon bg-[#fc4b3b] text-white p-4 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 5a1 1 0 011-1h10a1 1 0 011 1v10a1 1 0 01-1 1H5a1 1 0 01-1-1V5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#394b62] mb-2">Customer Support</h3>
                <p class="text-[#747078]">Reliable support whenever you need help with any issues.</p>
            </div>

            <div class="reason-card bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition-all duration-300 opacity-0 animate__animated animate__fadeIn animate__delay-7s">
                <div class="icon bg-[#fc4b3b] text-white p-4 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5.25a.75.75 0 01.75.75v8.875a.75.75 0 01-1.5 0V6a.75.75 0 01.75-.75zM5 10a.75.75 0 01.75-.75h8.5a.75.75 0 010 1.5h-8.5a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#394b62] mb-2">Wide Selection</h3>
                <p class="text-[#747078]">Choose from a wide range of software that fits your needs.</p>
            </div>

            <div class="reason-card bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition-all duration-300 opacity-0 animate__animated animate__fadeIn animate__delay-8s">
                <div class="icon bg-[#fc4b3b] text-white p-4 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9a1 1 0 01.75-.75h8.5a1 1 0 010 1.5h-8.5A1 1 0 015 9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#394b62] mb-2">Affordable Pricing</h3>
                <p class="text-[#747078]">Enjoy competitive prices without compromising on quality.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-2xl font-semibold text-[#394b62] mb-6">What Our Users Say</h2>
        <div class="flex justify-center gap-6">
            <div class="w-[300px] p-6 bg-white shadow-lg rounded-lg">
                <p class="text-gray-600 mb-4">"Cybill Software helped me grow my business quickly and easily. The platform is simple to use, and the support team is top-notch!"</p>
                <p class="font-semibold">John Doe</p>
                <span class="text-sm text-gray-500">Reseller</span>
            </div>
            <div class="w-[300px] p-6 bg-white shadow-lg rounded-lg">
                <p class="text-gray-600 mb-4">"The marketing tools provided by Cybill Software allowed me to focus more on sales. I’ve seen a significant increase in commissions."</p>
                <p class="font-semibold">Jane Smith</p>
                <span class="text-sm text-gray-500">Partner</span>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold text-[#394b62]">Latest Insights</h2>
            <p class="text-base text-[#747078]">Stay up-to-date with the latest trends and tips for resellers in the software industry.</p>
        </div>
        <div class="flex flex-wrap justify-center gap-6">
            <div class="w-[300px] p-6 bg-white shadow-lg rounded-lg">
                <h3 class="font-semibold text-[#fc4b3b]">How to Maximize Your Reseller Earnings</h3>
                <p class="text-gray-600 mt-2">Learn the best practices to maximize your earnings and grow your business with Cybill Software.</p>
                <a href="#" class="text-[#fc4b3b] mt-4 block">Read More</a>
            </div>
            <div class="w-[300px] p-6 bg-white shadow-lg rounded-lg">
                <h3 class="font-semibold text-[#fc4b3b]">Understanding the Power of Partner Sales</h3>
                <p class="text-gray-600 mt-2">Discover the benefits of becoming a partner and selling high-demand software products.</p>
                <a href="#" class="text-[#fc4b3b] mt-4 block">Read More</a>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold text-[#394b62] mb-6">How It Works</h2>
        <p class="text-base text-[#747078] mb-8">Get started with Cybill Software in just a few simple steps!</p>
        <div class="flex justify-center gap-12">
            <div class="w-[250px]">
                <h3 class="font-semibold text-[#fc4b3b]">Step 1: Sign Up</h3>
                <p class="text-gray-600 mt-2">Create your account and gain access to our reseller platform.</p>
            </div>
            <div class="w-[250px]">
                <h3 class="font-semibold text-[#fc4b3b]">Step 2: Choose Products</h3>
                <p class="text-gray-600 mt-2">Select from a range of software products to resell and earn commissions.</p>
            </div>
            <div class="w-[250px]">
                <h3 class="font-semibold text-[#fc4b3b]">Step 3: Start Selling</h3>
                <p class="text-gray-600 mt-2">Use our marketing tools to start selling and earning right away!</p>
            </div>
        </div>
    </div>
</section>

<!-- Floating Tutorial Button with Animation -->
<div class="fixed bottom-8 right-8 z-50 flex flex-col items-center">
    <a href="#tutorialVideo" class="tutorial-button bg-[#fc4b3b] text-white rounded-full p-4 shadow-lg flex items-center justify-center hover:bg-[#fc4b3b]/80 transform transition-all duration-300 ease-in-out scale-110">
        <!-- Play Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
            <path d="M11.742 7.742a1 1 0 0 0 0-1.414L6.586 2.343a1 1 0 0 0-1.414 1.414L9.5 7.5 5.172 11.829a1 1 0 0 0 1.414 1.414l5.172-5.172a1 1 0 0 0 0-1.414z"/>
        </svg>
        <!-- Text Underneath (optional) -->
        <span class="text-xs mt-2 font-semibold text-white">Watch Tutorial</span>
    </a>
</div>

<!-- Tutorial Video Section (Anchored) -->
<section id="tutorialVideo" class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold text-[#394b62] mb-6">How to Get Started with Cybill Software</h2>
        <p class="text-base text-[#747078] mb-8">Watch this quick tutorial to learn how to start reselling and earning with Cybill Software.</p>
        <div class="w-full max-w-[640px] mx-auto">
            <iframe class="w-full h-[360px]" src="https://www.youtube.com/embed/example_video_id" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</section>

<!-- Styling for the Floating Button -->
<style>
    /* Floating Button Animation */
    .tutorial-button {
        position: fixed;
        bottom: 8%;
        right: 8%;
        z-index: 100;
        animation: bounce 1.5s ease-in-out infinite;
    }

    /* Bouncing Animation */
    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    /* Optional Hover Effect */
    .tutorial-button:hover {
        transform: scale(1.2);
    }
</style>

<!-- FAQ Section -->
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold text-[#394b62] mb-6">Frequently Asked Questions</h2>
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg p-6 mb-4">
                <h3 class="font-semibold text-[#fc4b3b]">How do I become a reseller?</h3>
                <p class="text-gray-600 mt-2">Simply sign up on our platform, and you'll get access to all the tools and resources you need to start reselling.</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 mb-4">
                <h3 class="font-semibold text-[#fc4b3b]">What commission can I expect?</h3>
                <p class="text-gray-600 mt-2">We offer competitive commissions depending on the products you sell. You'll receive detailed reports on your earnings in your dashboard.</p>
            </div>
        </div>
    </div>
</section>

<!-- feature top products -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold text-[#394b62] mb-6">Featured Products</h2>
        <p class="text-base text-[#747078] mb-8">Explore our most popular products that you can start reselling right now.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="p-6 bg-gray-100 rounded-lg shadow-md">
                <img src="{{ asset('assets/img/product1.jpg') }}" alt="Product 1" class="w-full h-[180px] object-cover rounded-md mb-4">
                <h3 class="font-semibold text-[#fc4b3b]">Product 1</h3>
                <p class="text-gray-600 mt-2">Description of the product that you can sell and earn from. High demand and great commissions.</p>
                <a href="#" class="text-[#fc4b3b] mt-4 block">Learn More</a>
            </div>
            <div class="p-6 bg-gray-100 rounded-lg shadow-md">
                <img src="{{ asset('assets/img/product2.jpg') }}" alt="Product 2" class="w-full h-[180px] object-cover rounded-md mb-4">
                <h3 class="font-semibold text-[#fc4b3b]">Product 2</h3>
                <p class="text-gray-600 mt-2">Description of the product that you can sell and earn from. High demand and great commissions.</p>
                <a href="#" class="text-[#fc4b3b] mt-4 block">Learn More</a>
            </div>
            <div class="p-6 bg-gray-100 rounded-lg shadow-md">
                <img src="{{ asset('assets/img/product3.jpg') }}" alt="Product 3" class="w-full h-[180px] object-cover rounded-md mb-4">
                <h3 class="font-semibold text-[#fc4b3b]">Product 3</h3>
                <p class="text-gray-600 mt-2">Description of the product that you can sell and earn from. High demand and great commissions.</p>
                <a href="#" class="text-[#fc4b3b] mt-4 block">Learn More</a>
            </div>
        </div>
    </div>
</section>

<!-- Becoming a cybill software patrner -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold text-[#394b62] mb-6">Become a Cybill Software Partner</h2>
        <p class="text-base text-[#747078] mb-8">Our partner program is designed to reward those who help us grow by reselling our products.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            <div class="p-6 bg-white shadow-md rounded-lg">
                <h3 class="text-[#fc4b3b] font-semibold">Earn High Commissions</h3>
                <p class="text-gray-600 mt-2">Earn competitive commissions on every sale you make. The more you sell, the more you earn!</p>
            </div>
            <div class="p-6 bg-white shadow-md rounded-lg">
                <h3 class="text-[#fc4b3b] font-semibold">Marketing Tools</h3>
                <p class="text-gray-600 mt-2">Get access to a suite of marketing materials to help you sell our products more effectively.</p>
            </div>
            <div class="p-6 bg-white shadow-md rounded-lg">
                <h3 class="text-[#fc4b3b] font-semibold">Dedicated Support</h3>
                <p class="text-gray-600 mt-2">Our dedicated partner support team is always available to help you with any questions or challenges.</p>
            </div>
        </div>
        <a href="{{ route('register') }}" class="mt-8 inline-block bg-[#fc4b3b] text-white font-semibold py-2 px-6 rounded-full">Join Now</a>
    </div>
</section>

<!-- success stories -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold text-[#394b62] mb-6">Success Stories</h2>
        <p class="text-base text-[#747078] mb-8">Learn how Cybill Software has helped resellers grow their business and increase their earnings.</p>
        <div class="flex justify-center gap-6">
            <div class="w-[300px] p-6 bg-gray-100 rounded-lg shadow-md">
                <img src="{{ asset('assets/img/success1.jpg') }}" alt="Success Story 1" class="w-full h-[180px] object-cover rounded-md mb-4">
                <h3 class="font-semibold text-[#fc4b3b]">John's Journey</h3>
                <p class="text-gray-600 mt-2">John started reselling Cybill Software products last year and saw his sales increase by 50% in just 6 months.</p>
                <a href="#" class="text-[#fc4b3b] mt-4 block">Read Full Story</a>
            </div>
            <div class="w-[300px] p-6 bg-gray-100 rounded-lg shadow-md">
                <img src="{{ asset('assets/img/success2.jpg') }}" alt="Success Story 2" class="w-full h-[180px] object-cover rounded-md mb-4">
                <h3 class="font-semibold text-[#fc4b3b]">Jane's Growth</h3>
                <p class="text-gray-600 mt-2">After becoming a partner, Jane doubled her commissions within the first three months, thanks to our marketing resources.</p>
                <a href="#" class="text-[#fc4b3b] mt-4 block">Read Full Story</a>
            </div>
        </div>
    </div>
</section>

<!-- Newletter section -->
<section class="bg-[#2c2c64] py-16">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold text-white mb-6">Stay Informed with Our Newsletter</h2>
        <p class="text-base text-white mb-8">Sign up to receive the latest news, updates, and exclusive offers straight to your inbox.</p>
        <form action="#" method="POST" class="flex justify-center">
            <input type="email" name="email" class="p-3 w-[300px] rounded-l-lg text-gray-800" placeholder="Enter your email" required>
            <button type="submit" class="bg-[#fc4b3b] px-6 py-3 text-white rounded-r-lg">Subscribe</button>
        </form>
    </div>
</section>



<!-------------------Modal to show when we click "Security system or home button on the page" ------------->
<div id="info-modal" class="hidden fixed inset-0 z-50 items-center bg-black bg-opacity-70 justify-center">
    <div id="modal-content" class="bg-white rounded-lg shadow-lg w-11/12 max-w-lg sm:max-w-xl m-5 custom-translate-y transition-transform duration-500 ease-in-out">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-[#2c2c64]">Become a Partner with us</h2>
            <p class="mt-4 text-gray-600 leading-relaxed">
                <span class="mr-2 text-[#2c2c64] font-semibold">💼</span>
                Join our network of partners and earn commissions by selling top-tier security software from trusted brands like 
                <span class="text-[#2c2c64] font-semibold">Kaspersky</span> and <span class="text-[#2c2c64] font-semibold">Bitdefender.</span> 
                With our competitive pricing and monthly subscription options, you can provide flexible solutions that meet your customers' needs.
            </p>
            <p class="mt-4 text-[#fc4b3b] underline font-semibold text-lg">
                As a partner, you'll receive:
            </p>
            <ul class="mt-2 text-gray-700 list-none space-y-2">
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-check2-circle" viewBox="0 0 16 16">
                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                    </svg>
                    <span>Access to exclusive products and pricing.</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-check2-circle" viewBox="0 0 16 16">
                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                    </svg>
                    <span>Marketing support and sales resources.</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-check2-circle" viewBox="0 0 16 16">
                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                    </svg>
                    <span>Regular training and updates on our software offerings.</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-check2-circle" viewBox="0 0 16 16">
                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                    </svg>
                    <span>Attractive commission rates for each sale made.</span>
                </li>
            </ul>
            <p class="mt-4 text-gray-700 leading-relaxed">
                Whether your customers need antivirus solutions for home or business, 
                you can provide them with the <span class="font-semibold text-[#fc4b3b]">best security software</span> on the market while earning income for your efforts. 
                <span class="font-semibold text-[#fc4b3b]">Join us today and start selling!</span>
            </p>
            <div class="mt-6 flex justify-end">
                <button id="modal-close" class="bg-[#fc4b3b] text-white rounded-md px-4 py-2 hover:bg-[#fc4b3b]/90">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endsection