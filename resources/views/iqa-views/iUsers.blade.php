<!-- filepath: c:\xampp\htdocs\clients-project\Accreditation-Web-v1\resources\views\iqa-views\iUsers.blade.php -->
<x-iqa-layout>
    <div class="px-6 py-6" x-data="{ 
        open: false, 
        showUserModal: false,
        showEditModal: false,
        selectedUser: {} 
        }">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-blue-800">Users</h1>
                <p class="text-sm text-gray-500">Manage system users, roles and access.</p>
            </div>
            <div class="flex gap-2">
                <!-- Add User Button -->
                <button type="button" 
                        @click="open = true" 
                        class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium px-4 py-2 rounded-md shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add User
                </button>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filters / Search -->
        <form method="GET" action="{{ route('iqa.users.index') }}" class="bg-white rounded-md border border-gray-200 p-4 mb-6 shadow-sm">
            <div class="flex flex-col md:flex-row gap-4 md:items-end">
                <div class="flex-1">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Search</label>
                    <input name="q" value="{{ request('q') }}" type="text" placeholder="Name or email..."
                           class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Role</label>
                    <select name="user_type" class="rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">All</option>
                        <option value="admin" @selected(request('user_type')==='admin')>Admin</option>
                        <option value="iqa" @selected(request('user_type')==='iqa')>IQA</option>
                        <option value="validator" @selected(request('user_type')==='validator')>Validator</option>
                        <option value="accreditor" @selected(request('user_type')==='accreditor')>Accreditor</option>
                        <option value="uploader" @selected(request('user_type')==='uploader')>Uploader</option>
                        <option value="user" @selected(request('user_type')==='user')>User</option>
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
                    <a href="{{ route('iqa.users.index') }}" class="h-10 px-4 flex items-center text-sm font-medium rounded-md border border-gray-300 hover:bg-gray-50">
                        Reset
                    </a>
                </div>
            </div>
        </form>

        <!-- Users Table -->
        <div class="bg-white border border-gray-200 rounded-md shadow-sm overflow-hidden">
            @if(isset($users) && $users->count() > 0)
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
                            @foreach($users as $index => $user)
                                @php
                                    // Calculate row number for pagination
                                    $rowNumber = method_exists($users, 'firstItem')
                                        ? $users->firstItem() + $index
                                        : $index + 1;

                                    // Get user display name - using actual database fields
                                    $userName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
                                    if (empty($userName)) {
                                        $userName = $user->name ?? $user->email ?? 'Unknown User';
                                    }

                                    // Get user role - using actual database field
                                    $userRole = $user->user_type ?? 'user';

                                    // Get user status - using actual database field
                                    $isActive = $user->status === 'active';
                                @endphp

                                <tr class="hover:bg-blue-50/40 cursor-pointer"
                                    onclick="window.location.href='{{ route('iqa.users.show', $user) }}'">
                                    <td class="px-4 py-3 text-gray-500 text-xs">{{ $rowNumber }}</td>

                                    <td class="px-4 py-3 font-medium text-gray-800">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xs mr-3">
                                                {{ strtoupper(substr($userName, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="text-sm">{{ $userName }}</div>
                                                <div class="text-xs text-gray-500">ID: {{ $user->id }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-gray-700 text-xs max-w-[200px] break-words">
                                        {{ $user->email }}
                                    </td>

                                    <td class="px-4 py-3 text-xs">
                                        @php
                                            $roleColors = [
                                                'admin' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700'],
                                                'iqa' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700'],
                                                'validator' => ['bg' => 'bg-green-100', 'text' => 'text-green-700'],
                                                'accreditor' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-700'],
                                                'uploader' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700'],
                                            ];

                                            $bgColor = $roleColors[$userRole]['bg'] ?? 'bg-gray-100';
                                            $textColor = $roleColors[$userRole]['text'] ?? 'text-gray-700';
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $bgColor }} {{ $textColor }}">
                                            {{ ucfirst($userRole) }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-gray-600 text-xs">
                                        {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}
                                    </td>

                                    <td class="px-4 py-3 text-xs">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium
                                            {{ $isActive ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $isActive ? 'bg-green-600' : 'bg-red-600' }}"></span>
                                            {{ $isActive ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-xs" onclick="event.stopPropagation()">
                                        <div class="flex justify-end gap-3">
                                            <button type="button"
                                                    @click="showUserModal = true; selectedUser = {{ $user->toJson() }}"
                                                    class="text-blue-700 hover:text-blue-900 hover:underline flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </button>

                                            <a href="javascript:void(0)"
                                                @click="showEditModal = true; selectedUser = {{ $user->toJson() }}"
                                                class="text-indigo-600 hover:text-indigo-800 hover:underline flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>

                                            <form method="POST" action="{{ route('iqa.users.destroy', $user) }}"
                                                  onsubmit="return confirm('Are you sure you want to delete this user?');"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 hover:underline flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(method_exists($users, 'hasPages') && $users->hasPages())
                    <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                        {{ $users->withQueryString()->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="px-4 py-10 text-center text-gray-500">
                    <div class="flex flex-col items-center gap-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                        </svg>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">No users found</h3>
                            <p class="text-gray-500 mb-4">Get started by creating your first user.</p>
                            <a href="{{ route('iqa.users.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create your first user
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Create User Modal -->
        @include('components.iqa.user.create-form')
        <!-- View User Modal -->
        @include('components.iqa.user.show-form')
        <!-- Edit User Modal -->
        @include('components.iqa.user.edit-form')
    </div>      
</x-iqa-layout>
