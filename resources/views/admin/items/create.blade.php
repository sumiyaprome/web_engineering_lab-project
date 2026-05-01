@extends('layouts.app')

@section('title', 'Add New Item')

@section('content')
<div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Add Menu Item</span>
                <form action="{{ route('admin.items.store') }}" method="POST">
                    @csrf
                    <div class="input-field">
                        <input type="text" id="name" name="name" required>
                        <label for="name">Item Name</label>
                    </div>
                    <div class="input-field">
                        <input type="number" id="price" name="price" step="0.01" required>
                        <label for="price">Price</label>
                    </div>
                    <button class="btn cyan" type="submit">Create Item</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection