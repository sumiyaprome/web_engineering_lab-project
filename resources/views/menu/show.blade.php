@extends('layouts.app')

@section('title', $item->name)

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('menu.index') }}" class="inline-flex items-center gap-2 text-sky-500 hover:text-sky-600 font-semibold">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
            Back to Menu
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Item Image -->
        <div class="bg-gradient-to-r from-blue-500 to-sky-500 h-64 flex items-center justify-center">
            <svg class="w-32 h-32 text-white opacity-40" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4V5h12v10z" clip-rule="evenodd"/>
            </svg>
        </div>

        <!-- Item Details -->
        <div class="p-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $item->name }}</h1>

            <!-- Price Section -->
            <div class="mb-6 p-4 bg-sky-50 rounded-lg border border-sky-200">
                <p class="text-gray-600 text-sm mb-1">Price per item</p>
                <p class="text-4xl font-bold text-sky-600">BDT Tk {{ $item->price }}</p>
            </div>

            <!-- Description -->
            <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                This is a delicious menu item available in our food ordering system. Prepared with fresh ingredients and care to ensure the highest quality for our valued customers.
            </p>

            <!-- Features -->
            <div class="grid grid-cols-3 gap-4 mb-8">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <svg class="w-8 h-8 text-green-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm font-semibold text-gray-900">Fresh</p>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <svg class="w-8 h-8 text-orange-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L11 9.414V13H8.5z"/>
                    </svg>
                    <p class="text-sm font-semibold text-gray-900">Quality</p>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <svg class="w-8 h-8 text-red-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.866 8.573a1.5 1.5 0 011.735-.578l.231-.52a2.632 2.632 0 013.554-1.117 2.632 2.632 0 013.894-.825 2.632 2.632 0 014.35.667c.048.099.099.183.151.261.768-.141 1.477.083 2.056.654.645.645.78 1.693.27 2.513C17.652 11.5 16.227 14.46 14 16.234V9a2 2 0 00-2-2h-3a2 2 0 00-2 2v7.234c-2.227-1.773-3.652-4.734-3.957-6.662.511-.82.375-1.868-.27-2.513a2.122 2.122 0 00-1.82-.464zM4 7.5a.5.5 0 01.5-.5H5a.5.5 0 010 1h-.5a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm font-semibold text-gray-900">Tasty</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4">
                <a href="{{ route('orders.create') }}" class="flex-1 bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 px-4 rounded-lg transition-colors text-center flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1h7.586a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM5 16a2 2 0 11-4 0 2 2 0 014 0zm12 0a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Order This Item
                </a>
            </div>
        </div>
    </div>
</div>
@endsection