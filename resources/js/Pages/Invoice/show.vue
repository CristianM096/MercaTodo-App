<template>
    <Head title="List Users" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Historial de Compras
                </h2>                
            </div>
        </template>
        <div>
            <section class="py-1 bg-blueGray-50">
                <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                        <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                <h3 class="font-semibold text-base text-blueGray-700">Invoice</h3>
                                <div class="flex justify-between">
                                    <p>Reference: {{invoice.reference}}</p>
                                    <p>Status: {{invoice.payment_status}}</p>
                                    <div class="flex " >
                                        <p>Pay:  
                                        <a :href="invoice.payment_url" type="button" class="underline text-teal-500">
                                            Here
                                        </a>
                                        </p>
                                    </div>
                                    <p> Total: {{invoice.total}}</p>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="block w-full overflow-x-auto">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                <h3 class="font-semibold text-base text-blueGray-700">Products</h3>
                            </div>
                        <table class="table-fixed items-center bg-transparent ">
                            <thead>
                                <tr>    
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        name </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0  font-semibold text-left">
                                        description</th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        discount</th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        price</th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        quantity</th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr v-for="(product,index) in products" :key="index"> 
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs  p-4 text-left text-blueGray-700 ">
                                            {{product.name}}</td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs  p-4 text-left text-blueGray-700 ">
                                            {{product.description}}</td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                            {{product.discount}}</td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                            {{product.pivot.price}}</td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                            {{product.pivot.quantity}}</td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                            {{product.pivot.quantity * product.pivot.price}}</td>
                                    </tr>
                            </tbody>
                        </table>
                            <hr>
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1 my-5">
                            <h3 class="font-semibold text-base text-right text-blueGray-700">Total: {{invoice.total}}</h3>
                        </div>
                        </div>
                    </div>
                </div>
                <footer class="relative pt-8 pb-6 mt-16">
                    
                </footer>
            </section>
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
    props:['invoice','products'],
}
</script>
