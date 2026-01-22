<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { type BreadcrumbItem } from '@/types'

const props = defineProps<{
    slide: {
        id: number
        score?: {
            final_slide_score: number | null
        }
    }
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Evaluate Score',
        href: route('final-slides.evaluate', props.slide.id),
    },
]

// Inertia form
const form = useForm({
    final_slide_score: props.slide.score?.final_slide_score ?? '',
})

const submit = () => {
    form.post(route('final-slides.evaluate-score', props.slide.id))
}
</script>

<template>
    <Head title="Evaluate Score" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <form @submit.prevent="submit" class="space-y-4">

            <input
                type="number"
                min="0"
                max="100"
                v-model="form.final_slide_score"
                class="border rounded px-3 py-2 w-64"
                placeholder="Enter score"
                required
            />

            <button
                type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
                :disabled="form.processing"
            >
                Evaluate
            </button>

            <p v-if="form.errors.final_slide_score" class="text-red-500 text-sm">
                {{ form.errors.final_slide_score }}
            </p>

        </form>
    </AppLayout>
</template>
