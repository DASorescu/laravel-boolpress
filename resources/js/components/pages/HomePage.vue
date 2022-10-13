<template>
    <div>
        <ul>
            <PostsList />
        </ul>
    </div>
</template>

<script>
import PostsList from '../posts/PostsList'
export default {
    name: 'HomePage',
    components: { PostsList }


}
</script>
