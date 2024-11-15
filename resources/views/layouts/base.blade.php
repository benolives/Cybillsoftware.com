<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--================================ FAVICON =========================================-->
      <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">

      <!--================================= CSS ============================================-->
      <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/app-CmYmiJCz.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/header_section.css') }}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

      <title>Cybill Software | Revollutionary Repackaged | Buy Antivirus Software Online</title>

      @stack('styles')
      @php
         use Illuminate\Support\Facades\Request;
      @endphp
   </head>
   <!-- This is a section that contains a script for a toast incase any request that comes with a
   toast message this toast will show -->
   @if(session('toast'))
      <script>
        document.addEventListener('DOMContentLoaded', function () {
            Toastify({
                text: "{{ session('toast') }}",
                duration: 3000,
                gravity: "top",
                position: 'center',
                backgroundColor: "#28a745",
                stopOnFocus: true
            }).showToast();
        })
      </script>
   @endif
   <body class="antialiased">
      <!--============================ HEADER SECTION =======================================-->
      <header id="header-section" class="header-section w-full h-[64px] flex justify-center fixed top-0 left-0 z-50 bg-transparent transition-all duration-200">
         <div class="container mx-auto flex justify-between items-center px-4 md:px-6">
            <!-- Logo and Company Name -->
            <a href="/" class="flex items-center space-x-4 cursor-pointer">
               <img src="{{ asset('assets/img/cybillogo.png') }}" alt="Cybill Logo" class="h-10 w-auto text-white">
               <span id="logo-name" class="hidden md:block text-white text-xl font-semibold transition-colors duration-200">Cybill Software</span>
            </a>

            <!-- Navigation Links for desktop Menu -->
            <nav class="hidden md:flex space-x-6 tracking-tight">
                  <a href="/" class="desktop-link text-white {{ Request::is('/') ? 'active' : '' }} transition-colors duration-300">
                     Home
                  </a>
                  <a href="/about-us" class="desktop-link text-white {{ Request::is('about-us') ? 'active' : '' }} transition-colors duration-300">
                     About Us
                  </a>
                  <a href="/products" class="desktop-link text-white {{ Request::is('products') ? 'active' : '' }} transition-colors duration-300">
                     Products
                  </a>
                  <a href="/contact-us" class="desktop-link text-white {{ Request::is('contact') ? 'active' : '' }} transition-colors duration-300">
                     Contact Us
                  </a>
                  @auth
                  <a href="/my-account" class="desktop-link text-white">
                     My Dashboard
                  </a>
                  @endauth
                  <!-- User Account Section -->
                  <div class="relative hidden md:block">
                        @auth
                           <div class="desktop-link">
                              <button id="user-account-btn" class="flex items-center focus:outline-none">
                                 <img src="{{ Auth::user()->profile_image ?? asset('assets/img/anime.jpg') }}" alt="User Profile" class="h-10 w-10 rounded-full">
                                 <span class="ml-2">{{ Auth::user()->name }}</span>
                              </button>
                           </div>
                           <div id="user-account-dropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg hidden transition-opacity duration-200 ease-in-out">
                              <div class="py-2">
                                    <a href="/my-account" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors duration-200">My Page</a>
                                    <form action="{{ route('logout') }}" method="POST" class="inline">
                                       @csrf
                                       <button type="submit" class="w-full text-start px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                          Logout
                                       </button>
                                    </form>
                                    <!-- Add more items as needed -->
                              </div>
                           </div>
                        @else
                           <a href="/login" class="bg-[#fc4b3b] text-white py-2 px-4 rounded-md hover:bg-[#fc4b3b]/90">
                              Sign In
                           </a>
                        @endauth
                  </div>
            </nav>

            <!-- Mobile menu Button to open mobile-menu -->
            <div class="md:hidden">
                  <button id="nav-open" class="text-white focus:outline-none">
                     <!-- Icon for mobile menu (we are using an SVG) -->
                     <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                     </svg>
                  </button>
            </div>

            <!--- The mobile menu navigation --->
            <nav id="mobile-menu" class="fixed top-0 right-[-100%] bg-white w-[80%] h-full shadow-lg py-24 px-16 flex flex-col gap-10 transition-all duration-400 ease-in-out z-40">
               <div class="absolute right-4 top-6">
                  <button id="nav-close" class="focus:outline-none" aria-label="Close menu">
                     <!-- Close icon (you can use an icon library or an SVG here) -->
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                  </button>
               </div>
               <a href="/" 
                  class="nav-link text-gray-700 p-2 rounded {{ Request::is('/') ? 'bg-[#fc4b3b]' : '' }} transition duration-300">
                  Home
               </a>
               <a href="/about-us" 
                  class="nav-link text-gray-700 p-2 rounded {{ Request::is('about-us') ? 'bg-[#fc4b3b]' : '' }} transition duration-300">
                  About Us
               </a>
               <a href="/products" 
                  class="nav-link text-gray-700 p-2 rounded {{ Request::is('products') ? 'bg-[#fc4b3b]' : '' }} transition duration-300">
                  Products
               </a>
               <a href="/contact-us" 
                  class="nav-link text-gray-700 p-2 rounded {{ Request::is('contact') ? 'bg-[#fc4b3b]' : '' }} transition duration-300">
                  Contact Us
               </a>
               @auth
                  <a 
                     href="/my-account" 
                     class="nav-link text-gray-700 p-2 rounded {{ Request::is('my-account') ? 'bg-[#fc4b3b]' : '' }} transition duration-300">
                     My Page
                  </a>
                  <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 text-gray-700 hover:text-[#fc4b3b]">Logout</button>
                  </form>
               @else
                  <a 
                     href="/login" 
                     class="nav-link text-gray-700 p-2 rounded transition duration-300">
                     Sign In
                  </a>
               @endauth
            </nav>
         </div>
      </header>
      
      <!--============================ MAIN Section =========================================-->
      <main class="main">
         <!--==================== HOME ====================-->
         @yield('content')

      <!--==================== FOOTER SECTION ====================-->
      <footer 
         class="mt-8 py-[6.25rem] pb-[1.875rem] bg-gradient-to-r from-[#292663] to-[#ee4e37] text-white relative leading-5"
      >
         <div class="w-[85%] mx-auto flex flex-wrap items-start justify-between">
            <div class="basis-[100%] md:basis-[25%] p-[10px]">
               <img src="{{ asset('/assets/img/cybillogo.png') }}" alt="cyblillogo" class="mb-8">
               <p>
                  Since 2018, Cybill Software offers top-notch antivirus solutions for regulated 
                  industries,safeguarding finances and reputation.
                  Choose us for advanced cybersecurity without compromising flexibility.
               </p>
            </div>
            <div class="basis-[100%] md:basis-[25%] p-[10px]">
               <h3 class="w-fit mb-[40px] relative">
                  Office
                  <div class="w-full h-[2px] bg-white rounded-[3px] absolute top-[25px] left-0">
                  </div>
               </h3>
               <p>Limuru Road</p>
               <p>Southern Tower 3rd Floor, Two Rivers</p>
               <p>+254 (0) 720 548574</p>
               <p class="w-fit border-b border-b-gray-300 my-[20px]">info@cybillsoftware.com</p>
               <p>https://cybillsoftware.com/</p>
            </div>
            <div class="basis-[100%] md:basis-[25%] p-[10px]">
               <h3 class="w-fit mb-[40px] relative">
                  Main Menu
                  <div class="w-full h-[2px] bg-white rounded-[3px] absolute top-[25px] left-0"></div>
               </h3>
               <ul>
                  <a href="/"><li class="list-none mb-[12px]">Home</li></a>
                  <a href="/products"><li class="list-none mb-[12px]">All products</li></a>
                  <a href="/about-us"><li class="list-none mb-[12px]">About us</li></a>
                  <a href="/my-account"><li class="list-none mb-[12px]">My page</li></a>
                  <a href="/contact-us"><li class="list-none mb-[12px]">Contacts us</li></a>
               </ul>
            </div>
            <div class="basis-[100%] md:basis-[25%] p-[10px]">
               <h3 class="w-fit mb-[40px] relative">
                  Send Us an email
                  <div class="w-full h-[2px] bg-white rounded-[3px] absolute top-[25px] left-0"></div>
               </h3>
               <form action="{{ route('makeEnquiry') }}" method="POST" class="pb-[10px] flex items-center justify-between text-gray-900 border-b border-b-gray-300 mb-[50px]">
                  @csrf
                  <div class="mr-2 text-white">
                     <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                           <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                     </svg>
                  </div>
                  <input 
                     type="email" 
                     name="email"
                     placeholder="Enter your email" 
                     required
                     class="w-full bg-transparent text-white border-0 outline-none"
                  >
                  <button type="submit" class="bg-transparent cursor-pointer outline-none border-0"> 
                     <img src="{{ asset('assets/img/arrow-right-white.svg') }}" alt="submit">
                  </button>
               </form>

               <div class="flex items-center space-x-4">
                     <a href="https://www.facebook.com/CybillSoftware" target="_blank" rel="noopener noreferrer" class="text-white cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                           <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                        </svg>
                     </a>
                     <a href="https://x.com/CybillSoftware" target="_blank" rel="noopener noreferrer" class="text-white cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                           <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                        </svg>
                     </a>
                     <a href="https://www.instagram.com/cybillsoftware/" target="_blank" rel="noopener noreferrer" class="text-white cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                           <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                        </svg>
                     </a>
                     <a href="https://www.linkedin.com/company/cybill-software/" target="_blank" rel="noopener noreferrer" class="text-white cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                           <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                        </svg>
                     </a>
               </div>
            </div>
         </div>
         <hr class="w-[90%] border-0 border-b border-gray-300 my-[20px] mx-auto">
         <p class="text-center">&copy; Cybill Software. All rights reserved.</p>
      </footer>
      </main>
      <!--=============== MAIN JS ===============-->
      <script src="{{ asset('assets/js/main.js') }}"></script>
      <script src="{{ asset('assets/js/app-2m5-0K_5.js') }}"></script>
      <script src="{{ asset('assets/js/header_section.js') }}"></script>
      <script src="{{ asset('assets/js/home_index.js') }}"></script>
      @stack('scripts')   
   </body>
</html>