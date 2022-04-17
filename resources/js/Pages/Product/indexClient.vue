<template>
    <Head title="Home" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl leading-tight" >
                    Home
                </h2>
                <Link :href="route('cart-content.index')" class=" flex rounded-full bg-transparent text-white hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                    <button v-if="qtyCart>0" class="bg-red-600 text-white h-4 w-4 rounded-full text-xs focus:outline-none">{{qtyCart}}</button>
                    <svg class="h-4 w-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 -3 24 24" stroke="currentColor">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </Link>
            </div>
        </template>
        <div class="py-12">
            <form @submit.prevent="submit" >
                <div class="flex justify-between">
                    <div class="w-full md:w-1/2 px-3">
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                        id="grid-name" 
                        type="text" 
                        placeholder="Search by Name" 
                        v-model="form.filterName">
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                        id="grid-priceMin" 
                        type="number" 
                        placeholder="Search by Min Price" 
                        v-model="form.filterMinPrice">
                    </div>
                    <h2>-</h2>
                    <div class="w-full md:w-1/2 px-3">
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                        id="grid-priceMax" 
                        type="number" 
                        placeholder="Search by Max Price" 
                        v-model="form.filterMaxPrice">
                    </div><!--
                    <div class="w-full md:w-1/2 px-3">
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                        id="grid-category" 
                        type="text" 
                        placeholder="Search by Category" 
                        v-model="form.filterCategory">
                    </div>-->
                    <div>
                        <button type='submit' 
                            class="px-4 py-2 text-white bg-green-500 rounded shadow-xl" 
                            :class="{'opacity-25': form.processing}" >
                            Search
                        </button>
                        <a class="px-4 py-2 text-white bg-red-500 rounded shadow-xl" 
                            :href="route('productsClient.index')" type="button" >
                            Clear
                        </a>
                    </div>
                </div>
            </form>
            <div>
                <div x-data="{ cartOpen: false , isOpen: false }" class="bg-white">
                    <main class="my-4">
                        <div class="container mx-auto px-6">
                            
                            <featured :featured="featured"></featured>
                            <div class="mt-16">
                                <h3 class="text-gray-600 text-2xl font-medium">More Products</h3>
                                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                                    <div v-for="(product,index) in products.data" :key="index">
                                        <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                                            <div class="flex items-end justify-end h-56 w-full bg-cover" :style="{backgroundImage:'url('+product.photo+')' }">
                                                <form @submit.prevent='addCart(product)'>
                                                    <button type="submit" class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="px-5 py-3">
                                                <h3 class="text-gray-700 uppercase"> {{product.name}}</h3>
                                                <span class="text-gray-500 mt-2"> ${{product.price}} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
            
                        <pagination class="mt-6 flex justify-center" :links="products.links" />
                    </main>

                    <footer class="bg-gray-200">
                    </footer>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import { Link, Head, useForm} from '@inertiajs/inertia-vue3';
import Pagination from '../../Components/Pagination';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import FormCart from '../../Components/FormCart';
import Featured from '../../Components/Featured';
export default {
    components: {
        Link,
        Pagination,
        Head,
        BreezeAuthenticatedLayout,
        FormCart,
        Featured,
    },
    data(){
        return{
            form: this.$inertia.form({
                filterName: '',
                filterMinPrice: '',
                filterMaxPrice: '',
                filterCategory: '',
            }),
            formCart: useForm({
                product: Object,
                qty: 1,
            }),
        }
    },
    props:{
        products: Object,
        featured: Object,
        qtyCart: Number,
    },
    methods:{
        submit() {
            this.form.get(this.route('productsClient.index'),
                this.form
            )
        },
        addCart(product){
            this.formCart.product = product;
            this.formCart.post(this.route('cart.store'),{
                onSuccess: ()=>{
                    Toast.fire({
                    icon: 'success',
                    title: 'Producto agregado al Carrito'
                    })
                }
            });
        },


    },

}

</script>
