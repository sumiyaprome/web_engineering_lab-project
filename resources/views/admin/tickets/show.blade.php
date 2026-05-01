@extends('layouts.app')

@section('title', 'Ticket Details')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Ticket #{{ $ticket->id }}</h1>
        <p class="text-gray-600 mt-2">Issue submitted by {{ $ticket->customer->name }}.</p>
    </div>

    <div class="max-w-4xl bg-white rounded-xl shadow-md p-6 space-y-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Subject</h2>
            <p class="mt-2 text-gray-700">{{ $ticket->subject }}</p>
        </div>
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Message</h2>
            <p class="mt-2 text-gray-700">{{ $ticket->message }}</p>
        </div>
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Status</h2>
                <p class="mt-2 text-gray-700">{{ $ticket->status }}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Submitted</h2>
                <p class="mt-2 text-gray-700">{{ $ticket->created_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-6">
            <h2 class="text-lg font-semibold text-gray-900">Reply</h2>
            <form action="{{ route('admin.tickets.reply', $ticket->id) }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <textarea name="message" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" required>{{ old('message') }}</textarea>
                <button type="submit" class="inline-flex items-center rounded-md bg-sky-700 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-800">Send Reply</button>
            </form>
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.tickets.index') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-slate-800 text-white hover:bg-slate-900">Back to Tickets</a>
        </div>
    </div>
</div>
@endsection
