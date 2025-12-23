<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Weekly Worklog',
        href: '/weekly-worklogs',
    },
];



</script>

<template>

    <Head title="Weekly Worklog" />


    <AppLayout :breadcrumbs="breadcrumbs">



        <div class="over-flow-x-auto p-3">
            <h1>Weekly Worklog</h1>
        </div>
    </AppLayout>
</template>
