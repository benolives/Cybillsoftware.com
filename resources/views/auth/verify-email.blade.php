@extends('layouts.auth_base')

@section('content')
    <div class="bg-white flex items-center justify-center min-h-screen">
        <div class="max-w-md w-full mx-auto p-6 rounded-lg shadow-lg bg-white">
            <h1 class="text-2xl font-semibold text-center text-[#2c2c64]">Check Your Email!</h1>
            <p class="mt-4 text-center text-gray-600">
                A verification email has been sent to 
                <span class="font-semibold text-gray-800">
                    @if(session('email'))
                        {{ session('email') }}
                    @else
                        {{ $email }}
                    @endif
                </span>.
                Please check your inbox and follow the instructions to verify your account.
            </p>
            <p class="mt-2 text-center text-gray-600">
                If you haven't received the email, you can <span class="font-semibold text-gray-800">resend it here:</span>
            </p>
            @if(session('message'))
                <div class="mt-2 text-center text-green-600">
                    {{ session('message') }}
                </div>
            @endif
            <form action="{{ route('verification.resend') }}" method="post" class="mt-4 flex justify-center">
                @csrf
                <button class="bg-[#fc4b3b] text-white px-4 py-2 rounded-lg hover:bg-fc4b3b-600 focus:outline-none">
                    Resend Verification Email
                </button>
            </form>
        </div>
    </div>
@endsection