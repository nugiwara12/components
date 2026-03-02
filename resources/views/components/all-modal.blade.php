<!-- Add User Modal -->
<div id="addUserModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-lg w-full max-w-2xl shadow-xl flex flex-col max-h-[70vh]">

        <!-- Header (fixed) -->
        <div class="p-6 border-b border-gray-200 flex-shrink-0">
            <h2 id="modalTitle" class="text-lg font-semibold uppercase text-gray-800 mb-2">Add New User</h2>
            <p class="text-sm text-gray-500">Fill in the details to create a new user account.</p>
        </div>

        <!-- Form Fields (scrollable) -->
        <div class="p-6 overflow-y-auto flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4">

            <!-- Name -->
            <div class="col-span-1">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block w-full mt-1" type="text" name="name" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Email -->
            <div class="col-span-1">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block w-full mt-1" type="email" name="email" required />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Mobile Number -->
            <div class="col-span-1">
                <x-input-label for="mobile_number" :value="__('Mobile Number')" />
                <x-text-input id="mobile_number" class="block w-full mt-1" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '')" type="text" name="mobile_number" required autofocus />
                <x-input-error :messages="$errors->get('mobile_number')" class="mt-1" />
            </div>

            <!-- Join Date -->
            <div class="col-span-1">
                <x-input-label for="join_date" :value="__('Join Date')" />
                <x-text-input id="join_date" class="block w-full mt-1" type="date" name="join_date" required autofocus />
                <x-input-error :messages="$errors->get('join_date')" class="mt-1" />
            </div>

            <!-- Role -->
            <div class="col-span-1">
                <x-input-label for="role" :value="__('Role')" />
                <x-text-select id="role" name="role" required>
                    <option value="">-- Select Role --</option>
                </x-text-select>
                <x-input-error :messages="$errors->get('role')" class="mt-1" />
            </div>

            <!-- Employee ID -->
            <div class="col-span-1">
                <x-input-label for="employee_id" :value="__('Employee ID')" />
                <x-text-input id="employee_id" class="block w-full mt-1 bg-gray-200 cursor-not-allowed" type="text" name="employee_id" readonly />
                <x-input-error :messages="$errors->get('employee_id')" class="mt-1" />
            </div>

            <!-- Password -->
            <div class="col-span-1">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div class="col-span-1">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>
        </div>

        <!-- Footer (fixed) -->
        <div class="p-6 border-t border-gray-200 flex justify-end gap-4 flex-shrink-0">
            <button onclick="closeModal('addUserModal')" class="border border-gray-400 text-gray-600 px-4 py-2 rounded-md text-sm">
                Cancel
            </button>
            <x-primary-button id="modalActionBtn" onclick="submitAddUser()">
                Add User
            </x-primary-button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md text-center shadow-lg">
        <h2 class="text-lg font-semibold uppercase text-gray-800 mb-4">Confirm Delete</h2>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this user?</p>
        <div class="flex justify-center gap-4">
            <button onclick="closeModal('deleteUserModal')" class="px-4 py-2 rounded-md border text-gray-700">Cancel</button>
            <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Delete</button>
        </div>
    </div>
</div>

