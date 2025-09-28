<div x-show="showUserModal" 
    class="fixed inset-0 z-50 overflow-y-auto" 
    style="display: none;"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    
    <!-- Modal backdrop -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" @click="showUserModal = false"></div>
    
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
             <h3 class="text-lg font-medium text-white">User Details</h3>
             <button type="button" @click="showUserModal = false" class="text-white hover:text-gray-200">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
             </button>
          </div>
          
          <!-- Modal content -->
          <div class="px-6 py-5 sm:p-6">
             <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                <!-- Name -->
                <div>
                    <h3 class="text-sm font-medium text-gray-600">Name</h3>
                    <p class="text-lg font-semibold text-gray-800" x-text="`${selectedUser.first_name} ${selectedUser.middle_name || ''} ${selectedUser.last_name}`"></p>
                </div>

                <!-- Email -->
                <div>
                    <h3 class="text-sm font-medium text-gray-600">Email</h3>
                    <p class="text-lg font-semibold text-gray-800" x-text="selectedUser.email"></p>
                </div>

                <!-- Employee ID -->
                <div>
                    <h3 class="text-sm font-medium text-gray-600">Employee ID</h3>
                    <p class="text-lg font-semibold text-gray-800" x-text="selectedUser.employee_id || 'N/A'"></p>
                </div>

                <!-- Phone Number -->
                <div>
                    <h3 class="text-sm font-medium text-gray-600">Phone Number</h3>
                    <p class="text-lg font-semibold text-gray-800" x-text="selectedUser.phone_number || 'N/A'"></p>
                </div>

                <!-- Address -->
                <div class="sm:col-span-2">
                    <h3 class="text-sm font-medium text-gray-600">Address</h3>
                    <p class="text-lg font-semibold text-gray-800" x-text="selectedUser.address || 'N/A'"></p>
                </div>

                <!-- Role -->
                <div>
                    <h3 class="text-sm font-medium text-gray-600">Role</h3>
                    <p class="text-lg font-semibold text-gray-800" x-text="selectedUser.user_type.toUpperCase()"></p>
                </div>

                <!-- Status -->
                <div>
                    <h3 class="text-sm font-medium text-gray-600">Status</h3>
                    <p class="text-lg font-semibold" :class="selectedUser.status === 'active' ? 'text-green-600' : 'text-red-600'" x-text="selectedUser.status"></p>
                </div>

                <!-- Created At -->
                <div>
                    <h3 class="text-sm font-medium text-gray-600">Created At</h3>
                    <p class="text-sm font-medium text-gray-500">
                       <span x-text="new Date(selectedUser.created_at).toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' })"></span>
                       at
                       <span x-text="new Date(selectedUser.created_at).toLocaleTimeString(undefined, { hour: '2-digit', minute: '2-digit' })"></span>
                    </p>
                </div>

                <!-- Updated At -->
                <div>
                    <h3 class="text-sm font-medium text-gray-600">Last Updated</h3>
                    <p class="text-sm font-medium text-gray-500">
                       <span x-text="new Date(selectedUser.updated_at).toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' })"></span>
                       at
                       <span x-text="new Date(selectedUser.updated_at).toLocaleTimeString(undefined, { hour: '2-digit', minute: '2-digit' })"></span>
                    </p>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>