<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li v-if="currentPage > 1" class="page-item" role="button" @click="changePage(currentPage - 1)">
                <span class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </span>
            </li>
            <li v-for="page in lastPage" :key="page" class="page-item" role="button"
                :class="{ active : currentPage === page }" @click="changePage(page)"><span class="page-link"
                    href="#">{{page}}</span>
            </li>
            <li class="page-item" @click="changePage(currentPage + 1)">
                <span v-if="currentPage !== lastPage" class="page-link" role="button" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </span>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "AppPagination",
    props: {
        lastPage: Number,
        currentPage: Number,
    },
    methods: {
        changePage(page) {
            this.$emit('change-page', page)
        }
    },
}
</script>

<style>

</style>