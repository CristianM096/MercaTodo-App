<template>
    

    <BreezeAuthenticatedLayout>
        <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Carrito De Compras
                </h2>
        </template>
            <div>
                <h2 class="text-gray-600 font-semibold">Accion</h2>
                <span class="text-xs">Bienvenido a su carrito de compras</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex bg-gray-50 items-center p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                    <input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id="" placeholder="search...">
            </div>
                    <div class="lg:ml-40 ml-10 space-x-8">
                        <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                             <a :href="route('products.show')" type="button">Seguir Comprando</a>
                        </button>
                        <form  @submit.prevent="submit">
                            <button type="submit" class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                                Realizar Compra
                            </button>
                        </form>
                    </div>
                </div>
            
       
    
  <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Precio
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Cantidad
                                    </th>

                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Accion
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product,index) in cartContent" :key="index">
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{product.name}}
                                                    </p>
                                                </div>
                                        </div>
                                    </td>
                                     <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{product.price}}
                                                    </p>
                                                </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <formCart :product="product"></formCart>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                              <Link @click="destroy(product.rowId)" class="text-red-700">Quitar</Link>
                                        </p>
                                    </td>

                                    
                                </tr>
                                <div>
                                    <br>
                                    
                                </div>
                            </tbody>
    </table>
    
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Pagination from '../../Components/Pagination';
import FormCart from '../../Components/FormCart';
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        Pagination,
        FormCart,
    },
    data(){
        return{
            form: useForm({
                cartContent: this.$props.cartContent,
            }),
        }
    },


    props:['cartContent','info'],
    methods:{
        destroy(id) {
            this.$inertia.delete(route("cart.destroy", id));            
        },
        submit(){
            this.form.post(route('webcheckout.store'));
        },
    }
}
</script>
