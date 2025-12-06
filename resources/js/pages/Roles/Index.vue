<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { User } from 'lucide-vue-next';
import { route } from 'ziggy-js';

interface User {
    id: number;
    name: string;
    email: string;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Roles',
        href: '/roles',
    },
];

const props = defineProps<{
    roles: User[];
}>();

function deleteUser(id) {
    if (confirm("Are you want to delete this user")){
        router.delete(route('role.destroy', id));
    }
}

</script>

<template>

    <Head title="Roles" />


    <AppLayout :breadcrumbs="breadcrumbs">



        <div class="over-flow-x-auto p-3">

            <Link href="/roles/create"
                class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded">
                Create role
            </Link>

            <table class="w-full mt-3 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </thead>

                <tbody>
                    <tr v-for="role in roles" :key="role.id"
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-900">

                        <td class="px-6 py-2 dark:text-gray-300">{{ role.id }}</td>
                        <td class="px-6 py-2 dark:text-gray-300">{{ role.name }}</td>
                        <td class="px-6 py-2">

                            <Link :href="route('role.show', role.id)"
                                class="cursor-pointer px-3 py-2 text-xs mr-2 font-medium text-white bg-gray-700 rounded">
                                Show
                            </Link>

                            <Link :href="route('role.edit', role.id)"
                                class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded">
                                Edit
                            </Link>
                            <button
                                @click="deleteUser(role.id)"
                                class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-red-500 rounded ml-2">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
