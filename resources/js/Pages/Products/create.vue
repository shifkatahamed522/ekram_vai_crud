<script setup>
import {Link} from "@inertiajs/vue3";
import {useForm} from "@inertiajs/vue3";
defineProps({ errors: Object })
const form = useForm({
    name: '',
    price: '',
    image: '',

})

const saveProduct = () => {
    form.post(route('products.store'))

}
</script>

<template>
    <div class="container mx-auto max-w-lg bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-5 text-gray-800">Create Product</h1>
        <form @submit.prevent="saveProduct()">

            <div class="mb-4">
                <label for="exampleInputEmail1" class="block text-gray-700 font-medium mb-2">Product Name</label>
                <input
                    v-model="form.name"
                    type="text"
                    name="name"
                    id="exampleInputEmail1"
                    placeholder="Product Name"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
                <div class="text-red-500" v-if="errors.name">{{ errors.name }}</div>
            </div>


            <div class="mb-4">
                <label for="exampleInputPassword1" class="block text-gray-700 font-medium mb-2">Product Price</label>
                <input
                    v-model="form.price"
                    type="number"
                    name="price"
                    id="exampleInputPassword1"
                    placeholder="Product Price"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
                <div class="text-red-500" v-if="errors.price">{{ errors.price }}</div>
            </div>

            <!-- File Input -->
            <div class="mb-4">
            <label for="exampleInputPassword1" class="block text-gray-700 font-medium mb-2">Image Uploads</label>
            <input
                type="file"
                name="image"
                id=""
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                @input="form.image = $event.target.files[0]"
            >
            <div class="text-red-500" v-if="errors.image">{{ errors.image }}</div>
            </div>

            <!-- Submit Button -->
            <div>
                <button
                    type="submit"
                    class="w-inline-block bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    Add Product
                </button>
                <Link class="bg-red-500 hover:bg-red-700 text-white font-bold ml-2.5 py-3 px-8 rounded" :href="route('products.index')">Back</Link>
            </div>
        </form>
    </div>
</template>


