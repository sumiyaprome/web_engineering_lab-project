@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Create Account</h1>
            <p class="text-gray-600 mt-2">Join FoodHub today and start ordering</p>
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

            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Full Name Field -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Full Name
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none transition @error('name') border-red-500 @enderror"
                        placeholder="John Doe"
                        required
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

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
                        placeholder="johndoe"
                        required
                    >
                    @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        Email (Optional)
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none transition @error('email') border-red-500 @enderror"
                        placeholder="john@example.com"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contact Field -->
                <div>
                    <label for="contact" class="block text-sm font-semibold text-gray-700 mb-2">
                        Contact Number
                    </label>
                    <input 
                        type="tel" 
                        id="contact" 
                        name="contact"
                        value="{{ old('contact') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none transition @error('contact') border-red-500 @enderror"
                        placeholder="+8801234567890"
                        required
                    >
                    @error('contact')
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
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 mt-6"
                >
                    Create Account
                </button>
            </form>

            <!-- Login Link -->
            <p class="text-center mt-6 text-gray-600">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-sky-500 hover:text-sky-600 font-semibold">
                    Login here
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
