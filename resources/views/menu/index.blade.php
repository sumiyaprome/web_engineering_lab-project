@extends('layouts.app')

@section('title', 'Menu')

@section('content')
<div>
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Our Menu</h1>
        <p class="text-gray-600 mt-2">Choose your favorite items and place your order</p>
    </div>

    <!-- Menu Items Grid -->
    @forelse($items as $item)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="bg-gradient-to-r from-blue-400 to-sky-400 h-48 flex items-center justify-center">
                    <svg class="w-24 h-24 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4V5h12v10z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->name }}</h3>
                    <div class="flex items-baseline gap-1 mb-4">
                        <span class="text-2xl font-bold text-sky-500">BDT Tk {{ $item->price }}</span>
                        <span class="text-gray-500 text-sm">per item</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Delicious and fresh item prepared with care</p>
                    <a href="{{ route('menu.show', $item->id) }}" class="inline-block w-full text-center bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                        View Details
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.5 2a1.5 1.5 0 00-1.5 1.5v14A1.5 1.5 0 004.5 19h11a1.5 1.5 0 001.5-1.5V3.5A1.5 1.5 0 0015.5 2h-11zm11 18H4.5A2.5 2.5 0 012 16.5V3.5A2.5 2.5 0 014.5 1h11A2.5 2.5 0 0118 3.5v13A2.5 2.5 0 0115.5 20z" clip-rule="evenodd"/>
            </svg>
            <p class="text-gray-600 text-lg">No items available at the moment.</p>
            <p class="text-gray-500 text-sm mt-1">Please check back later</p>
        </div>
    @endforelse

    <!-- Pagination -->
    @if($items && method_exists($items, 'links'))
        <div class="mt-8 flex justify-center">
            {{ $items->links() }}
        </div>
    @endif
</div>

<!-- Floating Action Button -->
<a href="{{ route('orders.create') }}" class="fixed bottom-8 right-8 bg-sky-500 hover:bg-sky-600 text-white rounded-full w-16 h-16 flex items-center justify-center shadow-lg hover:shadow-xl transition-all">
    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1h7.586a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM5 16a2 2 0 11-4 0 2 2 0 014 0zm12 0a2 2 0 11-4 0 2 2 0 014 0z"/>
    </svg>
</a>
@endsection
