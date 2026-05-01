@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
<div>
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">All Orders</h1>
        <p class="text-gray-600 mt-2">Track and manage customer orders</p>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Order ID</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Customer</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Total</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Date</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">#{{ $order->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $order->customer->name }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">BDT Tk {{ $order->total }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">{{ $order->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $order->date->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4 text-sm space-y-2">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center px-3 py-1.5 rounded-md bg-slate-800 text-white text-sm hover:bg-slate-900">View</a>
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex flex-col gap-2">
                                    @csrf
                                    <select name="status" class="rounded-md border-gray-300 text-sm text-gray-900">
                                        <option value="Yet to be delivered" {{ $order->status === 'Yet to be delivered' ? 'selected' : '' }}>Yet to be delivered</option>
                                        <option value="Accepted" {{ $order->status === 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="Delivered" {{ $order->status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="Cancelled by Customer" {{ $order->status === 'Cancelled by Customer' ? 'selected' : '' }}>Cancelled by Customer</option>
                                        <option value="Cancelled" {{ $order->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="inline-flex justify-center px-3 py-1.5 rounded-md bg-green-600 text-white text-sm hover:bg-green-700">Update</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection