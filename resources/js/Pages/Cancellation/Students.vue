<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Shared/Pagination.vue'
import {pickBy, throttle} from 'lodash'
import {reactive, watch} from "vue"
import {Inertia} from '@inertiajs/inertia'
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
    items: Object,
    filters: Object
});

const params = reactive({
    search: props.filters.search,
    field: props.filters.field,
    direction: props.filters.direction,
})

function sort(field) {
    this.params.field = field
    this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc'
}

watch(() => params,
    throttle(function () {
        Inertia.get(this.route('students.index'), pickBy(params), {replace: true, preserveState: true})
    }, 150), {
        deep: true
    }
)
</script>

<template>
    <AppLayout title="Estudiantes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Estudiantes
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="mb-4 max-w-xs">
                    <input v-model="params.search"
                           aria-label="Search"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="Buscar..."
                           type="search"/>
                </div>

                <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto -my-2 sm:-mx-6 lg:-mx-8">
                            <div class="inline-block py-2 min-w-full align-middle sm:px-6 lg:px-8">
                                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg content-center place-content-center">
                                    <table class="table table-auto mx-auto">
                                        <thead class="bg-orange-500">
                                        <tr>
                                            <th class="font-semibold tracking-wider text-left text-white" scope="col">
                                                <span class="inline-flex py-3 px-6 w-full justify-between"
                                                      @click="sort('fullname')">
                                                Nombre
                                                <svg v-if="params.field === 'fullname' && params.direction === 'asc'"
                                                     class="h-4 w-4" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                                </svg>

                                                <svg v-if="params.field === 'fullname' && params.direction === 'desc'"
                                                     class="h-4 w-4" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                                </svg>
                                                </span>
                                            </th>
                                            <th class="font-semibold tracking-wider text-left text-white" scope="col">
                                            <span
                                                class="inline-flex py-3 px-6 w-full justify-between"
                                                @click="sort('identification')">
                                                Documento
                                                <svg
                                                    v-if="params.field === 'identification' && params.direction === 'asc'"
                                                    class="h-4 w-4" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                                </svg>

                                                <svg
                                                    v-if="params.field === 'identification' && params.direction === 'desc'"
                                                    class="h-4 w-4" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                                </svg>
                                                                                                </span>
                                            </th>
                                            <th class="font-semibold tracking-wider text-left text-white" scope="col">
                                                                                                <span
                                                                                                    class="inline-flex py-3 px-6 w-full justify-between"
                                                                                                    @click="sort('email')">
                                                Email
                                                <svg v-if="params.field === 'email' && params.direction === 'asc'"
                                                     class="h-4 w-4" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                                </svg>

                                                <svg v-if="params.field === 'email' && params.direction === 'desc'"
                                                     class="h-4 w-4" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                                </svg>
                                                                                                </span>
                                            </th>
                                            <th class="font-semibold tracking-wider text-left text-white" scope="col">
                                                <span class="inline-flex py-3 px-6 w-full justify-between"
                                                      @click="sort('status')">
                                                Estado
                                                <svg v-if="params.field === 'status' && params.direction === 'asc'"
                                                     class="h-4 w-4" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                                </svg>

                                                <svg v-if="params.field === 'status' && params.direction === 'desc'"
                                                     class="h-4 w-4" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                                </svg>
                                                                                                </span>
                                            </th>
                                            <th class="font-semibold tracking-wider text-left text-white" scope="col">
                                                Ver asistencia
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="item in items.data" :key="item.id">
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap capitalize">
                                                {{ item.fullname }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                {{ item.identification }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                {{ item.email }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                {{ item.status }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                <Link v-if="item.status === 'activo'" :href="route('lessons.index',item.id)" class="text-sm text-gray-700 underline">
                                                    Ver asistencia
                                                </Link>
                                              <br>
                                              <Link v-if="item.status === 'activo'" :href="route('booking.create',item.id)" class="text-sm text-gray-700 underline">
                                                Reservar
                                              </Link>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <pagination :links="items.links" class="mt-10 mx-auto"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
