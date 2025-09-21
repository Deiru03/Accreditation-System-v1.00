<x-iqa-layout>
    <div class="px-6 py-6">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-blue-800">Users</h1>
                <p class="text-sm text-gray-500">Manage system users, roles and access.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('users.create') }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium px-4 py-2 rounded-md shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add User
                </a>
            </div>
        </div>

        <!-- Filters / Search -->
        <form method="GET" action="{{ url()->current() }}" class="bg-white rounded-md border border-gray-200 p-4 mb-6 shadow-sm">
            <div class="flex flex-col md:flex-row gap-4 md:items-end">
                <div class="flex-1">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Search</label>
                    <input name="q" value="{{ request('q') }}" type="text" placeholder="Name or email..."
                           class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Role</label>
                    <select name="role" class="rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">All</option>
                        <option value="admin" @selected(request('role')==='admin')>Admin</option>
                        <option value="manager" @selected(request('role')==='manager')>Manager</option>
                        <option value="user" @selected(request('role')==='user')>User</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                    <select name="status" class="rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">All</option>
                        <option value="active" @selected(request('status')==='active')>Active</option>
                        <option value="inactive" @selected(request('status')==='inactive')>Inactive</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                            class="h-10 px-4 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium rounded-md">
                        Apply
                    </button>
                    <a href="{{ url()->current() }}" class="h-10 px-4 flex items-center text-sm font-medium rounded-md border border-gray-300 hover:bg-gray-50">
                        Reset
                    </a>
                </div>
            </div>
        </form>

        <!-- Users Table -->
        <div class="bg-white border border-gray-200 rounded-md shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-blue-700 text-white text-xs uppercase tracking-wide">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">#</th>
                            <th class="px-4 py-3 text-left font-semibold">Name</th>
                            <th class="px-4 py-3 text-left font-semibold">Email</th>
                            <th class="px-4 py-3 text-left font-semibold">Role</th>
                            <th class="px-4 py-3 text-left font-semibold">Created</th>
                            <th class="px-4 py-3 text-left font-semibold">Status</th>
                            <th class="px-4 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users ?? [] as $user)
                            <tr class="hover:bg-blue-50/40">
                                <td class="px-4 py-3 text-gray-500">{{ ($users->firstItem() ?? 1) + $loop->index }}</td>
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    <div>{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500">ID: {{ $user->id }}</div>
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                        @class([
                                            'bg-blue-100 text-blue-700' => $user->role === 'admin',
                                            'bg-indigo-100 text-indigo-700' => $user->role === 'manager',
                                            'bg-gray-100 text-gray-700' => !in_array($user->role, ['admin','manager']),
                                        ])">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    {{ $user->created_at?->format('Y-m-d') }}
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $active = $user->status === 'active' || ($user->is_active ?? false);
                                    @endphp
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium
                                        {{ $active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $active ? 'bg-green-600' : 'bg-red-600' }}"></span>
                                        {{ $active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('users.show', $user) }}" class="text-blue-700 hover:text-blue-900 hover:underline">View</a>
                                        <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-800 hover:underline">Edit</a>
                                        <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 hover:underline">Del</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center text-gray-500">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($users) && method_exists($users, 'links'))
                <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                    {{ $users->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</x-iqa-layout>