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

interface Slide {
    id: number
    slide_name: string
    description: string | null
    slide_upload: string
    user?: {
        id: number
        name: string
    }
    score?: {
        final_slide_score: number
    }
}



const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Final Slides',
        href: '/final-slides',
    },
]

defineProps<{
    slides: Slide[]
}>()


function deleteFinalSlide(id) {
    if (confirm("Are you want to delete this Final Slide")) {
        router.delete(route('final-slides.destroy', id));
    }
}

</script>

<template>

    <Head title="Final Reports" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="overflow-x-auto p-3">

            <!-- Create Button -->
            <Link :href="route('final-slides.create')" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold
                       text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">
                <Plus class="w-4 h-4" />
                Create Final Slide
            </Link>

            <!-- Table -->
            <table class="w-full mt-3 text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th v-if="can('score.create')" class="px-6 py-3">Students</th>
                        <th class="px-6 py-3">Final Report</th>
                        <th class="px-6 py-3">Description</th>
                        <th class="px-6 py-3">File</th>
                        <th class="px-6 py-3">Score</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(slide, index) in slides" :key="slide.id"
                        class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800">
                        <td class="px-6 py-2 normal-nums">
                            {{ index + 1 }}
                        </td>
                        <td v-if="can('score.create')" class="px-6 py-2">
                            {{ slide.user?.name }}
                        </td>

                        <td class="px-6 py-2">
                            {{ slide.slide_name }}
                        </td>

                        <td class="px-6 py-2">
                            {{ slide.description }}
                        </td>

                        <td class="px-6 py-2">
                            <a :href="`/storage/${slide.slide_upload}`" target="_blank"
                                class="text-blue-600 hover:underline">
                                View
                            </a>
                        </td>

                        <td class="px-6 py-2 text-center">
                            <span v-if="slide.score">
                                {{ slide.score.final_slide_score }}/100
                            </span>
                            <span v-else class="text-gray-400">
                                __/100
                            </span>
                        </td>


                        <!-- Actions -->
                        <td class="px-6 py-2">
                            <div class="flex justify-center gap-2">

                                <Link :href="route('final-slides.evaluate', slide.id)" class="inline-flex items-center gap-1 px-3 py-1 text-xs
                                           text-white bg-green-600 rounded hover:bg-green-700">
                                    <ClipboardCheck class="w-4 h-4" />
                                </Link>

                                <Link :href="route('final-slides.show', slide.id)"
                                    class="p-2 bg-gray-800 rounded hover:bg-gray-700" title="View">
                                    <FileText class="w-4 h-4 text-white" />
                                </Link>

                                <Link :href="route('final-slides.edit', slide.id)"
                                    class="p-2 rounded bg-blue-500 hover:bg-blue-900" title="Edit">
                                    <Pencil class="w-4 h-4 text-white" />
                                </Link>

                                <button @click="deleteFinalSlide(slide.id)" class="p-2 bg-red-500 rounded hover:bg-red-700" title="Delete">
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
