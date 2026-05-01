@extends('layouts.app')

@section('title', 'Wallet')

@section('content')
<div>
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">My Wallet</h1>
        <p class="text-gray-600 mt-2">Manage your balance and payment methods</p>
    </div>

    <!-- Wallet Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Balance Card -->
        <div class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-xl shadow-lg p-8 text-white">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <p class="text-sky-100 text-sm font-medium mb-2">Current Balance</p>
                    <h2 class="text-5xl font-bold">BDT Tk {{ $wallet->walletDetails()->first()->balance ?? 0 }}</h2>
                </div>
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
                    </svg>
                </div>
            </div>
            <div class="border-t border-white border-opacity-20 pt-4">
                <p class="text-sm text-sky-100">You can use this balance to pay for your orders</p>
            </div>
        </div>

        <!-- Card Details Card -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-xl font-bold text-gray-900">Card Details</h3>
                <svg class="w-8 h-8 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4z"/>
                </svg>
            </div>
            @if($wallet->walletDetails()->first())
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600 text-sm">Card Number</p>
                        <p class="text-lg font-semibold text-gray-900">**** **** **** {{ substr($wallet->walletDetails()->first()->number, -4) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">CVV</p>
                        <p class="text-lg font-semibold text-gray-900">***</p>
                    </div>
                </div>
            @else
                <p class="text-gray-500">No card details available. Add your card below.</p>
            @endif
        </div>
    </div>

    <!-- Add Balance Form -->
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Add Balance to Wallet</h3>

        <form action="{{ route('wallet.addBalance') }}" method="POST" class="max-w-md">
            @csrf

            <!-- Amount Field -->
            <div class="mb-6">
                <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">
                    Amount (BDT Tk)
                </label>
                <input 
                    type="number" 
                    id="amount" 
                    name="amount" 
                    min="1"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none transition @error('amount') border-red-500 @enderror"
                    placeholder="Enter amount"
                    required
                >
                @error('amount')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Card Number Field -->
            <div class="mb-6">
                <label for="card_number" class="block text-sm font-semibold text-gray-700 mb-2">
                    Card Number
                </label>
                <input 
                    type="text" 
                    id="card_number" 
                    name="card_number" 
                    maxlength="16"
                    value="{{ $wallet->walletDetails()->first()->number ?? '' }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none transition @error('card_number') border-red-500 @enderror"
                    placeholder="1234567890123456"
                    required
                >
                @error('card_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- CVV Field -->
            <div class="mb-6">
                <label for="cvv" class="block text-sm font-semibold text-gray-700 mb-2">
                    CVV
                </label>
                <input 
                    type="text" 
                    id="cvv" 
                    name="cvv" 
                    maxlength="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none transition @error('cvv') border-red-500 @enderror"
                    placeholder="123"
                    required
                >
                @error('cvv')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2"
            >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
                </svg>
                Add Balance
            </button>
        </form>

        <!-- Security Notice -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg flex gap-3">
            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-blue-900">Your payment information is secure</p>
                <p class="text-sm text-blue-700 mt-1">We encrypt all card details and never store CVV for security.</p>
            </div>
        </div>
    </div>
</div>
@endsection
