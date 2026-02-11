<div class="w-full px-4 sm:px-6 lg:px-8 space-y-6">

    <!-- Main grid: charts and cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Employee Attendance Chart -->
        <div class="bg-white p-4 rounded-lg shadow flex flex-col">
            <h2 class="text-lg font-semibold mb-2 text-gray-700">Employee Attendance</h2>
            <div class="flex-1">
                <canvas id="attendanceChart" class="w-full h-56"></canvas>
            </div>
            <div class="mt-4 text-sm text-gray-500">Present vs Absent Employees</div>
        </div>

        <!-- Leave Status Chart -->
        <div class="bg-white p-4 rounded-lg shadow flex flex-col">
            <h2 class="text-lg font-semibold mb-2 text-gray-700">Leave Status</h2>
            <div class="flex-1">
                <canvas id="leaveChart" class="w-full h-56"></canvas>
            </div>
            <div class="mt-4 text-sm text-gray-500">Approved vs Pending Leaves</div>
        </div>

        <!-- Combined Employee Card -->
        <div class="bg-white p-4 rounded-lg shadow flex flex-col space-y-4">
            <div>
                <h2 class="text-lg font-semibold mb-2 text-gray-700">Top Performing Employees</h2>
                <ul class="text-gray-600 text-sm space-y-1">
                    <li class="flex justify-between">
                        <span>John Christoper</span>
                        <span>95%</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Maria Santos</span>
                        <span>92%</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Alex Reyes</span>
                        <span>90%</span>
                    </li>
                </ul>
            </div>

            <hr class="border-t border-gray-200" />

            <div>
                <h2 class="text-lg font-semibold mb-2 text-gray-700">Most Active Departments</h2>
                <ul class="text-gray-600 text-sm space-y-1">
                    <li class="flex justify-between">
                        <span>Sales</span>
                        <span>41 / 50 tasks</span>
                    </li>
                    <li class="flex justify-between">
                        <span>HR</span>
                        <span>38 / 45 tasks</span>
                    </li>
                    <li class="flex justify-between">
                        <span>IT Support</span>
                        <span>32 / 40 tasks</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
