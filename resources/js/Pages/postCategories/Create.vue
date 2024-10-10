<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {onMounted} from "vue";
const props = defineProps({
    category:{
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
});
// console.log(props.categories);
const form = useForm({
    category_name: "",
    parent_category: "",
});
const submit = () => (props.isUpdating?updateCategory():addCategory());
const addCategory = () => form.post(route('categories.store'));
const updateCategory = () => form.put(route('categories.update',props.category.id));
onMounted(()=>{
   form.category_name=props.category?props.category.category_name:'';
   form.parent_category=props.category?(props.category.parent_category?props.category.parent_category.id:''):'';
});
/*const submit = () => {
    form.post("/categories");
};*/
</script>

<template>
    <Head title="Categories Create Form" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 v-if="!isUpdating"
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Create New Category
                </h2>
                <h2 v-if="isUpdating"
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Update "{{category.category_name}}"
                </h2>
                <Link :href="route('categories.index')" class="text-sky-50 ">Back to All Categories</Link>
            </div>

        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-2xl ">
                            <form @submit.prevent="submit" class="max-w-md mx-auto">
                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2">
                                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" v-model="form.category_name" />

                                </div>
                                    <div class="sm:col-span-2">
                                        <label for="parent_category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parent</label>
                                        <select id="parent_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" v-model="form.parent_category">
                                            <option value="">Select Parent</option>
                                            <option v-for="category in categories" :value="category.id"  :key="category.id">{{category.category_name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800" type="submit">
                                    {{ isUpdating?'Update':'Save' }}</button>
                            </form>
                        </div>

                </section>
                </div>

        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
