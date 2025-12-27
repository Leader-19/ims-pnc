<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';


withDefaults(defineProps<{
    stats?: {
        interns: number;
        companies: number;
        applications: number;
        accepted: number;
    };
}>(), {
    stats: () => ({
        interns: 0,
        companies: 0,
        applications: 0,
        accepted: 0,
    })
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

import { ref, onMounted } from 'vue';
import Chart from 'chart.js/auto';

// References for each chart
const barChartRef = ref<HTMLCanvasElement | null>(null);
const lineChartRef = ref<HTMLCanvasElement | null>(null);
const pieChartRef = ref<HTMLCanvasElement | null>(null);

onMounted(() => {
    // Bar Chart
    if (barChartRef.value) {
        new Chart(barChartRef.value, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [
                    {
                        label: 'Applications',
                        data: [10, 15, 8, 12, 20],
                        backgroundColor: '#3b82f6',
                    },
                    {
                        label: 'Accepted',
                        data: [5, 8, 4, 7, 10],
                        backgroundColor: '#10b981',
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Applications vs Accepted (Bar Chart)' },
                },
            },
        });
    }

    // Line Chart
    if (lineChartRef.value) {
        new Chart(lineChartRef.value, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [
                    {
                        label: 'Applications',
                        data: [10, 15, 8, 12, 20],
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59,130,246,0.2)',
                        fill: true,
                        tension: 0.4,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Applications Trend (Line Chart)' },
                },
            },
        });
    }

    // Pie Chart
    if (pieChartRef.value) {
        new Chart(pieChartRef.value, {
            type: 'pie',
            data: {
                labels: ['Pending', 'Accepted', 'Rejected'],
                datasets: [
                    {
                        label: 'Application Status',
                        data: [12, 7, 3],
                        backgroundColor: ['#facc15', '#10b981', '#ef4444'],
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Application Status Distribution (Pie Chart)' },
                },
            },
        });
    }
});
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-4">

            <!-- 📊 Stats Cards -->
            <div class="grid gap-4 md:grid-cols-4">
                <div class="p-4 rounded-2xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <h2 class="text-lg font-semibold">Total Interns</h2>
                    <p class="text-3xl font-bold mt-2">100</p>
                </div>

                <div class="p-4 rounded-2xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <h2 class="text-lg font-semibold">Companies</h2>
                    <p class="text-3xl font-bold mt-2">25</p>
                </div>

                <div class="p-4 rounded-2xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <h2 class="text-lg font-semibold">Applications</h2>
                    <p class="text-3xl font-bold mt-2">100</p>
                </div>

                <div class="p-4 rounded-2xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <h2 class="text-lg font-semibold">Accepted</h2>
                    <p class="text-3xl font-bold mt-2">50</p>
                </div>
            </div>

            <!-- Placeholder sections preserved -->
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <!-- add chart -->
                    <canvas ref="barChartRef"></canvas>
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <!-- add chart -->
                    <canvas ref="lineChartRef"></canvas>
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <!-- add chart -->
                    <canvas ref="pieChartRef"></canvas>
                </div>
            </div>

            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">


                <div
                    class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                    <table class="w-full text-sm text-left rtl:text-right text-body">
                        <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Student Name
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Company Name
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Start Date
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    End Date
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-neutral-primary border-b border-default">
                                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    Leader Din
                                </th>
                                <td class="px-6 py-4">
                                    Cambodai Airports
                                </td>
                                <td class="px-6 py-4">
                                    01-Sep-25
                                </td>
                                <td class="px-6 py-4">
                                    31-Dec-25
                                </td>
                                <td class="px-6 py-4">
                                    <button
                                        class="cursor-pointer px-3 py-2 text-xs mr-2 font-medium text-white bg-gray-700 rounded">
                                        Show
                                    </button>

                                    <button
                                        class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded">
                                        Edit
                                    </button>
                                    <button
                                        class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-red-500 rounded ml-2">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr class="bg-neutral-primary border-b border-default">
                                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    Bunny Chor
                                </th>
                                <td class="px-6 py-4">
                                    AMK Microfinance
                                </td>
                                <td class="px-6 py-4">
                                    01-Sep-25
                                </td>
                                <td class="px-6 py-4">
                                    31-Dec-25
                                </td>
                                <td class="px-6 py-4">
                                    <button
                                        class="cursor-pointer px-3 py-2 text-xs mr-2 font-medium text-white bg-gray-700 rounded">
                                        Show
                                    </button>

                                    <button
                                        class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded">
                                        Edit
                                    </button>
                                    <button
                                        class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-red-500 rounded ml-2">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <tr class="bg-neutral-primary border-b border-default">
                                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    Sophean Phouk
                                </th>
                                <td class="px-6 py-4">
                                    Biz Solution
                                </td>
                                <td class="px-6 py-4">
                                    01-Sep-25
                                </td>
                                <td class="px-6 py-4">
                                    31-Dec-25
                                </td>
                                <td class="px-6 py-4">
                                    <button
                                        class="cursor-pointer px-3 py-2 text-xs mr-2 font-medium text-white bg-gray-700 rounded">
                                        Show
                                    </button>

                                    <button
                                        class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded">
                                        Edit
                                    </button>
                                    <button
                                        class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-red-500 rounded ml-2">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </AppLayout>
</template>
