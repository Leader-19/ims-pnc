<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Roles Show',
        href: '/roles',
    },
];

const props = defineProps({
    report: Object
});




</script>

<template>

    <Head title="Role Show" />


    <AppLayout :breadcrumbs="breadcrumbs">



        <div class="over-flow-x-auto p-3">

            <Link :href="route('final-reports.index')"
                class="cursor-pointer px-3 py-2 text-xs mb-3 font-medium text-white bg-blue-500 rounded">
                Back
            </Link>

            <div>
                <p><strong>Report</strong></p>
                <p><strong>Final Reports Details</strong>
                    <span v-for="rp in report" :key="rp" class="mr-1 text-xs font-medium px-2.5 py-0.5">
                        {{ rp }}
                    </span>
                </p>
            </div>
        </div>
    </AppLayout>
</template>
