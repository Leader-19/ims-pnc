<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { type BreadcrumbItem } from '@/types'

const props = defineProps<{
    report: {
        id: number
        score?: {
            final_report_score: number | null
        }
    }
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Evaluate Score',
        href: route('final-reports.evaluate', props.report.id),
    },
]

// Inertia form
const form = useForm({
    final_report_score: props.report.score?.final_report_score ?? '',
})

const submit = () => {
    form.post(route('final-reports.evaluate-score', props.report.id))
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
                v-model="form.final_report_score"
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

            <p v-if="form.errors.final_report_score" class="text-red-500 text-sm">
                {{ form.errors.final_report_score }}
            </p>

        </form>
    </AppLayout>
</template>
