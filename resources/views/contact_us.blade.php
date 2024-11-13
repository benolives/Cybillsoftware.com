@extends('layouts.auth_base')

@section('content')
<div class="antialiased flex w-full min-h-screen justify-center items-center">
    <div class="flex flex-col md:flex-row md:space-x-6 space-y-6 md:space-y-0 bg-[#2c2c64] w-full max-w-4xl p-8 sm:p-14 rounded-sm md:rounded-xl shadow-lg text-white overflow-hidden">
        <div class="flex flex-col space-y-8 justify-between flex-grow md:min-w-[400px]">
            <div>
                <h1 class="font-bold text-4xl tracking-wide text-[white]">Contact us</h1>
                <p class="pt-2 text-gray-300 text-sm">
                    We would love to hear from you! Whether you have questions, feedback, or need support, feel free to reach out to us anytime. Your inquiries are important to us, and we will respond as soon as possible.
                </p>
            </div>
            <div class="flex flex-col space-y-6">
                <div class="inline-flex space-x-2 items-center cursor-pointer">
                    <span class="text-[#fc4b3b] text-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                        </svg>
                    </span>
                    <span>+254 (0) 720 548574</span>
                </div>
                <div class="inline-flex space-x-2 items-center cursor-pointer">
                    <span class="text-[#fc4b3b] text-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
                        </svg>
                    </span>
                    <span>info@cybillsoftware.com</span>
                </div>
                <div class="inline-flex space-x-2 items-center">
                    <span class="text-[#fc4b3b] text-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                        </svg>
                    </span>
                    <span>Southern Tower 3rd Floor, Two Rivers</span>
                </div>
            </div>
            <div class="flex space-x-4 text-lg">
                <a href="https://www.facebook.com/CybillSoftware" target="_blank" rel="noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                    </svg>
                </a>
                <a href="https://x.com/CybillSoftware" target="_blank" rel="noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                    </svg>
                </a>
                <a href="https://www.linkedin.com/company/cybill-software/" target="_blank" rel="noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                    </svg>
                </a>
                <a href="https://www.instagram.com/cybillsoftware/" target="_blank" rel="noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.174.01 2.444.048 3.298.04.851.175 1.433.372 1.942a3.9 3.9 0 0 0 .923 1.417c.445.445.891.718 1.417.923.509.197 1.09.332 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                    </svg>
                </a>
            </div>
        </div>
        <div class="relative flex-grow md:min-w-[350px]">
            <div class="absolute z-0 w-40 h-40 bg-[#fc4b3b] rounded-full -right-28 -top-28"></div>
            <div class="absolute z-0 w-40 h-40 bg-[#fc4b3b] rounded-full -left-28 -bottom-16"></div>
            <div class="relative z-10 bg-white rounded-xl shadow-lg p-8 text-gray-700">
                <form action="" class="flex flex-col space-y-4">
                    <div>
                        <label for="" class="text-sm">Your name</label>
                        <input 
                            type="text" 
                            placeholder="Name" 
                            class="ring-1 ring-gray-300 w-full rounded-md mt-2 px-4 py-2 outline-none focus:ring-2 focus:ring-[#fc4b3b]"
                        >
                    </div>
                    <div>
                        <label for="" class="text-sm">Email address</label>
                        <input 
                            type="email" 
                            placeholder="Email" 
                            class="ring-1 ring-gray-300 w-full rounded-md mt-2 px-4 py-2 outline-none focus:ring-2 focus:ring-[#fc4b3b]"
                        >
                    </div>
                    <div>
                        <label for="" class="text-sm">Message</label>
                        <textarea 
                            rows=4 
                            placeholder="Message" 
                            class="ring-1 ring-gray-300 w-full rounded-md mt-2 px-4 py-2 outline-none focus:ring-2 focus:ring-[#fc4b3b]"
                        >
                        </textarea>
                    </div>
                    <button class="inline-block self-end bg-[#fc4b3b] text-white font-bold rounded-lg px-6 py-2 uppercase text-sm">
                        Send message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection