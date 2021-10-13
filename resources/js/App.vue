<template>
    <div class="container my-4">
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    mounted() {
        this.$root.$on('error', function (error) {
            Vue.$toast.open({
                message: error,
                type: 'error',
            });
        }).$nextTick()
        this.$root.$on('success', function (message) {
            Vue.$toast.open({
                message: message,
                type: 'success',
            });
        }).$nextTick()
    }
}
</script>
