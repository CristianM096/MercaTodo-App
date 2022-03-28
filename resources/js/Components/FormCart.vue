<template>
    <div>
        <form @submit.prevent="submit" class="md:flex">
            <input type="hidden" v-model="form.productId">
            <div class="flex ">
                <div class="flex w-5 ">
                    <input min="1" v-model="form.quantity"
                    class="bg-white text-sm text-gray-900 text-center focus:outline-none border border-gray-800 focus:border-gray-600 rounded-l-md w-full">
                </div>
                <div class="flex flex-col w-7 ">
                    <input value="+" v-on:click="increment" type="button" style="cursor:pointer;"
                    class="text-white text-center text-md font-semibold rounded-tr-md px-1 bg-gray-800 focus:bg-gray-600 focus:outline-none border border-gray-800 focus:border-gray-600">
                   
                    <input value="-" v-on:click="decrement" type="button" style="cursor:pointer;"
                    class="text-white text-center text-md font-semibold rounded-br-md px-1 bg-gray-800 focus:bg-gray-600 focus:outline-none border border-gray-800 focus:border-gray-600">
                    
                </div>
            </div>
            <div>
                <button type="submit" class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3';
    export default {

        props: {
            product: Object,
            visible: {
                type:Boolean,
                default: false
            },
        },
        data(){
            return{
                form: useForm({
                 quantity: '1',
                 productId: this.$props.product.id,  
                })
            }
        },
        methods:{
            submit(){
                this.form.post(this.route('cart.store'))
            },
            increment(){
                this.form.quantity++;
            },
            decrement(){
                if(this.form.quantity>1){
                    this.form.quantity--;
                }
                
            }
        }
    }
</script>