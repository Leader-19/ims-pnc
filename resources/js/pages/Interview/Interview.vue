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



interface Interview {
    id: number
    company_name: string
    date_interview: Date
    user?: {
        id: number
        name: string
    }

}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Company Interview',
        href: '/company-interviews',
    },
]

defineProps<{
    interviews: Interview[]
}>()

function deleteCompanyInterview(id) {
    if (confirm("Are you want to delete this company")) {
        router.delete(route('company-interviews.destroy', id));
    }
}

</script>

<template>

    <Head title="Final Reports" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="overflow-x-auto p-3">

            <!-- Create Button -->
            <Link :href="route('company-interviews.create')" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold
                       text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">
                <Plus class="w-4 h-4" />
                Create Company Interview
            </Link>

            <!-- Table -->
            <table class="w-full mt-3 text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Students Name</th>
                        <th class="px-6 py-3">Company Name</th>
                        <th class="px-6 py-3">Interview Date</th>

                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr 
                    v-for="(interview, index) in interviews" :key="interview"
                    class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800">
                        <td class="px-6 py-2 normal-nums">
                            {{ index+1 }}
                        </td>

                         <td class="px-6 py-2">
                            {{ interview.user?.name }}
                        </td>

                        <td  class="px-6 py-2">
                            {{ interview.company_name }}
                        </td>

                        <td class="px-6 py-2">
                            {{ interview.date_interview }}
                        </td>





                        <!-- Actions -->
                        <td class="px-6 py-2">
                            <div class="flex justify-center gap-2">



                                <Link
                                :href="route('company-interviews.show', interview.id)"
                                class="p-2 bg-gray-800 rounded hover:bg-gray-700" title="View">
                                    <FileText class="w-4 h-4 text-white" />
                                </Link>

                                <Link 
                                :href="route('company-interviews.edit', interview.id)"
                                class="p-2 rounded bg-blue-500 hover:bg-blue-900" title="Edit">
                                    <Pencil class="w-4 h-4 text-white" />
                                </Link>

                                <button
                                @click="deleteCompanyInterview(interview.id)"
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
