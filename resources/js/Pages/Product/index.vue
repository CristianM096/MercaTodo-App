<template>
    <div>
        <h2>
            Hola pirobos
        </h2>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },
    props:['products'],
}
</script>
