<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { type BreadcrumbItem } from '@/types'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Final Reports',
        href: '/final-reports',
    },
]

const form = useForm({
    report_name: '',
    description: '', // keep spelling if DB uses this
    final_upload: null as File | null,
})

const handleFileUpload = (e: Event) => {
    const input = e.target as HTMLInputElement
    if (input.files && input.files.length > 0) {
        form.final_upload = input.files[0]
    }
}
</script>


<template>
    <Head title="Create Final Report" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">

            <!-- Back Button -->
            <Link
                :href="route('final-reports.index')"
                class="inline-block mb-4 px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded"
            >
                Back
            </Link>

            <!-- Form -->
            <form
                @submit.prevent="form.post(route('final-reports.store'), { forceFormData: true })"
                class="space-y-6 max-w-md mx-auto"
            >
                <!-- Report Name -->
                <div>
                    <label class="block text-sm font-medium">Report Name</label>
                    <input
                        type="text"
                        v-model="form.report_name"
                        class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2"
                        placeholder="Enter report name"
                    />
                    <p v-if="form.errors.report_name" class="text-red-500 text-sm mt-1">
                        {{ form.errors.report_name }}
                    </p>
                </div>

                <!-- File Upload -->
                <div>
                    <label class="block text-sm font-medium">Upload File</label>
                    <input
                        type="file"
                        @change="handleFileUpload"
                        class="mt-1 block w-full text-sm border border-gray-300 rounded-md p-2"
                    />
                    <p v-if="form.errors.final_upload" class="text-red-500 text-sm mt-1">
                        {{ form.errors.final_upload }}
                    </p>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium">Description</label>
                    <input
                        type="text"
                        v-model="form.description"
                        class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2"
                        placeholder="Optional description"
                    />
                    <p v-if="form.errors.description" class="text-red-500 text-sm mt-1">
                        {{ form.errors.description }}
                    </p>
                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded"
                    :disabled="form.processing"
                >
                    Add Final Report
                </button>
            </form>
        </div>
    </AppLayout>
</template>

