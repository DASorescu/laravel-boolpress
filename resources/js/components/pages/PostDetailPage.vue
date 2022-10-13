<template>
    <div id="detail">
        <AppLoader v-if="isLoading" />
        <PostCard v-else-if="!isLoading && post" :post="post" />
        <button class="btn btn-secondary" @click="$router.back()"><i class="fa-solid fa-arrow-rotate-left"></i> Torna
            Indietro</button>
    </div>
</template>

<script>
import AppLoader from '../AppLoader';
import PostCard from '../posts/PostCard';
export default {
    name: "PostDetailPage",
    components: { AppLoader, PostCard },
    data: () => ({
        post: null,
        isLoading: false,
    }),
    methods: {
        fetchPost() {
            this.isLoading = true;
            axios.get('http://127.0.0.1:8000/api/posts/' + this.$route.params.slug)
                .then((res) => {
                    this.post = res.data;
                })
                .catch((err) => {
                    console.error(err);
                })
                .then(() => {
                    this.isLoading = false;
                })
        }
    },
    mounted() {
        this.fetchPost();
    }
}
</script>
