<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Show Supervisor Contact Details',
        href: '/contact-supervisors',
    },
];

const props = defineProps({
    contact: Object
});




</script>

<template>

    <Head title="Show Supervisor Contact Details" />


    <AppLayout :breadcrumbs="breadcrumbs">



        <div class="over-flow-x-auto p-3">

            <Link :href="route('contact-supervisors.index')"
                class="cursor-pointer px-3 py-2 text-xs mb-3 font-medium text-white bg-blue-500 rounded">
                Back
            </Link>

            <div>
                <p><strong>Report</strong></p>
                <p><strong>Final Reports Details</strong>
                    <span v-for="con in contact" :key="con" class="mr-1 text-xs font-medium px-2.5 py-0.5">
                        {{ con }}
                    </span>
                </p>
            </div>
        </div>
    </AppLayout>
</template>
