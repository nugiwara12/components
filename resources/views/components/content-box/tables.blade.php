<div class="space-y-4 whitespace-nowrap">

    <!-- Top Row: Leaves & Payments -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- Leaves -->
        <div class="bg-white border rounded-xl shadow p-4 flex flex-col h-full">
            <h2 class="text-lg font-semibold mb-4">Leaves</h2>
            <div class="overflow-x-auto flex-1 mb-4">
                <table class="w-full text-left table-auto">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2">Leave ID</th>
                            <th class="pb-2">Employee</th>
                            <th class="pb-2">Type</th>
                            <th class="pb-2">Start Date</th>
                            <th class="pb-2">End Date</th>
                            <th class="pb-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2 text-blue-600">#LV-001</td>
                            <td>Juan Dela Cruz</td>
                            <td>Vacation</td>
                            <td>01 Mar 2026</td>
                            <td>05 Mar 2026</td>
                            <td><span class="px-2 py-1 rounded text-xs bg-green-100 text-green-700">Approved</span></td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 text-blue-600">#LV-002</td>
                            <td>Maria Santos</td>
                            <td>Sick</td>
                            <td>10 Feb 2026</td>
                            <td>12 Feb 2026</td>
                            <td><span class="px-2 py-1 rounded text-xs bg-yellow-100 text-yellow-700">Pending</span></td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 text-blue-600">#LV-003</td>
                            <td>Carlos Reyes</td>
                            <td>Emergency</td>
                            <td>23 Jan 2026</td>
                            <td>24 Jan 2026</td>
                            <td><span class="px-2 py-1 rounded text-xs bg-red-100 text-red-700">Declined</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-auto text-blue-600 cursor-pointer">View all leaves</div>
        </div>

        <!-- Payments -->
        <div class="bg-white border rounded-xl shadow p-4 flex flex-col h-full">
            <h2 class="text-lg font-semibold mb-4">Payments</h2>
            <div class="overflow-x-auto flex-1 mb-4">
                <table class="w-full text-left table-auto">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2">Invoice ID</th>
                            <th class="pb-2">Client</th>
                            <th class="pb-2">Payment Type</th>
                            <th class="pb-2">Paid Date</th>
                            <th class="pb-2">Paid Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2 text-blue-600">#INV-0001</td>
                            <td>Global Technologies</td>
                            <td>Paypal</td>
                            <td>11 Mar 2019</td>
                            <td>$380</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 text-blue-600">#INV-0002</td>
                            <td>Delta Infotech</td>
                            <td>Paypal</td>
                            <td>8 Feb 2019</td>
                            <td>$500</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 text-blue-600">#INV-0003</td>
                            <td>Cream Inc</td>
                            <td>Paypal</td>
                            <td>23 Jan 2019</td>
                            <td>$60</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-auto text-blue-600 cursor-pointer">View all payments</div>
        </div>
    </div>

    <!-- Bottom Row: Clients & Recent Projects -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- Clients -->
        <div class="bg-white border rounded-xl shadow p-4 flex flex-col h-full">
            <h2 class="text-lg font-semibold mb-4">Clients</h2>

            <!-- Responsive table wrapper -->
            <div class="overflow-x-auto flex-1">
                <table class="w-full min-w-[600px] text-left table-auto">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2 text-sm md:text-base">Name</th>
                            <th class="pb-2 text-sm md:text-base">Email</th>
                            <th class="pb-2 text-sm md:text-base">Status</th>
                            <th class="pb-2 text-sm md:text-base">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/30?img=1" class="w-8 h-8 rounded-full" />
                                Barry Cuda
                            </td>
                            <td class="py-4 text-sm md:text-base">barrycuda@example.com</td>
                            <td class="py-4 text-sm md:text-base"><span class="text-green-600 font-medium">Active</span></td>
                            <td class="py-4 text-sm md:text-base">•••</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/30?img=2" class="w-8 h-8 rounded-full" />
                                Tressa Wexler
                            </td>
                            <td class="py-4 text-sm md:text-base">tressawexler@example.com</td>
                            <td class="py-4 text-sm md:text-base"><span class="text-red-600 font-medium">Inactive</span></td>
                            <td class="py-4 text-sm md:text-base">•••</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/30?img=3" class="w-8 h-8 rounded-full" />
                                Ruby Bartlett
                            </td>
                            <td class="py-4 text-sm md:text-base">rubybartlett@example.com</td>
                            <td class="py-4 text-sm md:text-base"><span class="text-red-600 font-medium">Inactive</span></td>
                            <td class="py-4 text-sm md:text-base">•••</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/30?img=4" class="w-8 h-8 rounded-full" />
                                Misty Tison
                            </td>
                            <td class="py-4 text-sm md:text-base">mistytison@example.com</td>
                            <td class="py-4 text-sm md:text-base"><span class="text-green-600 font-medium">Active</span></td>
                            <td class="py-4 text-sm md:text-base">•••</td>
                        </tr>
                        <tr>
                            <td class="py-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/30?img=5" class="w-8 h-8 rounded-full" />
                                Daniel Deacon
                            </td>
                            <td class="py-4 text-sm md:text-base">danieldeacon@example.com</td>
                            <td class="py-4 text-sm md:text-base"><span class="text-red-600 font-medium">Inactive</span></td>
                            <td class="py-4 text-sm md:text-base">•••</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Bottom link -->
            <div class="text-center mt-auto text-blue-600 cursor-pointer">View all clients</div>
        </div>

        <!-- Recent Projects -->
        <div class="bg-white border rounded-xl shadow p-4 flex flex-col h-full">
            <h2 class="text-lg font-semibold mb-4">Recent Projects</h2>
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left table-auto">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2 text-sm md:text-base">Project Name</th>
                            <th class="pb-2 text-sm md:text-base">Progress</th>
                            <th class="pb-2 text-sm md:text-base text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-3">Office Management<br><span class="text-xs text-gray-500">1 open tasks, 9 tasks completed</span></td>
                            <td class="py-3">
                                <div class="w-full bg-gray-200 h-2 rounded-full">
                                    <div class="bg-blue-600 h-2 rounded-full w-20"></div>
                                </div>
                            </td>
                            <td class="py-3 text-center">•••</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3">Project Management<br><span class="text-xs text-gray-500">2 open tasks, 5 tasks completed</span></td>
                            <td class="py-3">
                                <div class="w-full bg-gray-200 h-2 rounded-full">
                                    <div class="bg-blue-600 h-2 rounded-full w-14"></div>
                                </div>
                            </td>
                            <td class="py-3 text-center">•••</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3">Video Calling App<br><span class="text-xs text-gray-500">3 open tasks, 3 tasks completed</span></td>
                            <td class="py-3">
                                <div class="w-full bg-gray-200 h-2 rounded-full">
                                    <div class="bg-blue-600 h-2 rounded-full w-16"></div>
                                </div>
                            </td>
                            <td class="py-3 text-center">•••</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3">Hospital Administration<br><span class="text-xs text-gray-500">12 open tasks, 4 tasks completed</span></td>
                            <td class="py-3">
                                <div class="w-full bg-gray-200 h-2 rounded-full">
                                    <div class="bg-blue-600 h-2 rounded-full w-24"></div>
                                </div>
                            </td>
                            <td class="py-3 text-center">•••</td>
                        </tr>
                        <tr>
                            <td class="py-3">Digital Marketplace<br><span class="text-xs text-gray-500">7 open tasks, 14 tasks completed</span></td>
                            <td class="py-3">
                                <div class="w-full bg-gray-200 h-2 rounded-full">
                                    <div class="bg-blue-600 h-2 rounded-full w-28"></div>
                                </div>
                            </td>
                            <td class="py-3 text-center">•••</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-auto text-blue-600 cursor-pointer">View all projects</div>
        </div>
    </div>
</div>