@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Edit Menu Item</h1>
        <p class="text-gray-600 mt-2">Update menu details for customers.</p>
    </div>

    <div class="max-w-3xl bg-white rounded-xl shadow-md p-6">
        <form action="{{ route('admin.items.update', $item->id) }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $item->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" value="{{ old('price', $item->price) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" step="0.01" min="0" required>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="inline-flex items-center justify-center rounded-md bg-slate-800 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-900">Update Item</button>
                <a href="{{ route('admin.items.index') }}" class="text-slate-600 hover:text-slate-900">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
