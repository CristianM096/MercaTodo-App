<template>
    <Head title="Descargas" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl leading-tight" >
                    Descargas
                </h2>
            </div>
        </template>
        <div class="flex ">
            <a :href="route('products.downloadExport')">Descargar Productos Exportados</a>
            
        </div>
        <div>
            <a :href="route('invoices.downloadReport')">Descargar Reporte de Facturas</a>
        </div>

    </BreezeAuthenticatedLayout>
</template>
   
<script>
import { Link, Head, useForm} from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';

export default{
    components: {
        BreezeAuthenticatedLayout,
        Link,
        Head,
    },
}
</script>