@extends('layouts.app')

@section('title', 'Manage Items')

@section('content')
<div>
    <!-- Header -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Manage Menu Items</h1>
            <p class="text-gray-600 mt-2">Add, edit, or remove items from your menu</p>
        </div>
        <a href="{{ route('admin.items.create') }}" class="bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add New Item
        </a>
    </div>

    <!-- Items Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Desktop View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">ID</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Item Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Price</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">#{{ $item->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item->name }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">BDT Tk {{ $item->price }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($item->deleted)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        Deleted
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm flex gap-2">
                                <a href="{{ route('admin.items.edit', $item->id) }}" class="text-blue-500 hover:text-blue-600 font-semibold transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 font-semibold transition-colors" onclick="return confirm('Are you sure you want to delete this item?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile View -->
        <div class="md:hidden space-y-4 p-4">
            @foreach($items as $item)
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="font-bold text-lg text-gray-900">{{ $item->name }}</h3>
                        @if($item->deleted)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                Deleted
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                Active
                            </span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 mb-4"><span class="font-semibold">Price:</span> BDT Tk {{ $item->price }}</p>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.items.edit', $item->id) }}" class="text-blue-500 hover:text-blue-600 font-semibold text-sm">Edit</a>
                        <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600 font-semibold text-sm" onclick="return confirm('Delete item?')">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection