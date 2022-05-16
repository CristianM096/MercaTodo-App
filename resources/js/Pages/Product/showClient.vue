<template>
    <Head title="View Product" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl leading-tight" >
                    View Product
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
            <featured :featured="product"></featured>
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
        Head,
        Link,
        BreezeAuthenticatedLayout,
        Featured,
    },
    props:{
        product: Object,
        qtyCart: Number,
    },

}
</script>