<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Statistics -->
    <div class="bg-white border rounded-xl shadow-sm p-5">
        <h2 class="text-lg font-semibold mb-4">Statistics</h2>

        <!-- Item -->
        <div class="space-y-8">

            <!-- Today Leave -->
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>Today Leave</span>
                    <span class="font-medium">4 / 65</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-red-500 h-2 rounded-full" style="width: 35%"></div>
                </div>
            </div>

            <!-- Pending Leaves -->
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>Pending Leaves</span>
                    <span class="font-medium">15 / 92</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 40%"></div>
                </div>
            </div>

            <!-- Completed Projects -->
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>Completed Projects</span>
                    <span class="font-medium">85 / 112</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: 75%"></div>
                </div>
            </div>

            <!-- Open Tickets -->
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>Open Tickets</span>
                    <span class="font-medium">190 / 212</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-red-500 h-2 rounded-full" style="width: 80%"></div>
                </div>
            </div>

            <!-- Closed Tickets -->
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>Closed Tickets</span>
                    <span class="font-medium">22 / 212</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full" style="width: 20%"></div>
                </div>
            </div>

        </div>
    </div>

    <!-- Task Statistics -->
    <div class="bg-white border rounded-xl shadow-sm p-5">

        <h2 class="text-lg font-semibold mb-4">Task Statistics</h2>

        <!-- Top Stats -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="border rounded-lg p-2 text-center">
                <p class="text-sm text-gray-500">Total Tasks</p>
                <h3 class="text-2xl font-bold">385</h3>
            </div>

            <div class="border rounded-lg p-2 text-center">
                <p class="text-sm text-gray-500">Overdue Tasks</p>
                <h3 class="text-2xl font-bold">19</h3>
            </div>
        </div>

        <!-- Timeline Progress Line -->
        <div class="relative w-full mb-6">

            <!-- Gray background line -->
            <div class="absolute top-2 left-0 w-full h-2 bg-gray-200 rounded-full"></div>

            <!-- Colored progress line -->
            <div class="absolute top-2 left-0 w-full h-2 rounded-full overflow-hidden flex">
                <div class="bg-purple-500 w-[30%]"></div>
                <div class="bg-yellow-500 w-[22%]"></div>
                <div class="bg-green-500 w-[24%]"></div>
                <div class="bg-red-500 w-[21%]"></div>
                <div class="bg-blue-500 w-[10%]"></div>
            </div>

            <!-- Timeline dots -->
            <div class="relative flex justify-between">
                <div class="w-5 h-5 bg-purple-500 rounded-full border-4 border-white shadow"></div>
                <div class="w-5 h-5 bg-yellow-500 rounded-full border-4 border-white shadow"></div>
                <div class="w-5 h-5 bg-green-500 rounded-full border-4 border-white shadow"></div>
                <div class="w-5 h-5 bg-red-500 rounded-full border-4 border-white shadow"></div>
                <div class="w-5 h-5 bg-blue-500 rounded-full border-4 border-white shadow"></div>
            </div>
        </div>

        <!-- Legend (UNCHANGED DESCRIPTION) -->
        <div class="space-y-2 text-sm">

            <div class="flex justify-between items-center">
                <span class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-purple-500 rounded-full"></span>
                    Completed Tasks
                </span>
                <span class="flex items-center gap-3">
                    <span class="font-medium">166</span>
                    <span class="font-medium">-</span>
                    <span class="text-gray-700">30%</span>
                </span>
            </div>

            <div class="flex justify-between items-center">
                <span class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-yellow-500 rounded-full"></span>
                    Inprogress Tasks
                </span>
                <span class="flex items-center gap-3">
                    <span class="font-medium">115</span>
                    <span class="font-medium">-</span>
                    <span class="text-gray-700">22%</span>
                </span>
            </div>

            <div class="flex justify-between items-center">
                <span class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                    On Hold Tasks
                </span>
                <span class="flex items-center gap-3">
                    <span class="font-medium">31</span>
                    <span class="font-medium">-</span>
                    <span class="text-gray-700">24%</span>
                </span>
            </div>

            <div class="flex justify-between items-center">
                <span class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                    Pending Tasks
                </span>
                <span class="flex items-center gap-3">
                    <span class="font-medium">47</span>
                    <span class="font-medium">-</span>
                    <span class="text-gray-700">21%</span>
                </span>
            </div>

            <div class="flex justify-between items-center">
                <span class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                    Review Tasks
                </span>
                <span class="flex items-center gap-3">
                    <span class="font-medium">5</span>
                    <span class="font-medium">-</span>
                    <span class="text-gray-700">10%</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Today Absent -->
    <div class="bg-white border rounded-xl shadow-sm p-5">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Today Absent</h2>
            <span class="bg-red-200 text-red-600 text-md px-3 py-2 rounded-full">5</span>
        </div>

        <div class="space-y-3">
            <!-- User -->
            <div class="border rounded-lg p-3 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                    <div class="flex flex-col">
                        <span class="font-medium">Martin Lewis</span>
                        <span class="text-xs text-gray-500">4 Sep 2019</span>
                        <span class="text-xs text-gray-400">Leave Date</span>
                    </div>
                </div>
                <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded">
                    Pending
                </span>
            </div>

            <!-- User -->
            <div class="border rounded-lg p-3 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                    <div class="flex flex-col">
                        <span class="font-medium">Martin Lewis</span>
                        <span class="text-xs text-gray-500">4 Sep 2019</span>
                        <span class="text-xs text-gray-400">Leave Date</span>
                    </div>
                </div>
                <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded">
                    Approved
                </span>
            </div>
        </div>
        <button class="mt-4 w-full border rounded-lg py-2 hover:bg-gray-50">
            Load More
        </button>
    </div>
</div>