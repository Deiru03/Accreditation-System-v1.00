<div x-show="showEditModal" 
     class="fixed inset-0 z-50 overflow-y-auto" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    
    <!-- Modal backdrop -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" @click="showEditModal = false"></div>
    
    <!-- Modal container -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative transform overflow-hidden rounded-lg bg-white shadow-xl transition-all sm:w-full sm:max-w-2xl"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            
            <!-- Modal header -->
            <div class="bg-blue-700 px-4 py-3 flex items-center justify-between">
                <h3 class="text-lg font-medium text-white">Edit User</h3>
                <button type="button" @click="showEditModal = false" class="text-white hover:text-gray-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Modal content -->
            <div class="px-4 py-5 sm:p-6">
                <form method="POST" :action="`/i-users/${selectedUser.id}`">
                    @csrf
                    @method('PATCH') <!-- Ensure the form uses PATCH -->
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="first_name" id="first_name" x-model="selectedUser.first_name" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="last_name" id="last_name" x-model="selectedUser.last_name" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>

                        <!-- Middle Name -->
                        <div>
                            <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name" x-model="selectedUser.middle_name"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" x-model="selectedUser.email" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>

                        <!-- Employee ID -->
                        <div>
                            <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee ID</label>
                            <input type="text" name="employee_id" id="employee_id" x-model="selectedUser.employee_id"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" x-model="selectedUser.phone_number"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>

                        <!-- Address -->
                        <div class="sm:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <textarea name="address" id="address" x-model="selectedUser.address" rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="user_type" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="user_type" id="user_type" x-model="selectedUser.user_type" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                {{-- <option value="admin">Admin</option> --}}
                                <option value="iqa">IQA</option>
                                <option value="validator">Validator</option>
                                <option value="accreditor">Accreditor</option>
                                <option value="uploader">Uploader</option>
                                {{-- <option value="user">User</option> --}}
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" x-model="selectedUser.status" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="inactive">Inactive</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" @click="showEditModal = false"
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-800">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>