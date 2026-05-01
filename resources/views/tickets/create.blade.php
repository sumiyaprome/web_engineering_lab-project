@extends('layouts.app')

@section('title', 'Create Support Ticket')

@section('content')
<div class="row">
    <div class="col s12 m8 offset-m2">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Create Support Ticket</span>
                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf
                    
                    <div class="input-field">
                        <input type="text" id="subject" name="subject" required>
                        <label for="subject">Subject</label>
                    </div>
                    
                    <div class="input-field">
                        <textarea id="description" name="description" class="materialize-textarea" required></textarea>
                        <label for="description">Description</label>
                    </div>
                    
                    <div class="input-field">
                        <select name="type" required>
                            <option value="">Select Type</option>
                            <option value="Support">Support</option>
                            <option value="Complaint">Complaint</option>
                            <option value="Others">Others</option>
                        </select>
                        <label>Ticket Type</label>
                    </div>
                    
                    <button class="btn cyan" type="submit">Create Ticket</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection