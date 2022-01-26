<template>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Imagen</th>
                <th>Cualquier cosa</th>
            </tr>
        </thead>
        <tbody v-for="(product,index) in products.data" :key="index">
            <tr> 
                <td>{{ product.name }}</td>
                <td>{{ product.description }}</td>
                <td>
                    <img src="/img/{{ product.photo }}" width="60%">
                </td>
                <td>cualquier cosa x2</td>
            </tr>
            
        </tbody>
    </table>
    <div>
        {{ products.links() }}
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
