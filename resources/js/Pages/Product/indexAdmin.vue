<template>
    <Head title="List Users" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Lista de Productos
                </h2>
                <a :href="route('products.create')" type="button"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-6 border border-blue-700 rounded mt-0 mb-0 ">
                    Crear 
                </a>
                
            </div>
        </template>
        <div class="py-12 mt-1">
            
            
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
                                                Descripcion
                                            </th>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Imagen
                                            </th>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Cualquier Cosa
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="(product,index) in products.data" :key="index">
                                            
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{product.name}}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{product.description}}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <span type="hidden">
                                                    <img v-bind:src=" product.photo " class="img-responsive object-cover h-20 w-20 ..." >
                                                </span>
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <a :href="route('products.edit',product.id)" type="button"
                                                    class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 border border-amber-700 rounded">
                                                    Editar
                                                </a>
                                                <a :href="route('products.edit',product.id)" type="button"
                                                    class="bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 border border-emerald-700 rounded">
                                                    Habilitar
                                                </a>
                                            </td>
                                        
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <pagination class="mt-6 flex justify-center" :links="products.links" />
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import { Link, Head} from '@inertiajs/inertia-vue3';
import Pagination from '../../Components/Pagination';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
export default {
    components: {
        Link,
        Pagination,
        Head,
        BreezeAuthenticatedLayout

    },
    props:['products','info'],
}
</script>
