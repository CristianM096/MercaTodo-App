<template>
    <Head title="Invoice Report"/>

    <BreezeAuthenticatedLayout>
        
    </BreezeAuthenticatedLayout>
</template>
<script>
import { Link, Head, useForm} from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';

export default {
    components: {
        Link,
        Head,
        useForm,
        BreezeAuthenticatedLayout,
    },
}
</script>
