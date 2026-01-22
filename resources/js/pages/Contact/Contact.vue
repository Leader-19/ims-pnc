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


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Contact Supervisor',
        href: 'contact-supervisors',
    },
]

interface Contact {
    id: number
    supervisor_name: string
    email_supervisor: string | null
    supervisor_phone_number: string
    user?: {
        id: number
        name: string
    }

}


defineProps<{
    contacts: Contact[]
}>()

function deleteContactSupervisor(id) {
    if (confirm("Are you want to delete this Contact")) {
        router.delete(route('contact-supervisors.destroy', id));
    }
}
</script>




<template>

    <Head title="Supervisor Contact" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="overflow-x-auto p-3">

            <!-- Create Button -->
            <Link :href="route('contact-supervisors.create')" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold
                       text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">
                <Plus class="w-4 h-4" />
                Add Contact Supervisor
            </Link>

            <!-- Table -->
            <table class="w-full mt-3 text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Students</th>
                        <th class="px-6 py-3">Supervisor Name</th>
                        <th class="px-6 py-3">Supervisor Phone Number</th>
                        <th class="px-6 py-3">Supervisor Email</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr 
                    v-for="(contact, index) in contacts" :key="contact"
                    class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800">
                        <td class="px-6 py-2 normal-nums">
                            {{ index+1  }}
                        </td>



                        <td v-if="can('score.create')" class="px-6 py-2">
                            {{ contact.user?.name }}
                        </td>

                        <td class="px-6 py-2">
                            {{ contact.supervisor_name }}
                        </td>

                        <td class="px-6 py-2">
                            {{ contact.supervisor_phone_number }}
                        </td>

                        <td class="px-6 py-2">
                            {{ contact.email_supervisor }}
                        </td>


                        <!-- Actions -->
                        <td class="px-6 py-2">
                            <div class="flex justify-center gap-2">



                                <Link 
                                :href="route('contact-supervisors.show', contact.id)"
                                class="p-2 bg-gray-800 rounded hover:bg-gray-700" title="View">
                                    <FileText class="w-4 h-4 text-white" />
                                </Link>

                                <Link 
                                :href="route('contact-supervisors.edit', contact.id)"
                                class="p-2 rounded bg-blue-500 hover:bg-blue-900" title="Edit">
                                    <Pencil class="w-4 h-4 text-white" />
                                </Link>

                                <button 
                                @click="deleteContactSupervisor(contact.id)"
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
