<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-[#1d2541] border-transparent border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link class="flex items-center" :href="route('productsClient.index')">
                                    <BreezeApplicationLogo class="block h-9 w-auto" />
                                    <h3 class="text-white"> Mercatodo</h3>
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex" >
                                <BreezeNavLink  class="text-[#c7d8ff] focus:text-white hover:text-white" v-if="$page.props.auth.user.roles[0].name === 'Client'||$page.props.auth.user.roles[0].name === 'Admin'" :href="route('productsClient.index')" :active="route().current('productsClient.index')">
                                    Dashboard
                                </BreezeNavLink>
                                <BreezeNavLink class="text-[#c7d8ff] focus:text-white hover:text-white" v-if="$page.props.auth.user.roles[0].name === 'Admin'" :href="route('users.index')" :active="route().current('users.index')">
                                    Listar Usuarios
                                </BreezeNavLink>
                                <BreezeNavLink class="text-[#c7d8ff] focus:text-white hover:text-white" v-if="$page.props.auth.user.roles[0].name === 'Admin'" :href="route('products.index')" :active="route().current('products.index')">
                                    Listar Productos
                                </BreezeNavLink>
                                <BreezeNavLink class="text-[#c7d8ff] focus:text-white hover:text-white" v-if="$page.props.auth.user.roles[0].name === 'Admin'" :href="route('products.create')" :active="route().current('products.create')">
                                    Crear Productos
                                </BreezeNavLink>
                                <BreezeNavLink class="text-[#c7d8ff] focus:text-white hover:text-white" v-if="$page.props.auth.user.roles[0].name === 'Admin'||$page.props.auth.user.roles[0].name === 'Client'" :href="route('invoice.index')" :active="route().current('invoice.index')">
                                    Historial de Compras
                                </BreezeNavLink>
                                <BreezeNavLink class="text-[#c7d8ff] focus:text-white hover:text-white" v-if="$page.props.auth.user.roles[0].name === 'Admin'||$page.props.auth.user.roles[0].name === 'Client'" :href="route('reportInvoices.index')" :active="route().current('reportInvoices.index')">
                                    Reporte de Facturas
                                </BreezeNavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <BreezeDropdown  align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="bg-[#041C32] inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-white hover:text-yellow-400 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.first_name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </BreezeDropdownLink>
                                        <BreezeDropdownLink :href="route('users.index')" as="button">
                                            List User
                                        </BreezeDropdownLink>
                                        <BreezeDropdownLink :href="route('products.index')" as="button">
                                            List Products
                                        </BreezeDropdownLink>
                                        <BreezeDropdownLink :href="route('products.create')" as="button">
                                            Create Products
                                        </BreezeDropdownLink>
                                        <BreezeDropdownLink :href="route('productsClient.index')"  as="button">
                                            Dashboard
                                        </BreezeDropdownLink>
                                    </template>
                                </BreezeDropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('productsClient.index')" :active="route().current('productsClient.index')">
                            Dashboard
                        </BreezeResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.first_name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </BreezeResponsiveNavLink>
                            <BreezeResponsiveNavLink :href="route('users.index')" method="post" as="button">
                                List User
                            </BreezeResponsiveNavLink>
                            <BreezeResponsiveNavLink :href="route('productsClient.index')" method="post" as="button">
                                Dashboard
                            </BreezeResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-black border-transparent shadow" v-if="$slots.header">
                <div class="text-white max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        }
    },
}
</script>
