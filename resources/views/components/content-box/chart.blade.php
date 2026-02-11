<div class="w-full px-4 sm:px-6 lg:px-8 space-y-6">

    <!-- Main grid: charts and cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Page View Line Chart -->
        <div class="bg-white p-4 rounded-lg shadow flex flex-col">
            <h2 class="text-lg font-semibold mb-2 text-gray-700">Page View</h2>
            <div class="flex-1">
                <canvas id="pageViewChart" class="w-full h-56"></canvas>
            </div>
        </div>

        <!-- Sessions by Device Donut Chart -->
        <div class="bg-white p-4 rounded-lg shadow flex flex-col">
            <h2 class="text-lg font-semibold mb-2 text-gray-700">Sessions by Device</h2>
            <div class="flex-1">
                <canvas id="deviceChart" class="w-full h-56"></canvas>
            </div>
        </div>

        <!-- Combined Card -->
        <div class="bg-white p-4 rounded-lg shadow flex flex-col space-y-4">

            <!-- Popular Post Section -->
            <div>
                <h2 class="text-lg font-semibold mb-2 text-gray-700">Popular Post</h2>
                <ul class="text-gray-600 text-sm space-y-1">
                    <li class="flex justify-between">
                        <span>Create an Admin Panel with Vue.js and Tailwind CSS</span>
                        <span>1,672</span>
                    </li>
                    <li class="flex justify-between">
                        <span>How To Center a Div</span>
                        <span>1,423</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Let's Star This Project</span>
                        <span>926</span>
                    </li>
                </ul>
            </div>

            <hr class="border-t border-gray-200" />

            <!-- Top Contributor Section -->
            <div>
                <h2 class="text-lg font-semibold mb-2 text-gray-700">Top Contributor</h2>
                <ul class="text-gray-600 text-sm space-y-1">
                    <li class="flex justify-between">
                        <span>Seto Kuslaksono</span>
                        <span>41 / 12</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Some Dude</span>
                        <span>22 / 15</span>
                    </li>
                    <li class="flex justify-between">
                        <span>It Could Be You</span>
                        <span>12 / 4</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
