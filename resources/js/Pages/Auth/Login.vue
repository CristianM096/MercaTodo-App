<template>
    <Head title="Log in" />
    <BreezeValidationErrors class="mb-4" />
    <!--<BreezeValidationErrors class="mb-4" />-->
    <div class="min-h-screen" :style="{'background-image':'url('+background+')','background-size':'cover'}">
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div class="flex justify-center py-44">
            <!-- <div class="block rounded-lg shadow-lg max-w-sm text-center bg-opacity-20 bg-black "> -->
            <div class="grid grid-cols-1 divide-y ">
                <div class="bg-black bg-opacity-40 block rounded-lg">
                    <div class="flex mb-2 justify-around">
                        <div>
                            <h3 class="object-top font-sans p-5 text-white text-3xl font-medium ">Sign In</h3>
                        </div>
                        <div class="ml-8 flex float-right justify-around ">
                            <!-- Twitter svg -->
                            <a href="#" class="">
                                <svg class=" fill-yellow-400 h-20 w-16 text-brand-light-green" viewBox= "0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                    <path 
                                        d="M13.422 20.008v-7.29h2.489l.356-2.843h-2.845V8.097c0-.8.267-1.422 1.422-1.422h1.511V4.097c-.355 0-1.244-.09-2.222-.09a3.431 3.431 0 0 0-3.644 3.734v2.134H8v2.844h2.489v7.289h2.933z" />
                                        
                                </svg>
                            </a>
                            <!-- Twitter svg -->
                            <a href="#">
                                <svg class=" fill-yellow-400 h-20 w-20 text-brand-light-green" viewBox= "0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.067 18.978A9.25 9.25 0 0 0 18.4 9.644V9.2A7.225 7.225 0 0 0 20 7.511a7.379 7.379 0 0 1-1.867.533 3.458 3.458 0 0 0 1.422-1.778 8.153 8.153 0 0 1-2.044.8A3.176 3.176 0 0 0 15.111 6a3.34 3.34 0 0 0-3.289 3.289c-.02.24.01.483.089.711a9.19 9.19 0 0 1-6.756-3.467 3.4 3.4 0 0 0-.444 1.689 3.532 3.532 0 0 0 1.422 2.756 3 3 0 0 1-1.511-.444 3.25 3.25 0 0 0 2.667 3.2 2.74 2.74 0 0 1-.889.089 1.512 1.512 0 0 1-.622-.089 3.368 3.368 0 0 0 3.111 2.311A6.711 6.711 0 0 1 4.8 17.467c-.27.014-.54-.016-.8-.089a8.39 8.39 0 0 0 5.067 1.6z" />
                                </svg>
                            </a>
                            <!-- Instagram svg -->
                            <a href="#">
                                <svg class="fill-yellow-400 h-20 w-20  text-brand-light-green" viewBox= "0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 5.422a24.53 24.53 0 0 1 3.2.089 4.123 4.123 0 0 1 1.511.267c.666.31 1.2.845 1.511 1.511.183.483.273.995.267 1.511 0 .8.089 1.067.089 3.2.04 1.068.01 2.136-.089 3.2a4.123 4.123 0 0 1-.267 1.511c-.31.666-.845 1.2-1.511 1.511a4.123 4.123 0 0 1-1.511.267c-.8 0-1.067.089-3.2.089-1.068.04-2.136.01-3.2-.089a4.123 4.123 0 0 1-1.511-.267 3.122 3.122 0 0 1-1.511-1.511 4.123 4.123 0 0 1-.267-1.511c0-.8-.089-1.067-.089-3.2a24.53 24.53 0 0 1 .089-3.2 4.123 4.123 0 0 1 .267-1.511c.155-.33.365-.63.622-.889a1.5 1.5 0 0 1 .889-.622A4.123 4.123 0 0 1 8.8 5.511a24.53 24.53 0 0 1 3.2-.089zM12 4a26.266 26.266 0 0 0-3.289.089 5.488 5.488 0 0 0-1.955.355 3.48 3.48 0 0 0-1.422.889 3.48 3.48 0 0 0-.89 1.423 4.05 4.05 0 0 0-.355 1.955A26.266 26.266 0 0 0 4 12c-.04 1.097-.01 2.196.089 3.289-.001.668.12 1.331.356 1.956a3.48 3.48 0 0 0 .889 1.422 3.48 3.48 0 0 0 1.422.889 5.487 5.487 0 0 0 1.956.356c1.093.098 2.191.127 3.288.088 1.097.04 2.196.01 3.289-.089a5.488 5.488 0 0 0 1.956-.356 3.73 3.73 0 0 0 2.311-2.311 5.488 5.488 0 0 0 .356-1.956C19.911 14.4 20 14.133 20 12a26.26 26.26 0 0 0-.089-3.289 5.487 5.487 0 0 0-.356-1.956 3.48 3.48 0 0 0-.889-1.422 3.48 3.48 0 0 0-1.422-.889 5.488 5.488 0 0 0-1.955-.355A26.266 26.266 0 0 0 12 4zm0 3.911A4.023 4.023 0 0 0 7.911 12 4.089 4.089 0 1 0 12 7.911zm0 6.756A2.62 2.62 0 0 1 9.333 12 2.62 2.62 0 0 1 12 9.333 2.62 2.62 0 0 1 14.667 12 2.62 2.62 0 0 1 12 14.667zm4.267-7.911a.978.978 0 1 0 .978.978.986.986 0 0 0-.978-.978" />
                                </svg>
                            </a>
                            
                        </div>
                    </div>
                    <div class="flex mb-4 mt-4 justify-center">
                        <form @submit.prevent="submit" class="w-11/12 justify-center">
                            <div class="flex h-9 w-full my-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 rounded-l-lg bg-yellow-400" viewBox="-2 -5 30 30" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <input type="text" class=" w-full rounded-r-lg border-none " placeholder="username" v-model="form.email" required autofocus autocomplete="username">
                            </div>

                            <div class="flex h-9 w-full my-4">
                                <svg xmlns="http://www.w3.org/2000/svg"  class="w-12 rounded-l-lg bg-yellow-400" viewBox="-2 -5 30 30" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd" />
                                </svg>
                                <input type="password" class="w-full rounded-r-lg border-none " placeholder="password" v-model="form.password" required autocomplete="current-password">
                            </div>

                            <div class="flex justify-left my-4">
                                <BreezeCheckbox class="mt-1"  name="remember" v-model:checked="form.remember" />
                                <p class="ml-2 text-center"> Remember Me</p>
                            </div>

                            <div class="flex justify-end">
                                <button class="bg-yellow-400 hover:bg-yellow-700 text-black py-2 px-8 rounded" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                    <hr class="divide-gray-700 border-slate-700 mt-4 mb-2">
                    <div class="text-center my-4">
                        <div class="flex justify-center">
                            <p class="text-white"> Don't have an account? </p> <a :href="route('register')" class="text-yellow-600">Sign Up</a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-yellow-600 hover:text-gray-900">
                                Forgot your password?
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {

    components: {
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
        background:String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>
