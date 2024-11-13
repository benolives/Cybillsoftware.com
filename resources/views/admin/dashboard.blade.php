@extends('layouts.dashboard_base')

@php
    use Carbon\Carbon;
@endphp

@section('content')
<div id="adminDashboardPage" class="flex h-screen">
    <div id="sidebar" class="fixed z-20 h-full w-64 bg-[#1a2035] top-0 left-0 translate-x-[-100%] transition-all duration-300 ease-in-out md:static md:transform-none">
        <div>We will have sideBar Content Here</div>
    </div>

    <div id="mainContent" class="flex-1 overflow-y-auto">
        <!-- Admin Dashboard Header -->
        <div class="bg-white py-4 px-6 rounded-md flex items-center justify-between mb-6">
            <div class="flex items-center">
                <img src="{{ asset('assets/img/anime.jpg') }}" alt="Profile Picture" class="rounded-full border border-gray-300 w-10 h-10 object-cover">
                <span class="ml-2 text-gray-600">Admin, Name of admin
                </span>
            </div>
        </div>

        <!-- Kaspersky Payment Section -->
        <div class="px-6 bg-white py-4 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-600">Kaspersky Sales Overview</h2>
            
            <!-- Kaspersky Sales Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Kaspersky Sales Card -->
                <div class="bg-white p-4 rounded-lg shadow flex items-center">
                    <div class="flex-shrink-0 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#3f73b6" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708"/>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-md font-semibold text-blue-600">Kaspersky Total Sales</h2>
                        <p class="text-md font-bold text-gray-800">{{ $totalKasperskySales }}</p>
                    </div>
                </div>

                <!-- Kaspersky Total Commission Card -->
                <div class="bg-white p-4 rounded-lg shadow flex items-center">
                    <div class="flex-shrink-0 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#3fb6a0" class="bi bi-clipboard2-check-fill" viewBox="0 0 16 16">
                        <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5"/>
                        <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585q.084.236.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5q.001-.264.085-.5m6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-md font-semibold text-green-600">Kaspersky Commission Earned</h2>
                        <p class="text-md font-bold text-gray-800">Cybill commission</p>
                    </div>
                </div>

                <!-- Kaspersky Payment Button -->
                <div class="bg-white p-4 rounded-lg shadow flex items-center justify-center">
                    <form id="paymentForm" action="{{ route('initiateB2B') }}" method="POST">
                        @csrf
                        <!-- Hidden Input Field to pass the totalKasperskySales value -->
                        <input type="hidden" name="totalKasperskySales" value="{{ $totalKasperskySales }}">

                        <button type="button" id="payBenOlivesButton" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-md">
                            Pay Ben Olives
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-80">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md mx-4">
            <h2 class="text-xl font-semibold mb-4">Confirm Payment</h2>
            <p>Are you sure you want to pay <strong>KSH {{ $totalKasperskySales }}?</strong></p>
            <div class="flex flex-col sm:flex-row justify-end mt-4">
                <button id="cancelButton" class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg mb-2 sm:mb-0 sm:mr-2">Cancel</button>
                <button id="confirmButton" class="bg-red-600 text-white font-semibold py-2 px-4 rounded-lg">Sure, Pay</button>
            </div>
        </div>
    </div>

    <!-- B2B Result Modal to show if the initiate is successful or not -->
    <div id="B2BModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-80">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md mx-4">
            <div id="B2BModalContent" class="flex flex-col items-center">
                <div id="B2BModalIcon" class="mb-4"></div>
                <p id="B2BModalMessage" class="text-md text-center"></p>
            </div>
            <div class="flex justify-end mt-4">
                <button id="closeB2BModalButton" class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection