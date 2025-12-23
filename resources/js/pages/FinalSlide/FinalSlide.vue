<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Final Slide Presentation',
        href: '/final-slides',
    },
];



</script>

<template>

    <Head title="inal Slide Presentation" />


    <AppLayout :breadcrumbs="breadcrumbs">



        <div class="over-flow-x-auto p-3">
            <h1>Final Slide Presentation</h1>
        </div>
    </AppLayout>
</template>
