@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div>
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}! 👋</h1>
        <p class="text-gray-600 mt-2">Your food ordering system is ready to use</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-sky-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Orders</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['total_orders'] ?? 0 }}</p>
                </div>
                <svg class="w-12 h-12 text-sky-100" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1h7.586a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM5 16a2 2 0 11-4 0 2 2 0 014 0zm12 0a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Wallet Balance</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">BDT Tk {{ $stats['wallet_balance'] ?? '0' }}</p>
                </div>
                <svg class="w-12 h-12 text-green-100" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Open Tickets</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['open_tickets'] ?? 0 }}</p>
                </div>
                <svg class="w-12 h-12 text-orange-100" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Spent</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">BDT Tk {{ $stats['total_spent'] ?? '0' }}</p>
                </div>
                <svg class="w-12 h-12 text-purple-100" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Main Features -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Browse Menu Card -->
        <div class="bg-gradient-to-br from-sky-50 to-blue-50 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-8 flex flex-col justify-between h-full">
                <div>
                    <div class="w-12 h-12 bg-sky-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1h7.586a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM5 16a2 2 0 11-4 0 2 2 0 014 0zm12 0a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Browse Menu</h3>
                    <p class="text-gray-600">Explore our delicious collection of food items and place your order</p>
                </div>
                <a href="{{ route('menu.index') }}" class="inline-block mt-6 bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                    View Menu →
                </a>
            </div>
        </div>

        <!-- Your Orders Card -->
        <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-8 flex flex-col justify-between h-full">
                <div>
                    <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000-2 4 4 0 00-4 4v10a4 4 0 004 4h12a4 4 0 004-4V5a4 4 0 00-4-4 1 1 0 000 2 2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Your Orders</h3>
                    <p class="text-gray-600">Track and manage all your food orders in one place</p>
                </div>
                <a href="{{ route('orders.index') }}" class="inline-block mt-6 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                    View Orders →
                </a>
            </div>
        </div>

        <!-- Wallet Card -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-8 flex flex-col justify-between h-full">
                <div>
                    <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Wallet</h3>
                    <p class="text-gray-600">Add funds and manage your wallet balance securely</p>
                </div>
                <a href="{{ route('wallet.show') }}" class="inline-block mt-6 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                    View Wallet →
                </a>
            </div>
        </div>

        <!-- Support Card -->
        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-8 flex flex-col justify-between h-full">
                <div>
                    <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Support</h3>
                    <p class="text-gray-600">Contact our support team and get help when you need it</p>
                </div>
                <a href="{{ route('tickets.index') }}" class="inline-block mt-6 bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                    Contact Support →
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
