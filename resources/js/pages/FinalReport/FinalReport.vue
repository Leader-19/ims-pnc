<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import {
    ClipboardCheck,
    FileText,
    Plus,
    Pencil,
    Trash2
} from 'lucide-vue-next'
import { can } from '@/lib/can'
import { type BreadcrumbItem } from '@/types'

interface Report {
    id: number
    report_name: string
    description: string | null
    final_upload: string
    user?: {
        id: number
        name: string
    }
    score?: {
        final_report_score: number
    }
}


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Final Reports',
        href: '/final-reports',
    },
]

defineProps<{
    reports: Report[]
}>()

function deleteFinalReports(id) {
    if (confirm("Are you want to delete this Final Report")) {
        router.delete(route('final-reports.destroy', id));
    }
}
</script>




<template>

    <Head title="Final Reports" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="overflow-x-auto p-3">

            <!-- Create Button -->
            <Link :href="route('final-reports.create')" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold
                       text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">
                <Plus class="w-4 h-4" />
                Create Final Reports
            </Link>

            <!-- Table -->
            <table class="w-full mt-3 text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th v-if="can('score.create')" class="px-6 py-3">Students</th>
                        <th class="px-6 py-3">Final Report</th>
                        <th class="px-6 py-3">Description</th>
                        <th class="px-6 py-3">File</th>
                        <th class="px-6 py-3">Score</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(report, index) in reports" :key="report.id"
                        class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800">
                        <td class="px-6 py-2 normal-nums">
                            {{ index+1 }}
                        </td>



                        <td v-if="can('score.create')" class="px-6 py-2">
                            {{ report.user?.name ?? '_' }}
                        </td>

                        <td class="px-6 py-2">
                            {{ report.report_name }}
                        </td>

                        <td class="px-6 py-2">
                            {{ report.description ?? '-' }}
                        </td>

                        <td class="px-6 py-2">
                            <a :href="`/storage/${report.final_upload}`" target="_blank"
                                class="text-blue-600 hover:underline">
                                View
                            </a>
                        </td>

                        <td class="px-6 py-2 text-center">
                            <span v-if="report.score">
                                {{ report.score.final_report_score }}/100
                            </span>
                            <span v-else class="text-gray-400">
                                __/100
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-2">
                            <div class="flex justify-center gap-2">

                                <Link :href="route('final-reports.evaluate', report.id)" class="inline-flex items-center gap-1 px-3 py-1 text-xs
                                           text-white bg-green-600 rounded hover:bg-green-700">
                                    <ClipboardCheck class="w-4 h-4" />
                                </Link>

                                <Link :href="route('final-reports.show', report.id)"
                                    class="p-2 bg-gray-800 rounded hover:bg-gray-700" title="View">
                                    <FileText class="w-4 h-4 text-white" />
                                </Link>

                                <Link :href="route('final-reports.edit', report.id)"
                                    class="p-2 rounded bg-blue-500 hover:bg-blue-900" title="Edit">
                                    <Pencil class="w-4 h-4 text-white" />
                                </Link>

                                <button @click="deleteFinalReports(report.id)"
                                    class="p-2 bg-red-500 rounded hover:bg-red-700" title="Delete">
                                    <Trash2 class="w-4 h-4 text-white" />
                                </button>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
