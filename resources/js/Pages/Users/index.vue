<template>
    <Head title="List Users" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                Lista de Usuarios
            </h2>
        </template>
        
        <div class="py-12">
            <div class="mx-8 my-8">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow-md sm:rounded-lg">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Nombre
                                            </th>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Apellido
                                            </th>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Correo
                                            </th>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Estado
                                            </th>
                                            <th scope="col" class="relative py-3 px-6">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="(user,index) in users" :key="index">
                                            
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{user.first_name}}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{user.last_name}}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{user.email}}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400" v-if="user.active"> 
                                                <p class="text-lime-400">activo</p> 
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400" v-if="!user.active">
                                                <p class="text-red-500">inactivo</p> 
                                            </td>
                                            <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                                <a :href="route('users.edit', user.id )" class="text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:underline">Actualizar</a>
                                            </td>  
                            
                                        
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
    },
    props:['users'],
}
</script>