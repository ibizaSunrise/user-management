<template>
    <p class="text-danger" v-text="presentErrors"></p>
</template>

<script>
export default {
    name: "ValidationError",
    props: {
        errors: {
            type: Array,
            required: true,
        }
    },
    computed: {
        presentErrors() {
            return this.errors.join("\r\n")
        }
    }
}
</script>

<style scoped>

</style>
