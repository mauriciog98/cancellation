<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Shared/Pagination.vue';

defineProps({
    items: Object
});
</script>

<template>
    <AppLayout title="Estudiantes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Estudiantes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>

                    </div>
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                        <table class="table table-auto">
                            <thead>
                            <tr>
                                <td class="border border-slate-300 p-4">Nombre</td>
                                <td class="border border-slate-300 p-4">Documento</td>
                                <td class="border border-slate-300 p-4">Estado</td>
                                <td class="border border-slate-300 p-4">Email</td>
                                <td class="border border-slate-300 p-4">Ver asistencia</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in items.data" :key="item.id">
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">{{ item.fullname }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">{{ item.identification }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">{{ item.email }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">{{ item.status }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">{{ item.status }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <pagination :links="items.links" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
