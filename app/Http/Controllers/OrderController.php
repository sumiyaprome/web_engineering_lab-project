<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Show all orders for customer
     */
    public function index()
    {
        $orders = Order::where('customer_id', Auth::id())
            ->where('deleted', false)
            ->orderBy('date', 'desc')
            ->paginate(10);
        
        return view('orders.index', compact('orders'));
    }

    /**
     * Show order details
     */
    public function show($id)
    {
        $order = Order::with('orderDetails.item')
            ->where('id', $id)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }

    /**
     * Show place order form
     */
    public function create()
    {
        $items = Item::where('deleted', false)->get();
        return view('orders.create', compact('items'));
    }

    /**
     * Store order
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:300',
            'description' => 'nullable|string|max:300',
            'payment_type' => 'required|in:Wallet,Cash On Delivery',
            'items' => 'required|array',
            'items.*.id' => 'required|numeric|exists:items,id',
            'items.*.quantity' => 'required|numeric|min:1',
        ]);

        $total = 0;
        
        // Calculate total
        foreach ($request->items as $item) {
            $itemData = Item::find($item['id']);
            $total += $itemData->price * $item['quantity'];
        }

        // Create order
        $order = Order::create([
            'customer_id' => Auth::id(),
            'address' => $request->address,
            'description' => $request->description,
            'payment_type' => $request->payment_type,
            'total' => $total,
            'status' => 'Yet to be delivered',
        ]);

        // Create order details
        foreach ($request->items as $item) {
            $itemData = Item::find($item['id']);
            OrderDetail::create([
                'order_id' => $order->id,
                'item_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $itemData->price * $item['quantity'],
            ]);
        }

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    /**
     * Cancel order
     */
    public function cancel($id)
    {
        $order = Order::where('id', $id)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        $order->update(['status' => 'Cancelled by Customer', 'deleted' => true]);

        return back()->with('success', 'Order cancelled!');
    }

    /**
     * Show all orders (Admin)
     */
    public function adminIndex()
    {
        if (Auth::user()->role !== 'Administrator') {
            abort(403);
        }

        $orders = Order::with('customer')
            ->where('deleted', false)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show order details (Admin)
     */
    public function adminShow($id)
    {
        if (Auth::user()->role !== 'Administrator') {
            abort(403);
        }

        $order = Order::with('customer', 'orderDetails.item')
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status (Admin)
     */
    public function updateStatus(Request $request, $id)
    {
        if (Auth::user()->role !== 'Administrator') {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Yet to be delivered,Accepted,Delivered,Cancelled by Customer,Cancelled',
        ]);

        Order::findOrFail($id)->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated!');
    }
}
