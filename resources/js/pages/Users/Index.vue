<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import users from '@/routes/users';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: '/users',
    },
];

defineProps ({
    users :Array
});

</script>

<template>
    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="over-flow-x-auto p-3">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </thead>

                <tbody>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-900">

                        <td class="px-6 py-2 dark:text-gray-300">1</td>
                        <td class="px-6 py-2 dark:text-gray-300">Leader Din</td>
                        <td class="px-6 py-2 dark:text-gray-300">dinleader200@gmail.com</td>
                        <td class="px-6 py-2">
                            <button class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-500">Edite</button>
                            <button class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-red-500">Delete</button>
                        </td>
                    </tr>

                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-900">

                        <td class="px-6 py-2 dark:text-gray-300">2</td>
                        <td class="px-6 py-2 dark:text-gray-300">Remen Din</td>
                        <td class="px-6 py-2 dark:text-gray-300">dinremen@gmail.com</td>
                        <td class="px-6 py-2">
                            <button class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-500">Edite</button>
                            <button class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-red-500">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
