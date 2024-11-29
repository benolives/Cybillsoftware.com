@extends('layouts.auth_base')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="max-w-lg w-full bg-white rounded-lg shadow-lg p-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-red-600 mb-4">Oops! Something went wrong</h1>
                <p class="text-lg text-gray-700 mb-6">{{ $errorMessage }}</p>

                <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 text-lg font-medium">
                    Go back to products
                </a>
            </div>
        </div>
    </div>
@endsection