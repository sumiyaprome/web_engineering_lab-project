@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
        <p class="text-gray-600 mt-2">Customer: {{ $order->customer->name }} &middot; {{ $order->customer->email }}</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-900">Order Summary</h2>
            <div class="mt-4 space-y-3 text-sm text-gray-700">
                <div class="flex justify-between">
                    <span>Order Date</span>
                    <span>{{ $order->date->format('Y-m-d H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Status</span>
                    <span class="font-semibold">{{ $order->status }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Total</span>
                    <span class="font-semibold">BDT Tk {{ $order->total }}</span>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-900">Update Status</h3>
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mt-3 space-y-3">
                    @csrf
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                        <option value="Yet to be delivered" {{ $order->status === 'Yet to be delivered' ? 'selected' : '' }}>Yet to be delivered</option>
                        <option value="Accepted" {{ $order->status === 'Accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="Delivered" {{ $order->status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="Cancelled by Customer" {{ $order->status === 'Cancelled by Customer' ? 'selected' : '' }}>Cancelled by Customer</option>
                        <option value="Cancelled" {{ $order->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="inline-flex items-center justify-center rounded-md bg-slate-800 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-900">Save Status</button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-900">Items</h2>
            <div class="mt-4 space-y-4">
                @foreach($order->orderDetails as $detail)
                    <div class="rounded-xl border border-gray-200 p-4">
                        <div class="flex justify-between items-start gap-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $detail->item->name }}</h3>
                                <p class="text-sm text-gray-600">Quantity: {{ $detail->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600">Unit Price</p>
                                <p class="text-base font-semibold text-gray-900">BDT Tk {{ $detail->price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-slate-800 text-white hover:bg-slate-900">Back to Orders</a>
    </div>
</div>
@endsection
