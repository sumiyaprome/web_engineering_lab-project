@extends('layouts.app')

@section('title', 'Support Tickets')

@section('content')
<div>
    <!-- Header -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Support Tickets</h1>
            <p class="text-gray-600 mt-2">Track and manage your support requests</p>
        </div>
        <a href="{{ route('tickets.create') }}" class="bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create New Ticket
        </a>
    </div>

    <!-- Tickets List -->
    @if($tickets->count())
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Desktop View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Ticket ID</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Subject</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Type</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Date</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">#{{ $ticket->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $ticket->subject }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold 
                                        @if($ticket->status === 'Open') bg-blue-100 text-blue-800
                                        @elseif($ticket->status === 'In Progress') bg-yellow-100 text-yellow-800
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ $ticket->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $ticket->type }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $ticket->date->format('Y-m-d H:i') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('tickets.show', $ticket->id) }}" class="text-sky-500 hover:text-sky-600 font-semibold">View →</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile View -->
            <div class="md:hidden space-y-4 p-4">
                @foreach($tickets as $ticket)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-lg text-gray-900">#{{ $ticket->id }}</h3>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold 
                                @if($ticket->status === 'Open') bg-blue-100 text-blue-800
                                @elseif($ticket->status === 'In Progress') bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ $ticket->status }}
                            </span>
                        </div>
                        <p class="font-semibold text-gray-900 mb-2">{{ $ticket->subject }}</p>
                        <div class="space-y-1 mb-4 text-sm text-gray-600">
                            <p><span class="font-semibold">Type:</span> {{ $ticket->type }}</p>
                            <p><span class="font-semibold">Date:</span> {{ $ticket->date->format('Y-m-d H:i') }}</p>
                        </div>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="text-sky-500 hover:text-sky-600 font-semibold">View Details →</a>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0zm3 0a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
            </svg>
            <p class="text-gray-600 text-lg mb-2">No support tickets yet</p>
            <p class="text-gray-500 text-sm mb-6">You haven't created any support tickets.</p>
            <a href="{{ route('tickets.create') }}" class="inline-block bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                Create a Ticket
            </a>
        </div>
    @endif
</div>
@endsection
