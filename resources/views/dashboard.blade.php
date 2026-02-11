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
// Page View Line Chart
const ctxPage = document.getElementById('pageViewChart').getContext('2d');
new Chart(ctxPage, {
    type: 'line',
    data: {
        labels: ['Aug 1', 'Aug 2', 'Aug 3', 'Aug 4', 'Aug 5', 'Aug 6', 'Aug 7'],
        datasets: [{
            label: 'Views',
            data: [4000, 5000, 3500, 3000, 4500, 6000, 7000],
            backgroundColor: 'rgba(59, 130, 246, 0.2)',
            borderColor: 'rgba(59, 130, 246, 1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Sessions by Device Donut Chart
const ctxDevice = document.getElementById('deviceChart').getContext('2d');
new Chart(ctxDevice, {
    type: 'doughnut',
    data: {
        labels: ['Desktop', 'Mobile', 'Tablet'],
        datasets: [{
            data: [50, 30, 20],
            backgroundColor: ['rgba(59, 130, 246, 0.7)', 'rgba(34, 197, 94, 0.7)',
                'rgba(234, 179, 8, 0.7)'
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