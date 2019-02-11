<template>
<div>
    <Esd :product="product" v-if="product.template == 'Esd'"></Esd>
</div>
</template>
<script>
    import Esd from './Esd';
    export default {
        components: {
            Esd
        },
        data: () => ({
        }),
        props: ['product'],
    }
</script>
