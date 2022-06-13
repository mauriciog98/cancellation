<script setup>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue';
import {Link} from '@inertiajs/inertia-vue3'
</script>

<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div>
                <JetApplicationLogo class="block h-12 w-auto"/>
            </div>

            <div class="mt-8 text-2xl">
                Bienvenido a la aplicación de cancelación!
            </div>


            <Link :href="route('students.index')">
                <div class="mt-3 flex items-center text-sm font-semibold text-orange-500">
                    <div>Listado de estudiantes</div>

                    <div class="ml-1 text-orange-500">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path clip-rule="evenodd"
                                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                  fill-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </Link>


        </div>
    </div>
</template>
