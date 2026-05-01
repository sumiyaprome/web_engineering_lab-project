@extends('layouts.app')

@section('title', 'Support Tickets')

@section('content')
<div class="row">
    <div class="col s12">
        <h3>Support Tickets</h3>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>#{{ $ticket->id }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>{{ $ticket->poster->name }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ $ticket->type }}</td>
                        <td><a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn-flat cyan-text">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection