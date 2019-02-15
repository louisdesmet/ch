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
        mounted() {
            if(this.product.id == 40 || this.product.id == 41 || this.product.id == 42 || this.product.id == 43) {
                this.$router.push({ name: 'cart', params: { product: this.product, options: ['', ''] }})
            }
        }
    }
</script>
