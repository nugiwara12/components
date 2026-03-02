<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <!-- Card -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between mb-4">
            <!-- Left: Title -->
            <div class="text-left">
                <x-search-input id="searchInput" placeholder="Search users" class="w-full sm:w-full" autocomplete="off" />
            </div>

            <!-- Right: Button -->
            <div class="text-right">
                <x-primary-button onclick="openAddUser()">
                    Add User
                </x-primary-button>
            </div>
        </div>

        <!-- Scrollable Table -->
        <div id="scrollContainer" class="max-h-[730px] overflow-y-auto rounded">
            <div class="min-w-[1024px]">
                <table id="userTable" class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-600 uppercase sticky top-0 z-10">
                        <tr class="whitespace-nowrap">
                            <th class="px-6 py-6">Employee ID</th>
                            <th class="px-6 py-6">Full Name</th>
                            <th class="px-6 py-6">Email Address</th>
                            <th class="px-6 py-6">Role</th>
                            <th class="px-6 py-6">Mobile Number</th>
                            <th class="px-6 py-6">Join Date</th>
                            <th class="px-6 py-6">Status</th>
                            <th class="text-center px-6 py-6">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-gray-200">
                        <!-- Rows inserted via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="pagination" class="bg-white p-2 rounded-lg shadow border-t-2 text-sm"></div>
</div>
