<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { can } from '@/lib/can';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Update Supervisor Contact',
        href: '/contact-supervisors',
    },
];

const props = defineProps({
    contact : Object,
    
});

// Initialize form (important to include _method)
const form = useForm({
    _method: "PUT",
    supervisor_name: props.contact?.supervisor_name ?? "",
    email_supervisor: props.contact?.email_supervisor ?? "",
    supervisor_phone_number: props.contact?.supervisor_phone_number?? "",
  
});


// Submit update using form.post() + _method
const submit = () => {
    form.post(route('contact-supervisors.update', props.contact.id), {
        forceFormData: true,
        onSuccess: () => console.log("Updated successfully"),
        onError: (err) => console.log("Validation errors:", err),
    });
};
</script>

<template>

    <Head title="Update Supervisor Contacts" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-3">
            <Link :href="route('contact-supervisors.index')" class="px-3 py-2 text-xs text-white bg-blue-500 rounded">
                Back
            </Link>

            <form @submit.prevent="submit" class="space-y-5 mt-4 max-w-md mx-auto">

                <!-- Name -->
                <div class="grid gap-1">
                    <label class="text-sm font-medium">Supervisor Name</label>
                    <input type="text" name="worklog_name" v-model="form.supervisor_name" placeholder="Enter the name"
                        class="block w-full border rounded-md px-3 py-2" />
                    <p class="text-red-500 text-xs" v-if="form.errors.supervisor_name">
                        {{ form.errors.supervisor_name }}
                    </p>
                </div>

            
                <!-- Email -->
                <div class="grid gap-1">
                    <label class="text-sm font-medium">Supervisor Email</label>
                    <input type="text" name="discription" v-model="form.email_supervisor" placeholder="Enter description"
                        class="block w-full border rounded-md px-3 py-2" />
                    <p class="text-red-500 text-xs" v-if="form.errors.email_supervisor">
                        {{ form.errors.email_supervisor }}
                    </p>
                </div>

                <!-- Phone -->
                <div class="grid gap-1">
                    <label class="text-sm font-medium">Supervisor Phone</label>
                    <input type="text" name="worklog_name" v-model="form.supervisor_phone_number" placeholder="Enter the name"
                        class="block w-full border rounded-md px-3 py-2" />
                    <p class="text-red-500 text-xs" v-if="form.errors.supervisor_phone_number">
                        {{ form.errors.supervisor_phone_number }}
                    </p>
                </div>

                <button type="submit" class="bg-green-600 text-white text-xs rounded px-4 py-2">
                    Update Supervisor Contact
                </button>
            </form>
        </div>
    </AppLayout>
</template>