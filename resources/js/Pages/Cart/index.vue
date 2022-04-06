<template>
    

    <BreezeAuthenticatedLayout>
        <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
                        <a :href="route('webcheckout.index')"> Comprar</a>
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
