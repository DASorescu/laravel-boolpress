<template>
    <div class="card border-primary mb-3">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title">{{post.title}}</h5>
            <router-link class="btn btn-primary d-flex align-items-center" :to="{name:'post-detail',params:{slug:post.slug}}">
                <i class="fa-solid fa-eye mx-1"></i>Vedi
            </router-link>
            </div>
            <div class="card-body">
            <p class="card-subtitle mb-2 text-muted">Pubblicato il:<strong class="mx-1">{{publishedAt}}</strong></p>
            <p class="card-subtitle mb-2 text-muted">Da:<strong class="mx-1">{{post.user.name}}</strong></p>
            <p class="card-text">{{post.content}}</p>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center bg-info">
                <span class="badge-pill" :class="`badge-${post.category ? post.category.color : 'light'}`">
                    {{post.category ? post.category.label : "Nessuna categoria assegnata"}}
                </span>
                <div>
                    <span v-for="tag in post.tags" :key="tag.id" class="badge mr-1 text-white"
                        :style="`background-color: ${tag.color}`">
                        {{tag.label}}
                    </span>
                </div>
            </div>
    </div>
</template>


<script>

export default {
    name: 'PostsCard',
    props: {
        post: Object
    },
    computed: {
        publishedAt() {
            const postDate = new Date(this.post.created_at);
            let day = postDate.getDate();
            let month = postDate.getMonth() + 1;
            const year = postDate.getFullYear();

            if (day < 10) day = "0" + day;
            if (month < 10) month = "0" + month;

            return `${day}/${month}/${year}`
        }
    },
}
</script>