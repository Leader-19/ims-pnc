<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Final Report',
        href: '/final-reports',
    },
];



</script>

<template>

    <Head title="inal Slide Presentation" />


    <AppLayout :breadcrumbs="breadcrumbs">



        <div class="over-flow-x-auto p-3">
            <h1>Final Reports</h1>
        </div>
    </AppLayout>
</template>
