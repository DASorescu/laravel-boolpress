<template>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>HOLY GUACAMOLE! </strong> {{error}}
        <button type="button" class="close" @click="$emit('set-error')">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
export default {
    name: "ErrorAlert",
    props: {
        error: String
    },
    methods: {

    }
}
</script>

<style>

</style>