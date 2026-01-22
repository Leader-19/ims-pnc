<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { type BreadcrumbItem } from '@/types'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Final Slide',
        href: '/final-slides',
    },
]

const form = useForm({
    slide_name: '',
    description: '', // keep spelling if DB uses this
    slide_upload: null as File | null,
})

const handleFileUpload = (e: Event) => {
    const input = e.target as HTMLInputElement
    if (input.files && input.files.length > 0) {
        form.slide_upload = input.files[0]
    }
}
</script>


<template>
    <Head title="Create Final Slide" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">

            <!-- Back Button -->
            <Link
                :href="route('final-slides.index')"
                class="inline-block mb-4 px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded"
            >
                Back
            </Link>

            <!-- Form -->
            <form
                @submit.prevent="form.post(route('final-slides.store'), { forceFormData: true })"
                class="space-y-6 max-w-md mx-auto"
            >
                <!-- Report Name -->
                <div>
                    <label class="block text-sm font-medium">Report Name</label>
                    <input
                        type="text"
                        v-model="form.slide_name"
                        class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2"
                        placeholder="Enter report name"
                    />
                    <p v-if="form.errors.slide_name" class="text-red-500 text-sm mt-1">
                        {{ form.errors.slide_name }}
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
                    <p v-if="form.errors.slide_upload" class="text-red-500 text-sm mt-1">
                        {{ form.errors.slide_upload }}
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
                    Add Final Slide
                </button>
            </form>
        </div>
    </AppLayout>
</template>

