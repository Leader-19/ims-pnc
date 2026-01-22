<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { can } from '@/lib/can';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Update Final Slide',
        href: '/final-slides',
    },
];

const props = defineProps({
    slide : Object,
    score : Object
});

// Initialize form (important to include _method)
const form = useForm({
    _method: "PUT",
    slide_name: props.slide?.slide_name ?? "",
    description: props.slide?.description ?? "",
    slide_upload: null as File | null,
    final_slide_score: props.score?.final_slide_score ?? null,
  
});

// Handle file input
const handleFileUpload = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        form.slide_upload = target.files[0];
    }
};

// Submit update using form.post() + _method
const submit = () => {
    form.post(route('final-slides.update', props.slide.id), {
        forceFormData: true,
        onSuccess: () => console.log("Updated successfully"),
        onError: (err) => console.log("Validation errors:", err),
    });
};
</script>

<template>

    <Head title="Update Final Slide" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-3">
            <Link :href="route('final-slides.index')" class="px-3 py-2 text-xs text-white bg-blue-500 rounded">
                Back
            </Link>

            <form @submit.prevent="submit" class="space-y-5 mt-4 max-w-md mx-auto">

                <!-- Name -->
                <div class="grid gap-1">
                    <label class="text-sm font-medium">Weekly Worklog Name</label>
                    <input type="text" name="worklog_name" v-model="form.slide_name" placeholder="Enter the name"
                        class="block w-full border rounded-md px-3 py-2" />
                    <p class="text-red-500 text-xs" v-if="form.errors.slide_name">
                        {{ form.errors.slide_name }}
                    </p>
                </div>

                <!-- File -->
                <div class="grid gap-1">
                    <label class="text-sm font-medium">File Upload</label>
                    <input type="file" @change="handleFileUpload" class="block w-full border rounded-md p-2 text-xs" />
                    <p class="text-red-500 text-xs" v-if="form.errors.slide_upload">
                        {{ form.errors.slide_upload }}
                    </p>

                    <p v-if="props.slide?.worklog_upload" class="text-xs text-gray-500">
                        Current file:
                        <a :href="`/storage/${props.slide.slide_upload}`" target="_blank"
                            class="text-blue-500 underline">
                            View
                        </a>
                    </p>
                </div>

                <!-- Description -->
                <div class="grid gap-1">
                    <label class="text-sm font-medium">Description</label>
                    <input type="text" name="discription" v-model="form.description" placeholder="Enter description"
                        class="block w-full border rounded-md px-3 py-2" />
                    <p class="text-red-500 text-xs" v-if="form.errors.description">
                        {{ form.errors.description }}
                    </p>
                </div>


                <!-- Score -->
                <div 
                v-if="can('score.create')"
                class="grid gap-1">
                    <label class="text-sm font-medium">Weekly Worklog Score</label>
                    <input type="number" min="0" max="100" name="final_report_score"
                        v-model.number="form.final_slide_score" placeholder="Enter score"
                        class="block w-full border rounded-md px-3 py-2" />
                    <p class="text-red-500 text-xs" v-if="form.errors.final_slide_score">
                        {{ form.errors.final_slide_score }}
                    </p>
                </div>

                <button type="submit" class="bg-green-600 text-white text-xs rounded px-4 py-2">
                    Update Final Slide
                </button>
            </form>
        </div>
    </AppLayout>
</template>