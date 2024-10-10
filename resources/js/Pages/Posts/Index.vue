<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head,Link,useForm } from "@inertiajs/vue3";

defineProps({
    posts: {
        type: Array,
        default: () => [],
    },
});
const form = useForm({});

const deletePost =  (id) => {
    form.delete(`posts/${id}`);
}

const headers = ["Title", "Body","Categories" ,"Actions"];
</script>

<template>
    <Head title="Posts" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Posts
                </h2>
                <Link :href="route('posts.create')" class="text-sky-50 ">Create new Post</Link>
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
                        <tr v-for="post in posts" :key="post.id">
                            <td>{{ post.title }}</td>
                            <td :title="post.body">{{ post.body.length > 50 ? post.body.slice(0, 50) + '...' : post.body }}</td>
                            <td>
                                <div class="flex flex-col justify-center items-center w-full space-x-2">
                                    <strong v-for="category in post.categories" :key="category.id" class="border-b border-gray-800">
                                        <a :href="route('categories.edit',category.id)">{{category.category_name}}</a>
                                    </strong>
                                </div>

                            </td>
                            <td><button @click="deletePost(post.id)" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-red-600 rounded-lg focus:ring-4">Delete</button>
                            &nbsp;&nbsp;<Link :href="route('posts.edit',post.id)" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-500 rounded-lg focus:ring-4">Edit</Link></td>
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
