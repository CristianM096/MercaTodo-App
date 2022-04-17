<template>
    <div>
        <div class="md:flex md:items-center">
            <div class="w-full h-64 md:w-1/2 lg:h-96">
                <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" :src="featured.photo">
            </div>
            <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                <h3 class="text-gray-700 uppercase text-lg">{{featured.name}}</h3>
                <span class="text-gray-500 mt-3">{{featured.price}}</span>
                <hr class="my-3">
                <div class="mt-2">
                    <label class="text-gray-700 text-sm" for="count">{{featured.stock}}:</label>
                    <form @submit.prevent="submit(featured)">
                        <div class="flex items-center mt-1">
                            <button type="button" @click="increase(-1)" class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                            <span class="text-gray-700 text-lg mx-2">{{form.qty}}</span>
                            <button type="button" @click="increase(1)" class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                        </div>
                        <label for="">Agregar al carrito</label>
                        <button type="submit" class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </button>
                    </form>
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 text-sm" for="count">Color: </label>
                    <label :style="{'color':featured.color}">{{featured.color}}</label>
                    
                    <div class="flex items-center mt-1">
                        <button :style="{'background':featured.color}" class="h-5 w-5 rounded-full mr-2 focus:outline-none"></button>
                    </div>
                </div>
            </div>
        </div>


<!-- 
        <form @submit.prevent="submit" class="md:flex">
            
            <div class="flex ">
                <button type="submit" v-if="this.form.quantity>=0" @click="this.form.quantity-=1" class="text-center text-gray-500 focus:outline-none focus:text-gray-600">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
                <span class="text-center text-gray-700 text-lg mx-2">{{this.form.quantity}}</span>
                <button type="submit" @click="this.form.quantity+=1" class="text-gray-500 focus:outline-none focus:text-gray-600">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
            </div>
        </form> -->
    </div>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3';
    import BreezeButton from '@/Components/Button.vue'
    export default {
        components: {
        BreezeButton
        },  

        props: {
            featured: Object,
        },
        data(){
            return{
                form: useForm({
                    product: this.$props.featured,
                    qty: 1,
                }),
            }
        },
        methods:{
            submit(product){
                this.form.product = product;
                this.form.qty = 1;
                this.form.post(this.route('cart.store'),{
                    onSuccess: ()=>{
                        Toast.fire({
                        icon: 'success',
                        title: 'Producto agregado al Carrito'
                        })
                    },
                    onFinish: ()=> this.form.reset('product','qty'),
                });
            },
            
            increase(sum){
                if(this.form.qty <= this.featured.stock && this.form.qty > 0){
                    this.form.qty+=sum;
                    if(this.form.qty>=this.featured.stock){
                        this.form.qty = this.featured.stock;
                    }
                    if(this.form.qty <= 0){
                        this.form.qty = 1;
                    }

                }
            },
        }
    }
</script>