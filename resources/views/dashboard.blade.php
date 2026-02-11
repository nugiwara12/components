<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="w-full mx-auto">
            <x-content-box.panel />
            <x-content-box.chart />
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const totalEmployees = 1254;
    const presentCounts = [1120, 1100, 1150, 1110, 1130, 1080, 1090];

    // Calculate percentages as numbers
    const presentPercent = presentCounts.map(count => Number(((count / totalEmployees) * 100).toFixed(1)));
    const absentPercent = presentPercent.map(p => Number((100 - p).toFixed(1)));

    // Employee Attendance Line Chart (with percentages)
    const ctxAttendance = document.getElementById('attendanceChart').getContext('2d');
    new Chart(ctxAttendance, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [
                {
                    label: 'Present (75%)',
                    data: presentPercent, // now numbers
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                },
                {
                    label: 'Absent (25%)',
                    data: absentPercent, // now numbers
                    backgroundColor: 'rgba(239, 68, 68, 0.2)',
                    borderColor: 'rgba(239, 68, 68, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const datasetLabel = context.dataset.label;
                            const value = context.raw;
                            const count = datasetLabel === "Present (%)" 
                                ? presentCounts[context.dataIndex] 
                                : totalEmployees - presentCounts[context.dataIndex];
                            return `${datasetLabel}: ${value}% (${count} employees)`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: { display: true, text: 'Percentage (%)' }
                }
            }
        }
    });

    // Leave Status Donut Chart
    const ctxLeave = document.getElementById('leaveChart').getContext('2d');
    new Chart(ctxLeave, {
        type: 'doughnut',
        data: {
            labels: ['Approved', 'Pending', 'Rejected'],
            datasets: [{
                data: [50, 30, 20],
                backgroundColor: [
                    'rgba(34, 197, 94, 0.7)',   // green - approved
                    'rgba(59, 130, 246, 0.7)',  // blue - pending
                    'rgba(239, 68, 68, 0.7)'    // red - rejected
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
