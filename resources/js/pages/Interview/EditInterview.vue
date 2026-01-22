<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

interface Interview {
    id: number
    company_name: string
    date_interview: string
}

const props = defineProps<{
    interview: Interview
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Update Company Interview',
        href: '/company-interviews',
    },
]

const form = useForm({
    _method: 'PUT',
    company_name: props.interview.company_name,
    date_interview: props.interview.date_interview,
})

const submit = () => {
    form.post(route('company-interviews.update', props.interview.id), {
        onSuccess: () => {
            console.log('Updated successfully')
        },
    })
}
</script>

<template>
    <Head title="Update Company Interview" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">

            <!-- Back Button -->
            <Link
                :href="route('company-interviews.index')"
                class="inline-block mb-4 px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded hover:bg-blue-600"
            >
                Back
            </Link>

            <!-- Form -->
            <form
                @submit.prevent="submit"
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
                        placeholder="Enter company name"
                        class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
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
                        Interview Date
                    </label>
                    <input
                        type="date"
                        v-model="form.date_interview"
                        class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                    <p
                        v-if="form.errors.date_interview"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.date_interview }}
                    </p>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full bg-green-600 hover:bg-green-700 disabled:opacity-50 text-white font-medium py-2 rounded"
                >
                    Update Company Interview
                </button>
            </form>
        </div>
    </AppLayout>
</template>
