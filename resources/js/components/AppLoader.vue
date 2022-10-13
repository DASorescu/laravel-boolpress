<template>
    <div class="loader">
        <div class="spinner-border text-primary my-3" role="status"></div>
        <div class="spinner-border text-secondary my-3" role="status"></div>
        <div class="spinner-border text-success my-3" role="status"></div>
        <div class="spinner-border text-danger my-3" role="status"></div>
        <div class="spinner-border text-warning my-3" role="status"></div>
        <div class="spinner-border text-info my-3" role="status"></div>
    </div>
</template>

<script>
export default {
    name: "AppLoader"
}
</script>

<style scoped lang="scss">
.loader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9;

    .spinner-border {
        width: 100px;
        height: 100px;
        margin: 0 2rem;
    }
}
</style>
