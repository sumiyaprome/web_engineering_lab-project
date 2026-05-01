@extends('layouts.app')

@section('title', 'Order #' . $order->id)

@section('content')
<div class="row">
    <div class="col s12">
        <h3>Order #{{ $order->id }}</h3>
    </div>
</div>

<div class="row">
    <div class="col s12 m6">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Order Details</span>
                <p><strong>Date:</strong> {{ $order->date->format('Y-m-d H:i:s') }}</p>
                <p><strong>Status:</strong> <span class="badge @if($order->status === 'Yet to be delivered') orange @elseif($order->status === 'Delivered') green @else red @endif white-text">{{ $order->status }}</span></p>
                <p><strong>Payment Type:</strong> {{ $order->payment_type }}</p>
                <p><strong>Address:</strong> {{ $order->address }}</p>
                <p><strong>Description:</strong> {{ $order->description ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Order Summary</span>
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetails as $detail)
                            <tr>
                                <td>{{ $detail->item->name }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>BDT Tk {{ $detail->price }}</td>
                            </tr>
                        @endforeach
                        <tr style="border-top: 2px solid #ccc;">
                            <td colspan="2"><strong>Total:</strong></td>
                            <td><strong>BDT Tk {{ $order->total }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col s12">
        @if($order->status !== 'Cancelled by Customer')
            <a href="{{ route('orders.index') }}" class="btn cyan waves-effect">Back to Orders</a>
            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn red waves-effect" onclick="return confirm('Are you sure?')">Cancel Order</button>
            </form>
        @else
            <a href="{{ route('orders.index') }}" class="btn cyan waves-effect">Back to Orders</a>
        @endif
    </div>
</div>
@endsection
