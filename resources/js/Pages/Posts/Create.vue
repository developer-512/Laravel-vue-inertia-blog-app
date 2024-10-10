<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {onMounted} from "vue";
const props = defineProps({
    post:{
        type: Object,
        default: null
    },
    categories:{
        type: Array,
        default: null,
    },
    isUpdating:{
        type: Boolean,
        default: false,
    }
})
const form = useForm({
    title: "",
    body: "",
    categories:[]
});
console.log(props.post);
const submit = () => (props.isUpdating?updatePost():addPost());
const addPost = () => form.post(route('posts.store'));
const updatePost = () => form.put(route('posts.update',props.post.id));
onMounted(()=>{

   form.title=props.post?props.post.title:'';
   form.body=props.post?props.post.body:'';
   form.categories=props.post?props.post.categories.map(category => category.id):[];
});
/*const submit = () => {
    form.post("/posts");
};*/
</script>

<template>
    <Head title="Posts Create Form" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Create New Post
                </h2>
                <Link :href="route('posts.index')" class="text-sky-50 ">Back to All Posts</Link>
            </div>

        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-2xl ">
                            <form @submit.prevent="submit" class="max-w-md mx-auto">
                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2">
                                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title:</label>
                                        <input type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                               v-model="form.title" />

                                </div>
                                <div class="sm:col-span-2">
                                        <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Body:</label>
                                    <textarea id="body" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                              v-model="form.body"></textarea>

                                </div>
                                <div class="sm:col-span-2">
                                        <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categories:</label>
                                    <div class="grid grid-cols-2">
                                    <div v-for="category in categories" :key="category.id" class="flex items-center space-x-2">
                                        <input
                                            type="checkbox"
                                            :value="category.id"
                                            :id="'category-' + category.id"
                                            v-model="form.categories"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                        />
                                        <label class="dark:text-white text-gray-600" :for="'category-' + category.id">{{ category.category_name }}</label>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <button class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800" type="submit">Save</button>
                            </form>
                        </div>

                </section>
                </div>

        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
