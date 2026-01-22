<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import type { BreadcrumbItem } from '@/types'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Company Internships',
        href: '/internships',
    },
]

const form = useForm({
    company_name: '',
    start_date: '',
    end_date: '',
    allowance: '',
})
</script>

<template>
    <Head title="Create Company Internship" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">

            <!-- Back Button -->
            <Link
                :href="route('internships.index')"
                class="inline-block mb-4 px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded hover:bg-blue-600"
            >
                Back
            </Link>

            <!-- Form -->
            <form
                @submit.prevent="form.post(route('internships.store'))"
                class="space-y-6 max-w-md mx-auto bg-white p-6 rounded shadow"
            >
                <!-- Company Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Company Name
                    </label>
                    <input
                        type="text"
                        v-model="form.company_name"
                        class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter company name"
                    />
                    <p
                        v-if="form.errors.company_name"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.company_name }}
                    </p>
                </div>

                <!-- Interview Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Start Date
                    </label>
                    <input
                        type="date"
                        v-model="form.start_date"
                        class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                    <p
                        v-if="form.errors.start_date"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.start_date }}
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        End Date
                    </label>
                    <input
                        type="date"
                        v-model="form.end_date"
                        class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                    <p
                        v-if="form.errors.end_date"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.end_date }}
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Allowance
                    </label>
                    <input
                        type="text"
                        v-model="form.allowance"
                        class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter company name"
                    />
                    <p
                        v-if="form.errors.allowance"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.allowance }}
                    </p>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full bg-green-600 hover:bg-green-700 disabled:opacity-50 text-white font-medium py-2 rounded"
                >
                    Add Company Internship
                </button>
            </form>
        </div>
    </AppLayout>
</template>
