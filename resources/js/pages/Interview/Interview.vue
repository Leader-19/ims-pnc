<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Company Interviews',
        href: '/company-interviews',
    },
];



</script>

<template>

    <Head title="Company Interview" />


    <AppLayout :breadcrumbs="breadcrumbs">



        <div class="over-flow-x-auto p-3">
            <h1>Interview Company</h1>
        </div>
    </AppLayout>
</template>
