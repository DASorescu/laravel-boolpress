<template>
    <section id="post-list">
        <h2>Posts</h2>
        <AppLoader v-if="isLoading" />
        <div v-else-if="error">
            <ErrorAlert :error="error" @set-error=deleteError />
        </div>
        <div v-else>
            <div v-if="posts.length">
                <PostCard v-for="post in posts" :key="post.id" :post="post" />
            </div>
            <h5 v-else>Nessun Post</h5>
        </div>
        <AppPagination :lastPage="pagination.last" :currentPage="pagination.current" @change-page=fetchPosts />
    </section>
</template>



<script>
import axios from "axios";
import PostCard from "./PostCard";
import AppPagination from "../AppPagination"
import AppLoader from "../AppLoader";
import ErrorAlert from "./ErrorAlert";
export default {
    name: 'PostsList',
    components: {
        PostCard,
        AppLoader,
        ErrorAlert,
        AppPagination,
    },
    data() {
        return {
            posts: [],
            isLoading: false,
            error: null,
            pagination: {
                current: null,
                last: null,
            }
        }
    },

    methods: {
        fetchPosts(page = 1) {
            this.isLoading = true;
            axios.get(`http://localhost:8000/api/posts?page=${page}`).then(res => {
                const { data, current_page, last_page } = res.data;
                this.posts = data;
                this.pagination.current = current_page;
                this.pagination.last = last_page;
            }).catch((err) => {
                this.error = "Errore durante il fetch dei post";
            }).then(() => {
                this.isLoading = false;
            })
        },
        deleteError() {
            this.error = null;
        },
    },
    mounted() {
        this.fetchPosts();
    }
}
</script>