<template>
    <Head title="Invoice Report"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                Reporte de Factura
            </h2>
        </template>
        <BreezeValidationErrors class="mb-4" />
        <div class="max-w-4xl mt-10 flex justify-center mx-auto rounded overflow-hidden shadow-lg">
            
            <img width="200" class="m-4 w-1/3" src="http://127.0.0.1:8000/storage/img/pdf.svg" alt="">
            <form @submit.prevent="submit" action="generate" ref="form" class="w-2/3">
                <div class="grid grid-cols-1 gap-3 justify-items-center">
                    <div class="w-full">
                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-sky-600 bg-sky-200 uppercase last:mr-0 mr-1">
                            <label for="initialDate">Fecha inicial</label>
                        </span>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input name="initialDate" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" v-model="form.initialDate">
                        </div>
                    </div>
                    <div class="w-full">
                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-sky-600 bg-sky-200 uppercase last:mr-0 mr-1">
                            <label for="endDate">Fecha Final</label>
                        </span>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input name="endDate" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" v-model="form.endDate">
                        </div>
                    </div>
                    <div class="">
                        <button class="bg-teal-500 text-white active:bg-teal-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:bg-teal-800 hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="submit">Obtener reporte</button>
                    </div>
                </div>  
            </form>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
import { Link, Head, useForm} from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

export default{
    components: {
        Link,
        Head,
        useForm,
        BreezeAuthenticatedLayout,
        BreezeValidationErrors,
    },
    props: [
        'initialDate',
        'endDate',
    ],
    data(){
        return{
            form: useForm({
                _method: 'put',
                initialDate: this.$props.initialDate,
                endDate: this.$props.endDate,
            }),
        }
    },
    methods: {
        submit: function(){
            this.$refs.form.submit();
        },
    },
}
</script>
