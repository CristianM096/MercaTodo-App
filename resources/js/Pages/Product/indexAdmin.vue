<template>

    <Head title="List Users" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl leading-tight">
                    Lista de Productos
                </h2>
                <a :href="route('products.create')" type="button"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                    Crear
                </a>
                <a :href="route('reportInvoices.generate')" type="button"
                    class="bg-emerald-700 hover:bg-emerald-900 text-white font-bold py-2 px-4 border border-green-700 rounded">
                    Export
                </a>
                <button @click.stop="openImport()" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold px-4 border border-gray-400 rounded shadow">Importar</button>
                <modal :modal="isImport" @clicked="closeModal" @exceAction="exceAction">
                    <template #action>
                        <form @submit.prevent="importFile">
                            <div>
                                <label
                                    class="flex flex-col w-full h-32 border-4 border-blue-200 border-dashed hover:bg-gray-100 hover:border-gray-300">
                                    <div class="flex flex-col items-center justify-center pt-7">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">Attach a file</p>
                                    </div>
                                    <input type="file" class="opacity-0" @input="formImport.file = $event.target.files[0]"/>
                                </label>
                                <button type="submit" class="w-full mt-2 px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Import</button>
                            </div>
                        </form>
                    </template>
                </modal>
            </div>
        </template>
        <div class="py-12 mt-1">
            <div class="mx-8 my-8">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow-md sm:rounded-lg">
                                <table class="min-w-full table-auto">
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
                                                Activo
                                            </th>   
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Actualizar
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
                                                <div class="text-green-500" v-if="product.active">
                                                    Activo
                                                </div>
                                                <div class="text-red-500" v-if="!product.active">
                                                    Inactivo
                                                </div>

                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <a :href="route('products.edit',product.id)" type="button"
                                                    class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 border border-amber-700 rounded">
                                                    Editar
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
import { Link, Head, useForm} from '@inertiajs/inertia-vue3';
import Pagination from '../../Components/Pagination';
import Modal from '../../Components/Modal'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
export default {
    components: {
        Link,
        Pagination,
        Modal,
        Head,
        BreezeAuthenticatedLayout

    },
    props:['products','info'],
    data(){
        return{
            formImport: useForm({
                _method: 'put',
                file: null,
            }),
            isImport: false,
        }
    },
    methods:{
        importFile() {
            this.closeModal();
            this.formImport.post(this.route('products.import'));
        },
        openImport(){
            this.isImport = true;
        },
        closeModal(isImport){
            this.isImport = isImport;
        },
        exceAction(isImport){
            this.isImport = isImport;
            console.log("entre aqui");
        },
    }
}
</script>
