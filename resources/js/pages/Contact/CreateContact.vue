<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { type BreadcrumbItem } from '@/types'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Supervisor Contact',
        href: '/contact-supervisors',
    },
]

const form = useForm({
    supervisor_name: '',
    email_supervisor: '', 
    supervisor_phone_number: '',
})


</script>


<template>
    <Head title="Create Supervisor Contact" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">

            <!-- Back Button -->
            <Link
                :href="route('contact-supervisors.index')"
                class="inline-block mb-4 px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded"
            >
                Back
            </Link>

            <!-- Form -->
            <form
                @submit.prevent="form.post(route('contact-supervisors.store'), { forceFormData: true })"
                class="space-y-6 max-w-md mx-auto"
            >
                <!-- Report Name -->
                <div>
                    <label class="block text-sm font-medium">Supervisor Name</label>
                    <input
                        type="text"
                        v-model="form.supervisor_name"
                        class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2"
                        placeholder="Enter report name"
                    />
                    <p v-if="form.errors.supervisor_name" class="text-red-500 text-sm mt-1">
                        {{ form.errors.supervisor_name }}
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input
                        type="text"
                        v-model="form.email_supervisor"
                        class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2"
                        placeholder="Optional description"
                    />
                    <p v-if="form.errors.email_supervisor" class="text-red-500 text-sm mt-1">
                        {{ form.errors.email_supervisor }}
                    </p>
                </div>

                

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium">Phone</label>
                    <input
                        type="text"
                        v-model="form.supervisor_phone_number"
                        class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2"
                        placeholder="Optional description"
                    />
                    <p v-if="form.errors.supervisor_phone_number" class="text-red-500 text-sm mt-1">
                        {{ form.errors.supervisor_phone_number }}
                    </p>
                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded"
                    :disabled="form.processing"
                >
                    Add Supervisor Contact
                </button>
            </form>
        </div>
    </AppLayout>
</template>

