@extends('layouts.dashboard_base')

<!-------- import carbon for date formatting ------------------------------------------->
@php
    use Carbon\Carbon;
@endphp

<!------- Count the products sold for each category ------------------------------------->
<?php
    $bitdefenderCount = $clients->where('status', 'complete')->where('product_category', 'bitdefender')->count();
    $kasperskyCount = $clients->where('status', 'complete')->where('product_category', 'kaspersky')->count();
    $totalSumCompleteClients = $clients->where('status', 'complete')->sum('product_price');
    $totalCommission = $clients->where('status', 'complete')->sum('commission_received');
?>

<!----- Handle toasts if this page is shown after successfull payment from customer------>
@if (request()->query('toast') === 'success')
    <script>
        // Show the toast message using Toastify
        document.addEventListener("DOMContentLoaded", function() {
            Toastify({
                text: "Congratulations, Your Earnings just increased!!!",
                duration: 3000,
                gravity: "top",
                position: 'center',
                backgroundColor: "green",
            }).showToast();

            // Trigger confetti
            const end = Date.now() + (3 * 1000); // 3 seconds
            const interval = setInterval(function() {
                const timeLeft = end - Date.now();
                if (timeLeft <= 0) {
                    return clearInterval(interval);
                }
                confetti({
                    particleCount: 70,
                    startVelocity: 30,
                    spread: 360,
                    origin: {
                        x: Math.random(),
                        // randomize the y position
                        y: Math.random() - 0.2
                    }
                });
            }, 250);
        });
    </script>
@endif


@section('content')
<div id="partnerPage" class="flex h-screen">
    <!-- Overlay for Mobile -->
    <div id="overlay" class="hidden md:hidden fixed z-10 top-0 right-0 bottom-0 left-0 bg-black bg-opacity-50"></div>

    <!-- The Sidebar -->
    <div id="sidebar" class="fixed z-20 h-full w-64 bg-[#1a2035] top-0 left-0 translate-x-[-100%] 
        transition-all duration-300 ease-in-out md:static md:transform-none"
    >
        <!-- Logo Section -->
        <div class="flex items-center justify-between p-6 mb-6">
            <h2 class="text-white font-semibold italic text-lg">Cybill Software</h2>
            <button id="closeSidebar" class="ml-4 text-white md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-x-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </button>
        </div>
        <h4 class="py-[10px] px-6 text-[12px] text-white font-semibold uppercase tracking-[0.5px] mb-[12px] mt-[20px] bg-[#131a27]">
            Navigations
        </h4>
        <!-- Main Links -->
        <ul class="font-medium">
            <!-- Client Link -->
            <li class="px-6 mb-4 hover:bg-blue-100 focus:bg-blue-100 transition duration-200 group">
                <button id="myClients" class="flex items-center text-white hover:text-[#2c2c64] focus:text-white  py-2 rounded-md w-full">
                    <img 
                        src="{{ asset('assets/img/clients_icon.png') }}" 
                        alt="clients icon" 
                        class="w-8 h-8 object-cover rounded-lg mr-4"
                    >
                    <span>My Clients</span>
                </button>
            </li>
             <!-- Earnings Link -->
            <li class="px-6 mb-4 hover:bg-blue-100 transition duration-200 group">
                <button id="myEarnings" class="flex items-center text-white hover:text-[#2c2c64] focus:text-white  py-2 rounded-md w-full">
                    <img 
                        src="{{ asset('assets/img/earnings_icon.png') }}" 
                        alt="clients icon" 
                        class="w-8 h-8 object-cover rounded-lg mr-4"
                    >
                    <span>My Earnings</span>
                </button>
            </li>
            <!-- Products Link -->
            <li class="px-6 mb-4 hover:bg-blue-100 transition duration-200 group">
                <button id="productsSold" class="flex items-center text-white hover:text-[#2c2c64] focus:text-white  py-2 rounded-md w-full">
                    <img 
                        src="{{ asset('assets/img/products_icon.png') }}" 
                        alt="clients icon" 
                        class="w-8 h-8 object-cover rounded-lg mr-4"
                    >
                    <span>Products Sold</span>
                </button>
            </li>
            <!-- Divider for More Links -->
            <li class="my-4 border-t border-gray-200"></li>

            <!-- Transactions link -->
            <li class="px-6 mb-4 hover:bg-blue-100 transition duration-200 group">
                <button class="flex items-center text-white hover:text-[#2c2c64] focus:text-white py-2 rounded-md w-full">
                    <img 
                        src="{{ asset('assets/img/transaction_icon.webp') }}" 
                        alt="clients icon" 
                        class="w-8 h-8 object-cover rounded-lg mr-4"
                    >
                    <span>Transactions</span>
                </button>
            </li>
            <!-- Settings links -->
            <li class="px-6 mb-4 hover:bg-blue-100 transition duration-200 group">
                <button id="mySettings" class="flex items-center text-white hover:text-[#2c2c64] focus:text-white py-2 rounded-md w-full">
                    <img 
                        src="{{ asset('assets/img/settings_icon.jpg') }}" 
                        alt="clients icon" 
                        class="w-8 h-8 object-cover rounded-lg mr-4"
                    >
                    <span>Settings</span>
                </button>
            </li>
            <!-- Help links -->
            <li class="px-6 mb-4 hover:bg-blue-100 transition duration-200 group">
                <button class="flex items-center text-white hover:text-[#2c2c64] focus:text-white py-2 rounded-md w-full">
                    <img 
                        src="{{ asset('assets/img/help_icon.png') }}" 
                        alt="clients icon" 
                        class="w-8 h-8 object-cover rounded-lg mr-4"
                    >
                    <span>Support</span>
                </button>
            </li>
        </ul>
        <!-- Footer User Info -->
        <div class="flex items-center justify-between mt-6 px-6 bg-blue-100 py-[10px]">
            <img 
                src="{{ asset('assets/img/anime.jpg') }}" 
                alt="user logo" 
                class="h-8 w-8 object-cover rounded-full"
            >
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-[#2c2c64] flex items-center">
                    <h4 class="mr-2 font-semibold">Logout</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Right Details Section -->
    <div id="mainContent" class="flex-1 overflow-y-auto">
        <div class="md:hidden p-6 mb-4 flex items-center justify-between">
            <button id="OpenSidebarButton" class=" text-[#2c2c64]">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="blue" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                </svg>
            </button>
            <a href="/" class="flex items-center font-semibold cursor-pointer">
                <div class="text-black mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                </div>
                <div class="text-black uppercase">Go Home</div>
            </a>
        </div>
        
        <!-- Header Section -->
        <div class="bg-white py-4 px-6 rounded-md flex items-center justify-between mb-6">
            <a href="/" class="hidden md:flex items-center font-semibold cursor-pointer">
                <div class="text-black mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                </div>
                <div class="text-black uppercase">Go Home</div>
            </a>
            <div class="flex items-center">
                <img src="{{ asset('assets/img/anime.jpg') }}" alt="Profile Picture" class="rounded-full border border-gray-300 w-10 h-10 object-cover">
                <span class="ml-2 text-gray-600">Hi, 
                    <span class="text-black">{{ Auth::user()->name }}</span>
                </span>
            </div>
        </div>

        <h1 class="p-6 hidden md:block text-2xl font-semibold mb-0 text-[#444]">
            {{ Auth::user()->name }}
            Account
        </h1>
        
        <!-- Overview Cards -->
        <div class="px-6 grid grid-cols-1 md:grid-cols-4 gap-5 my-8">
            <!------------ TOTAL SALES CARD --------------------------->
            <div class="bg-white p-4 rounded-lg shadow flex items-center">
                <div class="flex-shrink-0 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#3f73b6" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708"/>
                    </svg>
                </div>
                <div class="flex-grow">
                    <h2 class="text-md font-semibold text-blue-600">Total Sales</h2>
                    <p class="text-md font-bold text-gray-800">{{ $totalSumCompleteClients }}</p>
                </div>
            </div>
            <!------------ TOTAL COMMISSIONS CARD --------------------------->
            <div class="bg-white p-4 rounded-lg shadow flex items-center">
                <div class="flex-shrink-0 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#3fb6a0" class="bi bi-clipboard2-check-fill" viewBox="0 0 16 16">
                    <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5"/>
                    <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585q.084.236.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5q.001-.264.085-.5m6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
                    </svg>
                </div>
                <div class="flex-grow">
                    <h2 class="text-md font-semibold text-green-600">Commission Earned</h2>
                    <p class="text-md font-bold text-gray-800">{{ $totalCommission }}</p>
                </div>
            </div>
            <!------------ BITDEFENDER PRODUCTS SOLD --------------------------->
            <div class="bg-white p-4 rounded-lg shadow flex items-center">
                <div class="flex-shrink-0 mr-4">
                    <img 
                        src="{{ asset('assets/img/bitdefender.png') }}" 
                        alt="bitdefender logo" 
                        class="h-14 w-14 object-cover"
                    >
                </div>
                <div class="flex-grow">
                    <h2 class="text-md font-semibold text-[#fc4b3b]">Bitdefender sold</h2>
                    <p class="text-md font-bold text-gray-800">{{ $bitdefenderCount }}</p>
                </div>
            </div>
            <!------------ Kaspersky PRODUCTS SOLD --------------------------->
            <div class="bg-white p-4 rounded-lg shadow flex items-center">
                <div class="flex-shrink-0 mr-4">
                    <img 
                        src="{{ asset('assets/img/kaspersky_logo.png') }}" 
                        alt="bitdefender logo" 
                        class="h-14 w-14 object-cover"
                    >
                </div>
                <div class="flex-grow">
                    <h2 class="text-md font-semibold text-[#fc4b3b]">Kaspersky sold</h2>
                    <p class="text-md font-bold text-gray-800">{{ $kasperskyCount }}</p>
                </div>
            </div>
        </div>

        <!-- Dynamic Content Area -->
        <div id="contentArea" class="px-6">
            <!----- My clients section ------>
            <div id="clientsSection" class="hidden">
                <h2 class="text-xl font-semibold text-[#2c2c64] mb-3">My Clients</h2>
                <!-- Search Bar -->
                <input 
                    type="text" 
                    id="clientSearchInput" 
                    placeholder="Search by name..." 
                    class="border border-gray-300 rounded-md p-2 mb-4 w-full md:w-1/3 focus:outline-none"
                />
                <!-- Responsive Table Wrapper -->
                <div class="overflow-x-auto rounded-md">
                    <table class="min-w-full bg-white border border-gray-300 rounded-md shadow">
                        <thead>
                            <tr class="bg-gray-200 text-[#2c2c64]">
                                <th class="py-2 px-4 border-b text-start">Name</th>
                                <th class="py-2 px-4 border-b text-start">Email</th>
                                <th class="py-2 px-4 border-b text-start">Phone</th>
                                <th class="py-2 px-4 border-b text-start">Product Name</th>
                                <th class="py-2 px-4 border-b text-start">Price</th>
                                <th class="py-2 px-4 border-b text-start">Subscription</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients->where('status', 'complete') as $index => $client)
                                <tr class="hover:bg-gray-100 {{ $index % 2 == 0 ? 'bg-[#fc4b3b33]' : 'bg-white' }}">
                                    <td class="py-2 px-4 border-b">{{ $client->name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $client->email }}</td>
                                    <td class="py-2 px-4 border-b">{{ $client->phone }}</td>
                                    <td class="py-2 px-4 border-b">{{ $client->product_name }}</td>
                                    <td class="py-2 px-4 border-b">sh{{ number_format($client->product_price, 2) }}</td>
                                    <td class="py-2 px-4 border-b">{{ $client->subscription_type }}</td>
                                </tr>
                            @endforeach
                            @if($clients->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center py-4">No clients found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!------My earnings section ----->
            <div id="earningsSection" class="">
                <h2 class="text-xl font-semibold text-[#2c2c64] mb-3">My Earnings</h2>
                <!-- Responsive Table Wrapper -->
                <div class="overflow-x-auto rounded-md">
                    <table class="min-w-full bg-white border border-gray-300 rounded-md shadow">
                        <thead>
                            <tr class="bg-gray-200 text-[#2c2c64]">
                                <th class="py-2 px-4 border-b text-start">Product</th>
                                <th class="py-2 px-4 border-b text-start">Sale Amount</th>
                                <th class="py-2 px-4 border-b text-start">Commission Earned</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalSaleAmount = 0;
                                $totalCommission = 0;
                            @endphp

                            @foreach($clients->where('status', 'complete') as $client)
                                <tr class="hover:bg-gray-100">
                                    <td class="py-2 px-4 border-b">{{ $client->product_name }}</td>
                                    <td class="py-2 px-4 border-b">{{ number_format($client->product_price, 2) }}</td>
                                    <td class="py-2 px-4 border-b">{{ number_format($client->commission_received, 2) }}</td>
                                </tr>
                                @php
                                    $totalSaleAmount += $client->product_price;
                                    $totalCommission += $client->commission_received;
                                @endphp
                            @endforeach

                            @if($clients->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center py-4">No earnings found.</td>
                                </tr>
                            @endif

                            <tr class="font-bold bg-[#fc4b3b]">
                                <td class="py-2 px-4 border-b">Total</td>
                                <td class="py-2 px-4 border-b">{{ number_format($totalSaleAmount, 2) }}</td>
                                <td class="py-2 px-4 border-b">{{ number_format($totalCommission, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!------Products sold section ----->
            <div id="productsSection" class="hidden">
                <h2 class="text-xl font-semibold text-[#2c2c64] mb-3">Products sold</h2> 
                <!-- Responsive Table Wrapper -->
                <div class="overflow-x-auto rounded-md">
                    <table class="min-w-full bg-white border border-gray-300 rounded-md shadow">
                        <thead>
                            <tr class="bg-gray-200 text-[#2c2c64]">
                                <th class="py-2 px-4 border-b text-start">Product</th>
                                <th class="py-2 px-4 border-b text-start">Expiry Date</th>
                                <th class="py-2 px-4 border-b text-start">Customer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients->where('status', 'complete') as $client)
                                <tr class="hover:bg-gray-100">
                                    <td class="py-2 px-4 border-b">{{ $client->product_name }}</td>
                                    <td class="py-2 px-4 border-b">
                                        {{ \Carbon\Carbon::parse($client->expires_at)->format('F j, Y') }}
                                    </td>
                                    <td class="py-2 px-4 border-b">{{ $client->name }}</td>
                                </tr>
                            @endforeach

                            @if($clients->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center py-4">No products sold found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!---- The settings section ------->
            <div id="settingsSection" class="hidden p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-4 text-[#2c2c64]">Settings</h2>
                <!-- Profile Settings -->
                <div class="flex flex-col md:flex-row md:space-x-6">
                    <!-- Profile Info -->
                    <div class="flex-1 mb-4">
                        <h3 class="text-lg font-semibold mb-2">My profile</h3>
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('assets/img/anime.jpg') }}" alt="Profile Picture" class="rounded-full border border-gray-300 w-24 h-24 object-cover mr-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                                <p class="text-gray-600">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <!-- Security Settings -->
                        <h3 class="text-lg font-bold mb-2 mt-6">Security Settings</h3>
                        <button class="mt-2 bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-500 transition duration-300">
                            Change Password
                        </button>
                    </div>

                    <!-- Update Form -->
                    <div class="flex-1">
                        <form>
                            <h3 class="text-lg font-bold mb-2">Update Profile</h3>
                            <div class="mb-4">
                                <label class="block mb-2">Name:</label>
                                <input type="text" value="{{ auth()->user()->name }}" class="border border-gray-300 rounded-lg p-2 w-full" required>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2">Email:</label>
                                <input type="email" value="{{ auth()->user()->email }}" class="border border-gray-300 rounded-lg p-2 w-full" required>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2">M-Pesa Number:</label>
                                <input type="text" value="{{ auth()->user()->phone }}" class="border border-gray-300 rounded-lg p-2 w-full" placeholder="e.g., 254712345678" required>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2">Profile Picture:</label>
                                <input type="file" class="border border-gray-300 rounded-lg p-2 w-full">
                            </div>
                            <div>
                                <button type="submit" class="mt-4 bg-[#fc4b3b] text-white rounded-lg px-4 py-2 hover:bg-[#e03e30] transition duration-300">
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection