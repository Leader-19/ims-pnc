<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import roles from '@/routes/roles';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { User } from 'lucide-vue-next';
import { route } from 'ziggy-js';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Show Internship Details',
        href: '/internships',
    },
];

const props = defineProps({
    "internship" : Object,
    
});




</script>

<template>

    <Head title="Show Internship Details" />


    <AppLayout :breadcrumbs="breadcrumbs">



        <div class="over-flow-x-auto p-3">

            <Link :href="route('internships.index')"
                class="cursor-pointer px-3 py-2 text-xs mb-3 font-medium text-white bg-blue-500 rounded">
                Back
            </Link>

            <div>
               
                <p><strong>Internship</strong>
                    <span
                            v-for="intern in internship"
                            :key="intern"
                            class="mr-1 text-xs font-medium px-2.5 py-0.5"
                            >
                                {{ intern }}
                            </span>
                </p>
            </div>
        </div>
    </AppLayout>
</template>
