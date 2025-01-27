<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Search Box -->
                    <form action="{{ route('admin.users.index') }}" method="GET" class="mb-4">
                        <input type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}" class="border rounded p-2">
                        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded">Search</button>
                    </form>

                    <!-- Users Table -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($user->active)
                                            <span class="px-2 py-1 text-sm text-green-600 bg-green-100 rounded-full">Active</span>
                                        @else
                                            <span class="px-2 py-1 text-sm text-red-600 bg-red-100 rounded-full">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                        @if ($user->active)
                                            <form action="{{ route('admin.users.deactivate', $user) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Deactivate</button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.reactivate', $user) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-500 hover:text-green-700 ml-2">Reactivate</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>