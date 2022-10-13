<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">{{title}}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li v-for="link in links" :key="link.name" class="nav-item">
                        <router-link class="nav-link" :to="{name: link.name}">{{link.label}}</router-link>
                    </li>
                </ul>
            </div>
        </nav>

    </div>
</template>

<script>
export default {
    name: 'AppHeader',
    data: () => ({
        links: [
            { name: 'home', label: 'Home' },
            { name: 'contacts', label: 'Contacts' },
            { name: 'about', label: 'About Us' },
        ]
    }),
    props: {
        title: String,
    }
};
</script>