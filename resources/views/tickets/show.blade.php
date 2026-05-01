@extends('layouts.app')

@section('title', 'Ticket #' . $ticket->id)

@section('content')
<div class="row">
    <div class="col s12 m8">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Ticket #{{ $ticket->id }}</span>
                <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
                <p><strong>Status:</strong> <span class="badge">{{ $ticket->status }}</span></p>
                <p><strong>Type:</strong> {{ $ticket->type }}</p>
                <p><strong>Date:</strong> {{ $ticket->date->format('Y-m-d H:i:s') }}</p>
            </div>
        </div>
        
        <div class="card">
            <div class="card-content">
                <span class="card-title">Messages</span>
                @foreach($ticket->ticketDetails as $detail)
                    <div style="margin-bottom: 20px; padding: 10px; background-color: #f5f5f5;">
                        <p><strong>{{ $detail->user->name }}</strong> - {{ $detail->date->format('Y-m-d H:i:s') }}</p>
                        <p>{{ $detail->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        
        @if($ticket->status !== 'Closed')
        <div class="card">
            <div class="card-content">
                <span class="card-title">Reply</span>
                <form action="{{ route('tickets.reply', $ticket->id) }}" method="POST">
                    @csrf
                    <div class="input-field">
                        <textarea id="description" name="description" class="materialize-textarea" required></textarea>
                        <label for="description">Your Message</label>
                    </div>
                    <button class="btn cyan" type="submit">Send Reply</button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection