@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Page Header & Search -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 md:mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-4 md:mb-0">📋 Pending User Registrations</h1>
            <form method="GET" action="{{ route('admin.pending-users.index') }}" class="flex w-full md:w-1/3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name..."
                       class="w-full px-4 py-2 rounded-l-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700 transition">
                    Search
                </button>
            </form>
        </div>

        <!-- Table Card -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
            <table class="w-full text-sm text-gray-700">
                <thead class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-sm uppercase tracking-wide sticky top-0 z-10">
                <tr>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Designation</th>
                    <th class="py-3 px-6 text-left">Division</th>
                    <th class="py-3 px-6 text-left">Section</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($pendingUsers as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-6 font-medium text-gray-900">
                            {{ $user->firstname }} {{ $user->lastname }}
                        </td>
                        <td class="py-3 px-6">{{ $user->designationRelation->description ?? 'N/A' }}</td>
                        <td class="py-3 px-6">{{ $user->divisionRelation->description ?? 'N/A' }}</td>
                        <td class="py-3 px-6">{{ $user->sectionRelation->description ?? 'N/A' }}</td>
                        <td class="py-3 px-6 text-center space-x-2">
                            <form action="{{ route('admin.pending-users.approve', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to approve this user?')"
                                        class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                                    ✅ Approve
                                </button>
                            </form>
                            <form action="{{ route('admin.pending-users.reject', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to reject this user?')"
                                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                                    ❌ Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 px-6 text-center text-gray-500 text-sm">
                            🚫 No pending users found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $pendingUsers->appends(['search' => request('search')])->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
