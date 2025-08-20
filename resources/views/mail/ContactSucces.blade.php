@extends('layout.Main')

@section('title', 'Success')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-green-50">
        <div class="bg-white shadow-lg rounded-lg p-8 text-center">
            <h1 class="text-2xl font-bold text-green-600 mb-4">✅ Message Sent Successfully!</h1>
            <p class="text-gray-700 mb-6">Thank you for contacting us. We will get back to you soon.</p>

            <a href="{{ route('home') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                Back to Home
            </a>
        </div>
    </div>
@endsection
