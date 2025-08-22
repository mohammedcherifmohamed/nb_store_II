@extends('Layout.Main')
@section('title',"Admin|Login Page")
@section('content')

  @if ($errors->any())
    <div class="mb-4 text-red-600">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        @if (session('success'))
            <x-alert type="success">
                {{ session('success') }}
            </x-alert>
        @endif

    
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="w-full max-w-md mx-4">
            <!-- Login Card -->
            <div class="bg-white rounded-xl login-card overflow-hidden p-8">
                <div class="text-center mb-8">
                    <div class="flex justify-center items-center mb-4">
                        <i class="fas fa-mobile-alt text-3xl text-blue-500 mr-2"></i>
                        <span class="text-2xl font-bold text-gray-800">Phone Repair Academy</span>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800">Welcome back!</h1>
                    <p class="text-gray-600">Please sign in to your account</p>
                </div>

                <!-- Login Form -->
                <form action="{{route('login.post')}}" method="POST" id="loginForm" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input name="email" type="email" id="email" required 
                                class="input-field w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300"
                                placeholder="your@email.com">
                        </div>
                        <p id="email-error" class="mt-1 text-sm text-red-600 hidden">Please enter a valid email address</p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input name="password" type="password" id="password" required 
                                class="input-field w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300"
                                placeholder="••••••••">
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                            </button>
                        </div>
                        <p id="password-error" class="mt-1 text-sm text-red-600 hidden">Password must be at least 6 characters</p>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" 
                                class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                        </div>
                        <div class="text-sm">
                            <a href="{{route('forgot.load')}}" class="font-medium text-blue-500 hover:text-blue-700">Forgot password?</a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-blue-500 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-600 transition duration-300 flex items-center justify-center">
                            <span>Sign in</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>


            <!-- Demo Credentials (remove in production) -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4 text-sm text-blue-800">
                <p class="font-medium">Demo credentials:</p>
                <p>Email: <span class="font-mono">admin@example.com</span></p>
                <p>Password: <span class="font-mono">zzz</span></p>
            </div>
        </div>

    
    </div>

    @endsection

    {{-- @section('scripts')
        @vite('resources/js/login.js')
    @endsection --}}