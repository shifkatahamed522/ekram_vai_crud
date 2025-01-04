<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3'



</script>

<template>
    <Head title="Dashboard"/>


    <AuthenticatedLayout>
        <Link class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :href="route('products.index')">Products</Link>

    </AuthenticatedLayout>

</template>


