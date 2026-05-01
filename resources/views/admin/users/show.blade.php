@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">User Profile</h1>
        <p class="text-gray-600 mt-2">Review user account details and perform admin actions.</p>
    </div>

    <div class="max-w-4xl bg-white rounded-xl shadow-md p-6">
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Name</h2>
                <p class="mt-2 text-gray-700">{{ $user->name }}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Email</h2>
                <p class="mt-2 text-gray-700">{{ $user->email }}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Contact</h2>
                <p class="mt-2 text-gray-700">{{ $user->contact }}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Role</h2>
                <p class="mt-2 text-gray-700">{{ $user->role }}</p>
            </div>
        </div>

        <div class="mt-8 space-y-4">
            @if($user->role !== 'Administrator')
                <form action="{{ route('admin.users.verify', $user->id) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="rounded-md bg-sky-700 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-800">Verify User</button>
                </form>
            @endif

            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline-block">
                @csrf
                <button type="submit" class="rounded-md bg-rose-600 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-700">Delete User</button>
            </form>
        </div>

        <div class="mt-8">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-slate-800 text-white hover:bg-slate-900">Back to Users</a>
        </div>
    </div>
</div>
@endsection
