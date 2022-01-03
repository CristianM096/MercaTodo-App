<template>
    <Head title="Edit User" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Actualizar Usuario
            </h2>
        </template>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <BreezeLabel for="first_name" value="Primer Nombre" />
                                <BreezeInput id="first_name" type="text" v-model="form.first_name" class="mt-1 block w-full"  required autofocus autocomplete="first_name" />
                            </div>
                            <div>
                                <BreezeLabel for="last_name" value="Segundo Nombre" />
                                <BreezeInput id="last_name" type="text" v-model="form.last_name" class="mt-1 block w-full"  required autofocus autocomplete="last_name" />
                            </div>
                            <div>
                                <BreezeLabel for="telephone" value="Telefono" />
                                <BreezeInput id="telephone" type="number" v-model="form.telephone" class="mt-1 block w-full" autofocus autocomplete="telephone" />
                            </div>
                            <div>
                                <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" v-model="form.active" id="checkbox">
                                <label class="form-check-label inline-block text-gray-800" for="checkbox">
                                    Activo
                                </label>

                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Actualizar
                                </BreezeButton>
                                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :href="route('users.index', user.id )">
                                    Cancelar
                                </BreezeButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>    
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {

    components: {
        BreezeButton,
        BreezeInput,
        BreezeAuthenticatedLayout,
        BreezeCheckbox,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    props:['user'],
    data() {
        return {
            form: this.$inertia.form({
                first_name: this.$props.user.first_name ,
                last_name: this.$props.user.last_name,
                telephone: parseInt(this.$props.user.telephone),
                active: this.$props.user.active!=0?true:false,
                terms: false,
            })
        }
    },


    methods: {
        submit() {
            this.form.put(this.route('users.update',this.$props.user),
                this.form
            )
        }
    }
}
</script>
