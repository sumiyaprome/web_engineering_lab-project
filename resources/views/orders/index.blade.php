@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div>
    <!-- Header -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">My Orders</h1>
            <p class="text-gray-600 mt-2">Track and manage all your food orders</p>
        </div>
        <a href="{{ route('orders.create') }}" class="bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-12-4h8m-8 3h8M4.5 4.5h0m0 3h0m0 3h0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Place New Order
        </a>
    </div>

    <!-- Orders Table/List -->
    @if($orders->count())
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Order ID</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Date</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Total</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Payment Type</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $order->date->format('Y-m-d H:i') }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">BDT Tk {{ $order->total }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $order->payment_type }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($order->status === 'Yet to be delivered')
                                        <span class="inline-flex items-center gap-2 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                                            <span class="w-2 h-2 bg-yellow-600 rounded-full"></span>
                                            {{ $order->status }}
                                        </span>
                                    @elseif($order->status === 'Delivered')
                                        <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                            <span class="w-2 h-2 bg-green-600 rounded-full"></span>
                                            {{ $order->status }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                                            <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                            {{ $order->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('orders.show', $order->id) }}" class="text-sky-500 hover:text-sky-600 font-semibold transition-colors">View Details →</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4 p-4">
                @foreach($orders as $order)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-lg text-gray-900">Order #{{ $order->id }}</h3>
                            @if($order->status === 'Yet to be delivered')
                                <span class="inline-flex items-center gap-2 px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                                    <span class="w-2 h-2 bg-yellow-600 rounded-full"></span>
                                    {{ $order->status }}
                                </span>
                            @elseif($order->status === 'Delivered')
                                <span class="inline-flex items-center gap-2 px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                    <span class="w-2 h-2 bg-green-600 rounded-full"></span>
                                    {{ $order->status }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                    {{ $order->status }}
                                </span>
                            @endif
                        </div>
                        <div class="space-y-2 mb-4 text-sm text-gray-600">
                            <p><span class="font-semibold">Date:</span> {{ $order->date->format('Y-m-d H:i') }}</p>
                            <p><span class="font-semibold">Total:</span> BDT Tk {{ $order->total }}</p>
                            <p><span class="font-semibold">Payment:</span> {{ $order->payment_type }}</p>
                        </div>
                        <a href="{{ route('orders.show', $order->id) }}" class="text-sky-500 hover:text-sky-600 font-semibold">View Details →</a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        @if(method_exists($orders, 'links'))
            <div class="mt-8 flex justify-center">
                {{ $orders->links() }}
            </div>
        @endif
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1h7.586a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM5 16a2 2 0 11-4 0 2 2 0 014 0zm12 0a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <p class="text-gray-600 text-lg mb-2">No orders yet</p>
            <p class="text-gray-500 text-sm mb-6">You haven't placed any orders yet.</p>
            <a href="{{ route('menu.index') }}" class="inline-block bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                Start Ordering Now
            </a>
        </div>
    @endif
</div>
@endsection
