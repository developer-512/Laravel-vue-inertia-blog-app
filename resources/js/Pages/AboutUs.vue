<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    name: {
        type: String,
    }
});
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
    <template #header>
        <h2
            class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
        >
            About Us ({{name??$page.props.auth.user.name}})
        </h2>
    </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="min-w-screen min-h-screen bg-gray-200 flex items-center justify-center px-5 py-5">
                        <div class="rounded-lg shadow-xl bg-gray-900 text-white" style="width:450px;">
                            <div class="border-b border-gray-800 px-8 py-3">
                                <div class="inline-block w-3 h-3 mr-2 rounded-full bg-red-500"></div><div class="inline-block w-3 h-3 mr-2 rounded-full bg-yellow-300"></div><div class="inline-block w-3 h-3 mr-2 rounded-full bg-green-400"></div>
                            </div>
                            <div class="px-8 py-6">
                                <p><em class="text-blue-400">const</em> <span class="text-green-400">aboutMe</span> <span class="text-pink-500">=</span> <em class="text-blue-400">function</em>() {</p>
                                <p>&nbsp;&nbsp;<span class="text-pink-500">return</span> {</p>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;name: <span class="text-yellow-300">'{{ $page.props.auth.user.name }}'</span>,</p>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;position: <span class="text-yellow-300">'fullstack-developer'</span>,</p>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;website: <span class="text-yellow-300">'<a :href="route('about-us')" target="_blank" class="text-yellow-300 hover:underline focus:border-none">Visit My Page</a>'</span>,</p>
                                <p>&nbsp;&nbsp;}</p>
                                <p>}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
body {
    font-family: 'Roboto Mono', monospace;
}
</style>
