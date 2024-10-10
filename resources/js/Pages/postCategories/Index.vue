<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head,Link,useForm } from "@inertiajs/vue3";

const props = defineProps({
    categories: {
        type: Array,
        default: () => [],
    },
});
console.log(props.categories);
const form = useForm({});

const deleteCategory =  (id) => {
    form.delete(`categories/${id}`);
}

const headers = ["Name", "Parent" ,"Actions"];
</script>

<template>
    <Head title="Categories" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Posts Categories
                </h2>
                <Link :href="route('categories.create')" class="text-sky-50 ">Create new Category</Link>
            </div>

        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-200"
                >
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal text-center ">
                        <thead>
                        <tr>
                            <th v-for="header in headers" :key="header">
                                {{ header }}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="category in categories" :key="category.id">
                            <td>{{ category.category_name }}</td>
                            <td>{{ category.parent_category?category.parent_category.category_name:'' }}</td>
                            <td><button @click="deleteCategory(category.id)" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-red-600 rounded-lg focus:ring-4">Delete</button>
                            &nbsp;&nbsp;<Link :href="route('categories.edit',category.id)" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-500 rounded-lg focus:ring-4">Edit</Link></td>
                        </tr>
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
