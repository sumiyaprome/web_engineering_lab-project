@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div>
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Manage Users</h1>
        <p class="text-gray-600 mt-2">View and manage system users</p>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">ID</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Username</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Verified</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-600">#{{ $user->id }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->username }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($user->verified)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">✓ Verified</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">✗ Unverified</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="text-sky-500 hover:text-sky-600 font-semibold">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection