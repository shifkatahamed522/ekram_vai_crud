<template>
    <div class="container mx-auto max-w-lg bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-5 text-gray-800">Edit Product</h1>
        <form @submit.prevent="updateProduct()">

            <!-- Product Name -->
            <div class="mb-4">
                <label for="productName" class="block text-gray-700 font-medium mb-2">Product Name</label>
                <input
                    v-model="form.name"
                    type="text"
                    name="name"
                    id="productName"
                    placeholder="Product Name"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
            </div>

            <!-- Product Price -->
            <div class="mb-4">
                <label for="productPrice" class="block text-gray-700 font-medium mb-2">Product Price</label>
                <input
                    v-model="form.price"
                    type="number"
                    name="price"
                    id="productPrice"
                    placeholder="Product Price"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
            </div>

            <!-- Image Upload -->
            <label for="imageUpload" class="block text-gray-700 font-medium mb-2">Image Uploads</label>
            
            <!-- Custom File Input -->
            <div class="relative">
                <input
                    type="text"
                    :value="fileName || 'Choose file...'"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none cursor-pointer"
                    readonly
                    @click="triggerFileInput"
                >
                <input
                    type="file"
                    ref="fileInput"
                    name="image"
                    id="imageUpload"
                    class="hidden"
                    @change="handleFileChange"
                >
                <button
                    type="button"
                    class="absolute inset-y-0 right-0 px-4 py-2 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 focus:outline-none"
                    @click="triggerFileInput"
                >
                    Browse
                </button>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button
                    type="submit"
                    class="w-inline-block bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    Update Product
                </button>
                <Link class="bg-red-500 hover:bg-red-700 text-white font-bold ml-2.5 py-3 px-8 rounded" :href="route('products.index')">Back</Link>
            </div>
        </form>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { ref, onMounted } from 'vue';

const props = defineProps({
    errors: Object,
    product: Object
});

const fileName = ref(""); // New ref to store file name
const fileInput = ref(null); // Reference to file input

const form = useForm({
    name: props.product.name,
    price: props.product.price,
    image: props.product.image,
});

const updateProduct = () => {
    form.put(route('products.update', props.product.id));
};

// Handle file input change
const handleFileChange = (event) => {
    const file = event.target.files[0];
    form.image = file; // Update the form with the new file
    fileName.value = file ? file.name : ""; // Set the file name to display in the custom input
};

// Trigger file input click
const triggerFileInput = () => {
    fileInput.value.click();
};

// Set existing file name on component mount
onMounted(() => {
    if (props.product.image) {
        fileName.value = props.product.image; // Set the existing image file name if it exists
    }
});
</script>
