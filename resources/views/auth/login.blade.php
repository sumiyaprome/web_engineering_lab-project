@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Welcome to FoodHub</h1>
            <p class="text-gray-600 mt-2">Sign in to your account</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    @foreach($errors->all() as $error)
                        <p class="text-red-700 text-sm font-medium">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                        Username
                    </label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="{{ old('username') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none transition @error('username') border-red-500 @enderror"
                        placeholder="Enter your username"
                        required
                    >
                    @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none transition @error('password') border-red-500 @enderror"
                        placeholder="Enter your password"
                        required
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200"
                >
                    Sign In
                </button>
            </form>

            <!-- Register Link -->
            <p class="text-center mt-6 text-gray-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-sky-500 hover:text-sky-600 font-semibold">
                    Register here
                </a>
            </p>

            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
