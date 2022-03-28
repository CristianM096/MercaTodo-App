<template>
    <Head title="List Users" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear de Producto
            </h2>
        </template>

        <div class="py-12 flex justify-center">
            <BreezeValidationErrors class="mb-4" />
            <form class="w-full max-w-lg" @submit.prevent="submit" method="POST" enctype="multipart/form-data" >
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Nombre del Producto " v-model="form.name" >
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-price" type="text" placeholder="Precio" v-model="form.price">
                    </div>
                </div>
                <div>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-8 px-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-description" type="text" placeholder="Description" v-model="form.description">
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                            Color
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-color" v-model="form.color">
                                <option>Blanco</option>
                                <option>Amarillo</option>
                                <option>Azul</option>
                                <option>Verde</option>
                                <option>Rojo</option>
                                <option>Negro</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-peso">
                            Peso
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-weight" type="number" placeholder="10.50" v-model="form.weight">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-stock">
                            Cantidad
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-stock" type="number" placeholder="12" v-model="form.stock">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-size">
                            Dimensiones
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 bor/der border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-size" type="text" placeholder="20cmx40cmx80cm" v-model="form.size">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-category">
                            Categoría
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-category" v-model="form.category">
                                
                                <option v-for="category in categories" :key="category.id" :value="category.id" > {{category.description}}</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mt-6 mb-6 md:mb-0">
                        <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" id="checkbox" v-model="form.active">
                        <label class="form-check-label inline-block text-gray-800" for="checkbox">
                            Activo
                        </label>
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-5 mx-7">
                    <img id="imageSelected" stryle="max-height: 300px;">
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full mt-8 md:w-2/3 px-3 mb-6 md:mb-0">
                        <div class="rounded-lg shadow-xl bg-gray-50 ">
                            <label class="inline-block mb-2 text-gray-500">Upload
                                Image(jpg,png,svg,jpeg)</label>
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300" >
                                    <div class="flex flex-col items-center justify-center pt-7">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-12 h-12 text-gray-400 group-hover:text-gray-600" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                            Select a photo</p>
                                    </div>
                                    <input type="file" name="photo" id="photo" class="opacity-0" @input="form.photo = $event.target.files[0]">
                                    
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="w-full mt-8 md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-stock">
                            Descuento
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-discount" type="number" placeholder="40" v-model="form.discount">
                    </div>
                </div>
                <button type='submit' 
                    class="px-4 py-2 text-white bg-green-500 rounded shadow-xl" 
                    :class="{'opacity-25': form.processing}" >
                    Crear
                </button>
                <a class="px-4 py-2 text-white bg-red-500 rounded shadow-xl" 
                    :href="route('products.index')" type="button" >
                    Cancel
                </a>
            </form>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>

import BreezeButton from '@/Components/Button.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Head, useForm} from '@inertiajs/inertia-vue3';
export default {

    components: {
        BreezeButton,
        BreezeValidationErrors,
        BreezeAuthenticatedLayout,
        Head,
    },
    props:['categories'],
    data() {
        return {
            form: useForm({
                name: '',
                price: '',
                photo: null,
                description: '',
                stock: '',
                color: '',
                weight: '',
                active: true,
                size: '',
                category: 0,
                discount: 0,
            },{
                resetOnSuccess: false,
            }),
            preview: null,
        }
    },


    methods: {
        submit() {
            this.form.post(this.route('products.store'),
                {
                    form: this.form,
                    onSuccess: ()=>{
                        Toast.fire({
                        icon: 'success',
                        title: 'Se creo Satisfactoriamente el Producto'
}                       )
                    }
                }
            )
        },
        viewImage: function(){
            $('image').change(function(){
                let reader = new FileReader();
                reader.onload = (e)=>{
                    $('imageSelected').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        },
    }
}
</script>
