@extends('layouts.base')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-28 sm:py-32 lg:flex lg:items-center lg:gap-x-10 lg:px-6 lg:py-30">
    <div id="about_us_page_hero" class="flex flex-col md:flex-row justify-center items-start w-full space-x-0 md:space-x-6">
        <!-- left Side -->
        <div class="md:w-1/2 py-6 mb-6 flex flex-col md:bg-white md:shadow-md md:px-6 md:rounded-lg" style="min-height: 600px;">
            <img src="{{ asset('assets/img/about_us.jpg') }}" alt="Cybill Software" class="w-full rounded-lg shadow-md mb-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Service Card 1 -->
                <div class="bg-gray-200 p-4 rounded-lg shadow-md text-gray-800 card" id="card1">
                    <div class="flex items-center">
                        <div class="mr-3">
                            <img id="icon" src="{{ asset('assets/img/cyber_security.png') }}" alt="Cyber_security Icon" class="w-10 h-10">
                        </div>
                        <h3 class="text-lg font-semibold">Cyber Security</h3>
                    </div>
                    <p class="mt-2 line-clamp-2">
                        We provide a variety of solutions to give you proactive and preventive defenses against today's cyber threats.
                        Our team works tirelessly to ensure your safety online, adapting to the constantly evolving landscape of cyber threats.
                    </p>
                    <button 
                        class="text-blue-600 service-card-button"
                        data-title="Cyber Security"
                        data-description="We provide a variety of solutions to give you proactive and preventive defenses against today's cyber threats.
                            Our team works tirelessly to ensure your safety online, adapting to the constantly evolving landscape of cyber threats."
                    >
                        More Info
                    </button>
                </div>
                <!-- Service Card 2 -->
                <div class="bg-gray-200 p-4 rounded-lg shadow-md text-gray-800 card" id="card2">
                    <div class="flex items-center">
                        <div class="mr-3">
                            <img id="icon" src="{{ asset('assets/img/cyber_insurance.png') }}" alt="Cyber_security Icon" class="w-10 h-10">
                        </div>
                        <h3 class="text-lg font-semibold">Cyber Insurance</h3>
                    </div>
                    <p class="mt-2 line-clamp-2">
                        We provide products that enables businesses to mitigate the risk of cyber crime activity like cyber attack
                        and data breaches.
                    </p>
                    <button 
                        class="text-blue-600 service-card-button"
                        data-title="Cyber Insurance"
                        data-description="We provide products that enables businesses to mitigate the risk of cyber crime activity
                            like cyber attack and data breaches."
                    >
                        More Info
                    </button>
                </div>
                <!-- Service Card 3 -->
                <div class="bg-gray-200 p-4 rounded-lg shadow-md text-gray-800 card" id="card3">
                    <div class="flex items-center">
                        <div class="mr-3">
                            <img id="icon" src="{{ asset('assets/img/digital_assets.png') }}" alt="digital_assets Icon" class="w-10 h-10">
                        </div>
                        <h3 class="text-lg font-semibold">Digital Assets</h3>
                    </div>
                    <p class="mt-2 line-clamp-2">
                        We easily deliver software licenses, tickets, and tokens online, ensuring that our clients have immediate 
                        access to the tools they need. Our streamlined process eliminates the delays often associated with 
                        traditional licensing methods, allowing users to activate and utilize their software in just a few clicks.
                    </p>
                    <button 
                        class="text-blue-600 service-card-button"
                        data-title="Digital Assets"
                        data-description="We easily deliver software licenses, tickets, and tokens online, ensuring that our clients 
                            have immediate access to the tools they need. Our streamlined process eliminates the delays often associated 
                            with traditional licensing methods, allowing users to activate and utilize their software in just a few clicks."
                    >
                        More Info
                    </button>
                </div>
                <!-- Service Card 4 -->
                <div class="bg-gray-200 p-4 rounded-lg shadow-md text-gray-800 card" id="card4">
                    <div class="flex items-center">
                        <div class="mr-3">
                            <img id="icon" src="{{ asset('assets/img/threat_detection.png') }}" alt="Threat Detection Icon" class="w-10 h-10">
                        </div>
                        <h3 class="text-lg font-semibold">Threat Detection</h3>
                    </div>
                    <p class="mt-2 line-clamp-2">
                        Our advanced threat detection solutions utilize cutting-edge technology to identify and neutralize potential security threats 
                        before they can impact your operations. We provide real-time monitoring and alerts, ensuring you stay one step ahead of cyber criminals.
                    </p>
                    <button 
                        class="text-blue-600 service-card-button"
                        data-title="Threat Detection"
                        data-description="Our advanced threat detection solutions utilize cutting-edge technology to identify and 
                            neutralize potential security threats before they can impact your operations. We provide real-time 
                            monitoring and alerts, ensuring you stay one step ahead of cyber criminals."
                    >
                        More Info
                    </button>
                </div>
            </div>
        </div>
        <!-- Right Side -->
        <div class="md:w-1/2 py-6 flex flex-col md:bg-white md:shadow-md md:px-6 md:rounded-lg" style="min-height: 600px;">
            <h1 class="text-5xl sm:text-6xl font-bold text-[#2c2c64]">
                <span class="block">Our</span>
                <span class="block">Dream</span>
            </h1>
            <p class="mt-6 text-lg">
                At Cybill, we envision a future where technology empowers individuals and organizations to thrive securely in the digital world. 
                We are committed to transforming cybersecurity, making it accessible and effective for everyone.
            </p>
            <h2 class="mt-5 md:mt-12 text-2xl font-semibold">About Us</h2>
            <p class="mt-2">
                We are a dedicated team of cybersecurity experts passionate about safeguarding your digital assets. Our motto, "Revolutionary, Repackaged," reflects our innovative approach to providing cutting-edge solutions tailored to your unique needs.
            </p>

            <!-- Why Choose Us Section -->
            <h2 class="mt-5 md:mt-12 text-2xl font-semibold">Why Choose Us</h2>
            <p class="mt-2">
                We deliver software licenses in seconds, ensuring seamless access across the African region through our online platform. 
            </p>
            <p class="mt-2">
                With a strong commitment to customer satisfaction, we offer 24/7 support and continuously update our solutions to address the latest security threats.
            </p>
        </div>
    </div>
</div>
<!-- Modal Structure For reading more about our services -->
<div id="ourServicesModal" class="hidden fixed flex inset-0 z-50 items-center bg-white bg-opacity-80 justify-center">
    <div class="bg-gray-100 p-5 border rounded-lg shadow-md w-11/12 max-w-lg sm:max-w-xl m-5">
        <span id="closeButton" class="font-bold float-right text-2xl cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
            </svg>
        </span>
        <div class="flex items-center mt-4 mb-4">
            <img id="modalIcon" src="" alt="Service Icon" class="w-12 h-12 mr-3">
            <h2 id="modalTitle" class="text-xl font-semibold"></h2>
        </div>
        
        <p id="modalDescription" class="text-gray-700"></p>
    </div>
</div>
@endsection