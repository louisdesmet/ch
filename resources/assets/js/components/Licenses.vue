<template>
<div>licenses</div>
</template>
<script>
    export default {
        data: () => ({

        }),
        mounted () {
            if(this.orders.length == 0) { this.$store.dispatch('orders'); }
        },
        computed: {
            orders() { return this.$store.getters.orders; }
        },
    }
</script>
