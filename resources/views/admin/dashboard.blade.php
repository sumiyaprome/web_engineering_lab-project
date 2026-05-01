@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div>
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Admin Dashboard</h1>
        <p class="text-gray-600 mt-2">Managing your food ordering system with complete control</p>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-blue-500">
            <div class="flex jsutify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_users'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">Active users</p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 12a6 6 0 11-12 0 6 6 0 0112 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-green-500">
            <div class="flex jsutify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Orders</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_orders'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">All time orders</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1h7.586a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM5 16a2 2 0 11-4 0 2 2 0 014 0zm12 0a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Items -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-orange-500">
            <div class="flex jsutify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Items</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_items'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">Menu items</p>
                </div>
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Open Tickets -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-purple-500">
            <div class="flex jsutify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Open Tickets</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['open_tickets'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">Pending support</p>
                </div>
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-cyan-500">
            <div class="flex jsutify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Revenue</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">BDT Tk {{ $stats['total_revenue'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">All time</p>
                </div>
                <div class="w-10 h-10 bg-cyan-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Manage Orders -->
            <a href="{{ route('admin.orders.index') }}" class="group relative overflow-hidden bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 text-center">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                <div class="relative">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1h7.586a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM5 16a2 2 0 11-4 0 2 2 0 014 0zm12 0a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Manage Orders</h3>
                    <p class="text-xs text-gray-500 mt-1">View and update orders</p>
                </div>
            </a>

            <!-- Manage Items -->
            <a href="{{ route('admin.items.index') }}" class="group relative overflow-hidden bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 text-center">
                <div class="absolute inset-0 bg-gradient-to-r from-orange-500 to-orange-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                <div class="relative">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-orange-200 transition-colors">
                        <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-orange-600 transition-colors">Manage Items</h3>
                    <p class="text-xs text-gray-500 mt-1">Add and edit menu items</p>
                </div>
            </a>

            <!-- Manage Users -->
            <a href="{{ route('admin.users.index') }}" class="group relative overflow-hidden bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 text-center">
                <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-green-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                <div class="relative">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 12a6 6 0 11-12 0 6 6 0 0112 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors">Manage Users</h3>
                    <p class="text-xs text-gray-500 mt-1">View all users</p>
                </div>
            </a>

            <!-- View Tickets -->
            <a href="{{ route('admin.tickets.index') }}" class="group relative overflow-hidden bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 text-center">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-purple-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                <div class="relative">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-200 transition-colors">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-purple-600 transition-colors">View Tickets</h3>
                    <p class="text-xs text-gray-500 mt-1">Support tickets</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
