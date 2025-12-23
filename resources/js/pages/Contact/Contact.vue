<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Contact Supervisor',
        href: '/contact-supervisors',
    },
];



</script>

<template>

    <Head title="Contact Supervisor" />


    <AppLayout :breadcrumbs="breadcrumbs">



        <div class="over-flow-x-auto p-3">
            <h1>Contact Supervisor</h1>
        </div>
    </AppLayout>
</template>
