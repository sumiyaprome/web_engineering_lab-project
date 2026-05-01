@extends('layouts.app')

@section('title', 'Place Order')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-sky-600">Fresh order</p>
            <h1 class="mt-2 text-3xl font-bold text-gray-900 md:text-4xl">Place a New Order</h1>
            <p class="mt-2 max-w-2xl text-gray-600">Choose your items, confirm the delivery details, and send your order to the kitchen.</p>
        </div>
        <a href="{{ route('menu.index') }}" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50">
            Back to Menu
        </a>
    </div>

    <form action="{{ route('orders.store') }}" method="POST" id="orderForm" class="grid grid-cols-1 gap-6 lg:grid-cols-[minmax(0,1fr)_360px]">
        @csrf

        <div class="space-y-6">
            <section class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm md:p-6">
                <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Select Items</h2>
                        <p class="text-sm text-gray-500">Add one or more menu items to your order.</p>
                    </div>
                    <button type="button" onclick="addItem()" class="inline-flex items-center justify-center rounded-lg bg-sky-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-sky-600">
                        Add Item
                    </button>
                </div>

                <div id="itemsContainer" class="space-y-3">
                    <div class="item-row rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-[minmax(0,1fr)_140px_96px] md:items-end">
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-gray-700">Menu item</label>
                                <select name="items[0][id]" class="item-select w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 shadow-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100" required>
                                    <option value="" data-price="0">Select an item</option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }} - BDT Tk {{ number_format($item->price, 2) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-gray-700">Quantity</label>
                                <input type="number" name="items[0][quantity]" value="1" min="1" class="quantity-input w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 shadow-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100" required>
                            </div>
                            <button type="button" onclick="removeItem(this)" class="remove-item inline-flex h-10 items-center justify-center rounded-lg border border-red-200 bg-white px-3 text-sm font-semibold text-red-600 transition hover:bg-red-50">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <section class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm md:p-6">
                <div class="mb-5">
                    <h2 class="text-xl font-bold text-gray-900">Delivery Details</h2>
                    <p class="text-sm text-gray-500">We will use this information to deliver your food.</p>
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="address" class="mb-2 block text-sm font-semibold text-gray-700">Delivery address</label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            value="{{ auth()->user()->address ?? '' }}"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-sky-500 focus:ring-2 focus:ring-sky-100"
                            placeholder="House, road, area, city"
                            required
                        >
                    </div>

                    <div>
                        <label for="description" class="mb-2 block text-sm font-semibold text-gray-700">Additional notes</label>
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-sky-500 focus:ring-2 focus:ring-sky-100"
                            placeholder="Any delivery instructions or food preferences"
                        ></textarea>
                    </div>

                    <div>
                        <p class="mb-3 text-sm font-semibold text-gray-700">Payment method</p>
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <label class="flex cursor-pointer items-center gap-3 rounded-lg border border-gray-200 bg-white p-4 transition hover:border-sky-300 hover:bg-sky-50">
                                <input type="radio" name="payment_type" value="Wallet" class="h-4 w-4 text-sky-500 focus:ring-sky-500" checked required>
                                <span>
                                    <span class="block font-semibold text-gray-900">Wallet</span>
                                    <span class="block text-sm text-gray-500">Pay from your balance</span>
                                </span>
                            </label>
                            <label class="flex cursor-pointer items-center gap-3 rounded-lg border border-gray-200 bg-white p-4 transition hover:border-sky-300 hover:bg-sky-50">
                                <input type="radio" name="payment_type" value="Cash On Delivery" class="h-4 w-4 text-sky-500 focus:ring-sky-500" required>
                                <span>
                                    <span class="block font-semibold text-gray-900">Cash on Delivery</span>
                                    <span class="block text-sm text-gray-500">Pay when food arrives</span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <aside class="lg:sticky lg:top-24 lg:self-start">
            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm md:p-6">
                <h2 class="text-xl font-bold text-gray-900">Order Summary</h2>
                <div class="mt-5 space-y-4 text-sm">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                        <span class="text-gray-500">Selected items</span>
                        <span id="itemCount" class="font-semibold text-gray-900">0</span>
                    </div>
                    <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                        <span class="text-gray-500">Total quantity</span>
                        <span id="totalQuantity" class="font-semibold text-gray-900">0</span>
                    </div>
                    <div class="flex items-end justify-between">
                        <span class="text-gray-500">Estimated total</span>
                        <span class="text-2xl font-bold text-sky-600">BDT Tk <span id="totalAmount">0.00</span></span>
                    </div>
                </div>

                <div class="mt-6 flex flex-col gap-3">
                    <button class="inline-flex w-full items-center justify-center rounded-lg bg-sky-500 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-sky-600" type="submit">
                        Place Order
                    </button>
                    <a href="{{ route('menu.index') }}" class="inline-flex w-full items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3 font-semibold text-gray-700 transition hover:bg-gray-50">
                        Cancel
                    </a>
                </div>
            </div>
        </aside>
    </form>
</div>
@endsection

@section('scripts')
@php
    $menuItems = $items->map(function ($item) {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'price' => (float) $item->price,
        ];
    })->values();
@endphp

<script>
    let nextItemIndex = 1;

    const menuItems = @json($menuItems);

    function escapeHtml(value) {
        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function renderItemOptions() {
        const options = ['<option value="" data-price="0">Select an item</option>'];

        menuItems.forEach((item) => {
            options.push(
                `<option value="${item.id}" data-price="${item.price}">${escapeHtml(item.name)} - BDT Tk ${Number(item.price).toFixed(2)}</option>`
            );
        });

        return options.join('');
    }

    function addItem() {
        const container = document.getElementById('itemsContainer');
        const row = document.createElement('div');
        row.className = 'item-row rounded-lg border border-gray-200 bg-gray-50 p-4';
        row.innerHTML = `
            <div class="grid grid-cols-1 gap-4 md:grid-cols-[minmax(0,1fr)_140px_96px] md:items-end">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Menu item</label>
                    <select name="items[${nextItemIndex}][id]" class="item-select w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 shadow-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100" required>
                        ${renderItemOptions()}
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Quantity</label>
                    <input type="number" name="items[${nextItemIndex}][quantity]" value="1" min="1" class="quantity-input w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 shadow-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100" required>
                </div>
                <button type="button" onclick="removeItem(this)" class="remove-item inline-flex h-10 items-center justify-center rounded-lg border border-red-200 bg-white px-3 text-sm font-semibold text-red-600 transition hover:bg-red-50">
                    Remove
                </button>
            </div>
        `;
        container.appendChild(row);
        nextItemIndex++;
        updateSummary();
    }

    function removeItem(button) {
        const rows = document.querySelectorAll('.item-row');
        if (rows.length > 1) {
            button.closest('.item-row').remove();
            updateSummary();
        }
    }

    function updateSummary() {
        const rows = document.querySelectorAll('.item-row');
        let selectedItems = 0;
        let totalQuantity = 0;
        let totalAmount = 0;

        rows.forEach((row) => {
            const select = row.querySelector('.item-select');
            const quantityInput = row.querySelector('.quantity-input');
            const quantity = Math.max(parseInt(quantityInput.value || '0', 10), 0);
            const price = parseFloat(select.options[select.selectedIndex]?.dataset.price || '0');

            if (select.value) {
                selectedItems++;
                totalQuantity += quantity;
                totalAmount += price * quantity;
            }
        });

        document.getElementById('itemCount').textContent = selectedItems;
        document.getElementById('totalQuantity').textContent = totalQuantity;
        document.getElementById('totalAmount').textContent = totalAmount.toFixed(2);
    }

    document.getElementById('orderForm').addEventListener('change', updateSummary);
    document.getElementById('orderForm').addEventListener('input', updateSummary);
    updateSummary();
</script>
@endsection
