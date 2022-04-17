<template>
    

    <BreezeAuthenticatedLayout>
        <template #header>
                <h2 class="font-semibold text-xl leading-tight">
                    Carrito De Compras
                </h2>
        </template>
            <div class="flex justify-end">
                    <div class="m-4">
                        <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                             <a :href="route('productsClient.index')" type="button">Seguir Comprando</a>
                        </button>
                    </div>
                    <div class="m-4">
                        <!-- <form  @submit.prevent="submit">
                            <button type="submit" class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                                Realizar Compra
                            </button>
                        </form> -->
                        <button v-if="cartContent.length != 0" type="button" class="text-gray-900 bg-[#F7BE38] hover:bg-[#F7BE38]/90 focus:ring-4 focus:outline-none focus:ring-[#F7BE38]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2">
                            <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="paypal" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M111.4 295.9c-3.5 19.2-17.4 108.7-21.5 134-.3 1.8-1 2.5-3 2.5H12.3c-7.6 0-13.1-6.6-12.1-13.9L58.8 46.6c1.5-9.6 10.1-16.9 20-16.9 152.3 0 165.1-3.7 204 11.4 60.1 23.3 65.6 79.5 44 140.3-21.5 62.6-72.5 89.5-140.1 90.3-43.4 .7-69.5-7-75.3 24.2zM357.1 152c-1.8-1.3-2.5-1.8-3 1.3-2 11.4-5.1 22.5-8.8 33.6-39.9 113.8-150.5 103.9-204.5 103.9-6.1 0-10.1 3.3-10.9 9.4-22.6 140.4-27.1 169.7-27.1 169.7-1 7.1 3.5 12.9 10.6 12.9h63.5c8.6 0 15.7-6.3 17.4-14.9 .7-5.4-1.1 6.1 14.4-91.3 4.6-22 14.3-19.7 29.3-19.7 71 0 126.4-28.8 142.9-112.3 6.5-34.8 4.6-71.4-23.8-92.6z"></path></svg>
                            <a :href="route('webcheckout.index')"> Comprar</a>
                        </button>
                    </div>
            </div>
        <div class="m-5 bg-white">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="pl-10 bg-white text-left border-gray-200 font-semibold uppercase text-gray-600">
                            Nombre
                        </th>
                        <th class="text-center bg-white text-left border-gray-200 font-semibold uppercase text-gray-600">
                            Precio
                        </th>
                        <th class="text-left bg-white text-left border-gray-200 font-semibold uppercase text-gray-600">
                            Cantidad
                        </th>

                        <th class="text-center bg-white text-left border-gray-200 font-semibold uppercase text-gray-600">
                            Accion
                        </th>
                        <th class="text-center bg-white text-left border-gray-200 font-semibold uppercase text-gray-600">
                            SubTotal
                        </th>
                    </tr>
                </thead>
                <tbody >
                    <tr v-for="(product,index) in cartContent" :key="index">
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            <div class="ml-3">
                                <p class="text-left text-gray-900 whitespace-no-wrap">
                                    {{product.name}}
                                </p>
                            </div>
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            <p class=" text-center text-gray-900 whitespace-no-wrap">
                                {{product.price}}
                            </p>
                        </td>
                        <td class="py-2 border-b border-gray-200 bg-white text-sm ">
                            <div class="items-center">
                                <formCart :product="product"></formCart>
                            </div>
                        </td>
                        <td class=" py-2 border-b border-gray-200 bg-white text-sm ">
                            <p class="text-gray-900 whitespace-no-wrap text-center ">
                                    <Link @click="this.delete(product.rowId)" class="text-red-700">Quitar</Link>
                            </p>
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            <div class="ml-3">
                                <p class="text-center text-gray-900 whitespace-no-wrap">
                                    {{product.subtotal}}
                                </p>
                            </div>
                        </td>
                        
                    </tr>
                    <div>
                        <br>
                        
                    </div>
                </tbody>
            </table>
            <div class="w-full my-5 ">
                <hr>
                <h3 class="font-semibold mr-20 text-right text-base text-blueGray-700">Total:{{this.total()}}</h3>
            </div>
        </div>
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
        delete(id) {
            this.$inertia.get(route("cart.delete", id));            
        },
        submit(){
            this.form.post(route('webcheckout.store'));
        },
        total(){
            let total = 0;
            for (let product in this.$props.cartContent){
                total += this.$props.cartContent[product].subtotal;
            }
            return total;
        },
    }
}
</script>
