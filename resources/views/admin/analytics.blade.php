<x-app-layout>

    <x-section class="py-12 bg-gray-50 dark:bg-gray-900">
        <x-container>

            <!-- HEADER -->
            <div class="mb-10 text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                    Analytics Overview
                </h1>
                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Track usage, growth, and activity
                </p>
            </div>

            <!-- STATS -->
            <div class="grid md:grid-cols-3 gap-6 mb-12">

                <!-- Uploads -->
                <x-card class="p-6 rounded-2xl border border-gray-100 dark:border-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Uploads</p>
                    <h2 class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">
                        {{ $totalUploads }}
                    </h2>
                </x-card>

                <!-- Downloads -->
                <x-card class="p-6 rounded-2xl border border-gray-100 dark:border-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Downloads</p>
                    <h2 class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">
                        {{ $totalDownloads }}
                    </h2>
                </x-card>

                <!-- Active Users -->
                <x-card class="p-6 rounded-2xl border border-gray-100 dark:border-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Active Users (7 days)</p>
                    <h2 class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">
                        {{ $activeUsers }}
                    </h2>
                </x-card>

                <!-- Storage -->
                <x-card class="p-6 rounded-2xl border border-gray-100 dark:border-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Storage Used</p>

                    <h2 class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">
                        {{ number_format($totalStorage / 1024 / 1024, 2) }} MB
                    </h2>
                </x-card>

            </div>

        </x-container>
    </x-section>

    <x-section>
        <x-container>

            <x-card class="p-6 my-10 rounded-2xl border border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Uploads & Downloads Over Time
                </h3>

                <div class="h-80">
                    <canvas id="activityChart"></canvas>
                </div>
            </x-card>

        </x-container>
    </x-section>


    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('activityChart');

        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($uploadLabels),

                    datasets: [
                        {
                            label: 'Uploads',
                            data: @json($uploadCounts),
                            tension: 0.3,
                            fill: false,
                        },
                        {
                            label: 'Downloads',
                            data: @json($downloadCounts),
                            tension: 0.3,
                            fill: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        }
    </script>

</x-app-layout>