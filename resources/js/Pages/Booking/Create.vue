<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Shared/Pagination.vue'
import {pickBy, throttle} from 'lodash'
import {reactive, watch} from 'vue'
import {Inertia} from '@inertiajs/inertia'
import {Link} from '@inertiajs/inertia-vue3'

const props = defineProps({
  items: Object,
  filters: Object,
  student: Object
});

const params = reactive({
  id_branch: props.filters.id_branch,
  field: props.filters.field,
  direction: props.filters.direction,
})

function sort(field) {
  params.field = field
  params.direction = params.direction === 'asc' ? 'desc' : 'asc'
}

watch(() => params,
    throttle(function () {
      Inertia.get(this.route('booking.create', {'student': props.student.id}), pickBy(params), {
        replace: true,
        preserveState: true
      })
    }, 150), {
      deep: true
    }
)
</script>

<template>
  <AppLayout title="Reservar">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Reservar a nombre de <span class="capitalize">{{ student.fullname }}</span>
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mb-4 max-w-xs">
          <select v-model="params.id_branch"
                  aria-label="Search"
                  class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          >
            <option disabled value=""> Seleccione...</option>
            <option value="43">Sede Laureles</option>
            <option value="46">Sede Aventura</option>
            <option value="47">Sede Aves Maria</option>
            <option value="48">Sede Virtual</option>
            <option value="49">Online</option>
            <option value="50">Sede Fabricato</option>
            <option value="45">Sede Poblado</option>
            <option value="51">Sede La Central</option>
          </select>
        </div>

        <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
          <div class="flex flex-col">
            <div class="overflow-x-auto -my-2 sm:-mx-6 lg:-mx-8">
              <div class="inline-block py-2 min-w-full align-middle sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg content-center place-content-center">
                  <table class="table table-auto mx-auto">
                    <thead class="bg-orange-500">
                    <tr>
                      <th class="font-semibold tracking-wider text-left text-white" scope="col">
                                                <span class="inline-flex py-3 px-6 w-full justify-between"
                                                      @click="sort('start')">
                                                Inicio
                                                <svg v-if="params.field === 'start' && params.direction === 'asc'"
                                                     class="h-4 w-4" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                                </svg>

                                                <svg v-if="params.field === 'start' && params.direction === 'desc'"
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
                                                @click="sort('name_program')">
                                                Programa
                                                <svg
                                                    v-if="params.field === 'name_program' && params.direction === 'asc'"
                                                    class="h-4 w-4" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                                </svg>

                                                <svg
                                                    v-if="params.field === 'name_program' && params.direction === 'desc'"
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
                                                                                                    @click="sort('name_type_class')">
                                                Tipo
                                                <svg
                                                    v-if="params.field === 'name_type_class' && params.direction === 'asc'"
                                                    class="h-4 w-4" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                                </svg>

                                                <svg
                                                    v-if="params.field === 'name_type_class' && params.direction === 'desc'"
                                                    class="h-4 w-4" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                                </svg>
                                                                                                </span>
                      </th>
                      <th class="font-semibold tracking-wider text-left text-white" scope="col">
                                                <span class="inline-flex py-3 px-6 w-full justify-between"
                                                      @click="sort('name_classroom')">
                                                Salón
                                                <svg
                                                    v-if="params.field === 'name_classroom' && params.direction === 'asc'"
                                                    class="h-4 w-4" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                                </svg>

                                                <svg
                                                    v-if="params.field === 'name_classroom' && params.direction === 'desc'"
                                                    class="h-4 w-4" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                                </svg>
                                                                                                </span>
                      </th>
                      <th class="font-semibold tracking-wider text-left text-white" scope="col">
                        <span class="inline-flex py-3 px-6 w-full justify-between"
                              @click="sort('max_student')">
                        Límite estudiantes
                          <svg v-if="params.field === 'max_student' && params.direction === 'asc'"
                               class="h-4 w-4" fill="currentColor"
                               viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                          </svg>

                          <svg v-if="params.field === 'max_student' && params.direction === 'desc'"
                               class="h-4 w-4" fill="currentColor"
                               viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                          </svg>
                        </span>
                      </th>
                      <th class="font-semibold tracking-wider text-left text-white" scope="col">
                        <span class="inline-flex py-3 px-6 w-full justify-between"
                              @click="sort('reserved')">
                        Reservas
                          <svg v-if="params.field === 'reserved' && params.direction === 'asc'"
                               class="h-4 w-4" fill="currentColor"
                               viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                          </svg>

                          <svg v-if="params.field === 'reserved' && params.direction === 'desc'"
                               class="h-4 w-4" fill="currentColor"
                               viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                          </svg>
                        </span>
                      </th>
                      <th class="font-semibold tracking-wider text-left text-white" scope="col">
                        Crear reserva
                      </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in items.data" :key="item.id">
                      <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap capitalize">
                        {{ item.start }}
                      </td>
                      <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap capitalize">
                        {{ item.name_program }}
                      </td>
                      <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap capitalize">
                        {{ item.name_type_class }}
                      </td>
                      <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap capitalize">
                        {{ item.name_classroom }}
                      </td>
                      <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                        {{ item.max_student }}
                      </td>
                      <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                        {{ item.reserved }}
                      </td>
                      <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                        <Link v-if="item.status === 'activo'" :href="route('booking.booking')" :data="{ id_available: item.id, id_student: student.id }" method="post"
                              class="text-sm text-gray-700 underline">
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
