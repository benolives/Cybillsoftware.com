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
<section class="py-16 bg-[#2c2c64]">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-semibold text-white mb-4 animate__animated animate__bounce">
                Why Choose <span class="text-[#fc4b3b]">Us</span>
            </h2>
            <p class="text-lg text-white opacity-0 animate__animated animate__fadeIn animate__delay-2s max-w-3xl mx-auto">
                We provide seamless, fast, and secure software solutions delivered digitally. No physical delivery, no hassle.
            </p>
        </div>

        <!-- Grid of Reasons -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="reason-card bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition-all duration-300 opacity-0 animate__animated animate__fadeIn animate__delay-1s">
                <div class="flex gap-2 items-center">
                    <div class="icon bg-[green] text-white p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m422-232 207-248H469l29-227-185 267h139l-30 208ZM320-80l40-280H160l360-520h80l-40 320h240L400-80h-80Zm151-390Z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[#394b62] mb-2">Fast Access</h3>
                </div>
                <p class="text-[#747078]">Instant access to software downloads and activation codes for a quick start.</p>
            </div>
            <div class="reason-card bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition-all duration-300 opacity-0 animate__animated animate__fadeIn animate__delay-2s">
                <div class="flex gap-2 items-center">
                    <div class="icon bg-[green] text-white p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M240-80q-50 0-85-35t-35-85v-120h120v-560l60 60 60-60 60 60 60-60 60 60 60-60 60 60 60-60 60 60 60-60v680q0 50-35 85t-85 35H240Zm480-80q17 0 28.5-11.5T760-200v-560H320v440h360v120q0 17 11.5 28.5T720-160ZM360-600v-80h240v80H360Zm0 120v-80h240v80H360Zm320-120q-17 0-28.5-11.5T640-640q0-17 11.5-28.5T680-680q17 0 28.5 11.5T720-640q0 17-11.5 28.5T680-600Zm0 120q-17 0-28.5-11.5T640-520q0-17 11.5-28.5T680-560q17 0 28.5 11.5T720-520q0 17-11.5 28.5T680-480ZM240-160h360v-80H200v40q0 17 11.5 28.5T240-160Zm-40 0v-80 80Z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[#394b62] mb-2">Secure Transactions</h3>
                </div>
                <p class="text-[#747078]">Your transactions are always secure, with top-notch encryption protocols.</p>
            </div>

            <div class="reason-card bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition-all duration-300 opacity-0 animate__animated animate__fadeIn animate__delay-2s">
                <div class="flex gap-2 items-center">
                    <div class="icon bg-[green] text-white p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M440-120v-80h320v-284q0-117-81.5-198.5T480-764q-117 0-198.5 81.5T200-484v244h-40q-33 0-56.5-23.5T80-320v-80q0-21 10.5-39.5T120-469l3-53q8-68 39.5-126t79-101q47.5-43 109-67T480-840q68 0 129 24t109 66.5Q766-707 797-649t40 126l3 52q19 9 29.5 27t10.5 38v92q0 20-10.5 38T840-249v49q0 33-23.5 56.5T760-120H440Zm-80-280q-17 0-28.5-11.5T320-440q0-17 11.5-28.5T360-480q17 0 28.5 11.5T400-440q0 17-11.5 28.5T360-400Zm240 0q-17 0-28.5-11.5T560-440q0-17 11.5-28.5T600-480q17 0 28.5 11.5T640-440q0 17-11.5 28.5T600-400Zm-359-62q-7-106 64-182t177-76q89 0 156.5 56.5T720-519q-91-1-167.5-49T435-698q-16 80-67.5 142.5T241-462Z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[#394b62] mb-2">Customer Support</h3>
                </div>
                <p class="text-[#747078]">Reliable support whenever you need help with any issues.</p>
            </div>
        </div>
    </div>
</section>

<!--================================= Blog Section ==========================================-->
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold text-gray-800">
                Latest 
                <span class="text-[#fc4b3b]">Insights</span>
            </h2>
            <p class="text-center text-gray-600 max-w-3xl mx-auto">Stay up-to-date with the latest trends and tips in the cybersecurity world.</p>
        </div>

        <!-- Blog Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
                <div class="bg-white shadow-lg rounded-lg pb-8">
                    <!-- Image without padding and full width -->
                    <img src="{{ $blog['image'] }}" alt="Blog Image" class="w-full h-48 object-cover rounded-t-lg">
                    
                    <!-- Title in black -->
                    <h3 class="font-semibold text-black mt-4 px-6">{{ $blog['title'] }}</h3>
                    
                    <!-- Excerpt with a max of 3 lines and ellipsis -->
                    <p class="text-gray-600 mt-2 truncate-line-3 px-6">{{ $blog['excerpt'] }}</p>

                    <p class="text-sm text-[#2c2c64] font-semibold mt-3 px-6">By {{ $blog['author'] }} . {{ $blog['date'] }}</p>
                    
                    <!-- Read more link -->
                    <a href="{{ route('blogs.show', $blog['slug']) }}" class="text-[#fc4b3b] mt-4 block px-6">Read More</a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!--============================= How It Works Section =======================================-->
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <div class="mb-[5rem]">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">How <span class="text-[#fc4b3b]">Cybill software</span> Works</h2>
            <p class="text-base text-gray-600">Get started with Cybill Software in just a few simple steps!</p>
        </div>
        <!-- Step-by-Step Cards (Using Grid) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($howItWorksSteps as $step)
                <div class="relative bg-white shadow-lg rounded-lg p-8 text-center transform transition duration-500 ease-in-out hover:scale-105 hover:shadow-2xl mb-8">
                    <!-- Icon Section (Positioned over card) -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 -top-10 w-20 h-20 md:w-24 md:h-24 bg-[green] rounded-full flex justify-center items-center border-4 border-gray-100 shadow-lg">
                        <!-- Output the SVG directly -->
                        {!! $step['svg'] !!}
                    </div>

                    <!-- Title Section -->
                    <h3 class="font-semibold text-xl text-[#394b62] mb-2 mt-16">{{ $step['title'] }}</h3>

                    <!-- Description Section -->
                    <p class="text-gray-600 text-sm mb-4">{{ $step['description'] }}</p>

                    <!-- Learn More Button -->
                    <div>
                        <button class="text-[#fc4b3b] text-sm font-medium" onclick="openModal('modal-{{ $loop->index }}')">Learn more</button>
                    </div>
                </div>

                <!-- Modal for Each Step -->
                <div id="modal-{{ $loop->index }}" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-50 z-50 flex justify-center items-center">
                    <div class="modal-content bg-white rounded-lg shadow-lg p-6 w-3/4 max-w-lg mx-auto">
                        <h3 class="font-semibold text-xl text-[#394b62]">{{ $step['title'] }}</h3>
                        <p class="text-gray-600 mt-2">{{ $step['more_info'] }}</p>
                        <div class="mt-4 text-right">
                            <button class="bg-[#fc4b3b] text-white px-4 py-2 rounded-lg" onclick="closeModal('modal-{{ $loop->index }}')">Close</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        // Function to open the modal
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        // Function to close the modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
</section>

<!--==================== Floating Tutorial Button with Animation ============================-->
<div class="fixed bottom-10 right-8 z-50 flex flex-col items-center">
    <a href="#tutorialVideo" class="tutorial-button bg-[#fc4b3b] text-white rounded-full p-4 shadow-lg flex items-center justify-center transform transition-all duration-300 ease-in-out scale-110">
        <!-- Play Icon -->
        <span class="ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m380-300 280-180-280-180v360ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
        </span>
        <!-- Text Underneath (optional) -->
        <span class="text-xs font-semibold text-white">Watch Demo</span>
    </a>
</div>

<!--======================= Tutorial Video Section (Anchored) ===============================-->
<section id="tutorialVideo" class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <div class="mb-[5rem]">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">How to Get Started with <span class="text-[#fc4b3b]">Cybill software</span></h2>
            <p class="text-base text-gray-600">
                Watch this quick tutorial to learn how to start reselling and earning with Cybill Software.
            </p>
        </div>

        <!-- Video Embed -->
        <div class="relative w-full max-w-[800px] mx-auto">
            <!-- Video Container with Border & Shadow -->
            <div class="bg-[#fc4b3b] p-2 rounded-xl shadow-lg hover:shadow-2xl transform transition duration-500 ease-in-out">
                <!-- Video Embed (Maintained from previous solution) -->
                <iframe 
                    class="w-full h-[450px] rounded-lg"
                    src="https://www.youtube.com/embed/aIHJYJsqRJk" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                >
                </iframe>
            </div>
        </div>
    </div>
</section>

<!--================================== TFAQ SECTION ========================================-->
<!-- FAQ Section -->
<!-- FAQ Section -->
<section id="faq" class="py-16 bg-[#F4F7FA]">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold text-[#394b62] mb-6">Frequently Asked Questions</h2>
        
        <div class="max-w-3xl mx-auto">
            <!-- FAQ Item 1 -->
            <div class="bg-white shadow-lg rounded-lg mb-4">
                <div class="border-b p-6 flex justify-between items-center cursor-pointer" onclick="toggleFaq('faq-1')">
                    <h3 class="font-semibold text-[#fc4b3b]">How do I become a reseller?</h3>
                    <svg id="faq-icon-1" class="w-6 h-6 text-[#fc4b3b] transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div id="faq-1" class="px-6 pb-6 text-gray-600 hidden">
                    <p>Simply sign up on our platform, and you'll get access to all the tools and resources you need to start reselling.</p>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="bg-white shadow-lg rounded-lg mb-4">
                <div class="border-b p-6 flex justify-between items-center cursor-pointer" onclick="toggleFaq('faq-2')">
                    <h3 class="font-semibold text-[#fc4b3b]">What commission can I expect?</h3>
                    <svg id="faq-icon-2" class="w-6 h-6 text-[#fc4b3b] transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div id="faq-2" class="px-6 pb-6 text-gray-600 hidden">
                    <p>We offer competitive commissions depending on the products you sell. You'll receive detailed reports on your earnings in your dashboard.</p>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="bg-white shadow-lg rounded-lg mb-4">
                <div class="border-b p-6 flex justify-between items-center cursor-pointer" onclick="toggleFaq('faq-3')">
                    <h3 class="font-semibold text-[#fc4b3b]">How can I track my earnings?</h3>
                    <svg id="faq-icon-3" class="w-6 h-6 text-[#fc4b3b] transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div id="faq-3" class="px-6 pb-6 text-gray-600 hidden">
                    <p>You can easily track your earnings and commissions from your dashboard, with detailed reports and charts.</p>
                </div>
            </div>

            <!-- FAQ Item 4 (NEW) -->
            <div class="bg-white shadow-lg rounded-lg mb-4">
                <div class="border-b p-6 flex justify-between items-center cursor-pointer" onclick="toggleFaq('faq-4')">
                    <h3 class="font-semibold text-[#fc4b3b]">How do I get paid?</h3>
                    <svg id="faq-icon-4" class="w-6 h-6 text-[#fc4b3b] transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div id="faq-4" class="px-6 pb-6 text-gray-600 hidden">
                    <p>You will receive your earnings via bank transfer or payment services, based on your preferences set up in your dashboard.</p>
                </div>
            </div>

            <!-- FAQ Item 5 (NEW) -->
            <div class="bg-white shadow-lg rounded-lg mb-4">
                <div class="border-b p-6 flex justify-between items-center cursor-pointer" onclick="toggleFaq('faq-5')">
                    <h3 class="font-semibold text-[#fc4b3b]">Can I sell multiple products?</h3>
                    <svg id="faq-icon-5" class="w-6 h-6 text-[#fc4b3b] transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div id="faq-5" class="px-6 pb-6 text-gray-600 hidden">
                    <p>Yes! You can sell as many products as you'd like, and earn commissions on each one sold.</p>
                </div>
            </div>

            <!-- FAQ Item 6 (NEW) -->
            <div class="bg-white shadow-lg rounded-lg mb-4">
                <div class="border-b p-6 flex justify-between items-center cursor-pointer" onclick="toggleFaq('faq-6')">
                    <h3 class="font-semibold text-[#fc4b3b]">How do I install the software?</h3>
                    <svg id="faq-icon-6" class="w-6 h-6 text-[#fc4b3b] transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div id="faq-6" class="px-6 pb-6 text-gray-600 hidden">
                    <p>Once you make a purchase, your client will receive a product activation code and installation instructions via email.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    // Function to toggle FAQ visibility and change icon rotation
    function toggleFaq(faqId) {
        const faqContent = document.getElementById(faqId);
        const faqIcon = document.getElementById(`faq-icon-${faqId.split('-')[1]}`);

        // Toggle visibility of FAQ content
        faqContent.classList.toggle('hidden');

        // Rotate icon on click
        faqIcon.classList.toggle('rotate-180');
    }
</script>

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