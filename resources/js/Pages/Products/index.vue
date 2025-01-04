<template>
    <div>
        <h1 class="text-3xl text-center font-bold py-6 bg-blend-color">My Crud Operations</h1>
        <Link class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :href="route('products.create')">Add Product</Link>
        <table class="table-auto border-collapse border border-gray-300 w-full text-sm">
            <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Price</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Image</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in products" :key="item.index">
                <td class="border border-gray-300 px-4 py-2">{{index+1}}</td>
                <td class="border border-gray-300 px-4 py-2">{{ item.name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ item.price }}</td>
                <td class="border border-gray-300 px-4 py-2"><img class="w-10 h-10" :src="'/uploads/img/'+item.image" alt=""></td>
                <td class="border border-gray-300 px-4 py-2"><Link :href="route('products.edit', item.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</Link><button type="submit"  @click="deleteProduct(item.id)"  class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button></td>
            </tr>
            </tbody>
        </table>
    </div>

   <!-- <h1 class="text-2xl text-center pt-10">External Api Call</h1>
   <p>The total posts count = {{ comments.length === 0 ? 'Loading...' : comments.length }}</p>
   <ul>
    <li v-for="(item,index) in comments" :key="item.id">{{ index+1 }}  =  {{ item.email }}</li>
   </ul> -->
</template>

<script setup>
import {Link, useForm} from '@inertiajs/vue3';


defineProps({
    products: Array,
    comments:{
        type:Array,
        default:[]
    }


})

const form = useForm({});

const deleteProduct = (id) => {
    if(confirm('Are you sure?')) {
        form.delete(route('products.destroy', id));
    }
}

</script>
