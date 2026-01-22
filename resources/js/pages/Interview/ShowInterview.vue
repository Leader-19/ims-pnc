<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Show Company Interview Details',
        href: '/company-interviews',
    },
];

const props = defineProps({
    interview: Object
});




</script>

<template>

    <Head title="Show Company Interview Details" />


    <AppLayout :breadcrumbs="breadcrumbs">



        <div class="over-flow-x-auto p-3">

            <Link :href="route('company-interviews.index')"
                class="cursor-pointer px-3 py-2 text-xs mb-3 font-medium text-white bg-blue-500 rounded">
                Back
            </Link>

            <div>
                <p><strong>Company Interview</strong></p>
                <p><strong>Company Interview Details</strong>
                    <span v-for="int in interview" :key="int" class="mr-1 text-xs font-medium px-2.5 py-0.5">
                        {{ int }}
                    </span>
                </p>
            </div>
        </div>
    </AppLayout>
</template>
