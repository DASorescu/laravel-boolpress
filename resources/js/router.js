
// import vue plus router 
import Vue from 'vue'
import VueRouter from 'vue-router'

// importo i componenti
import HomePage from "./components/pages/HomePage";
import ContactsPage from "./components/pages/ContactsPage";
import AboutUsPage from "./components/pages/AboutUsPage";
import NotFoundPage from "./components/pages/NotFoundPage";
import PostDetailPage from "./components/pages/PostDetailPage";


// uso il router 
Vue.use(VueRouter)

// definizione rotte 
const routes = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        { path: '/', component: HomePage, name: 'home' },
        { path: '/about', component: AboutUsPage, name: 'about' },
        { path: '/contacts', component: ContactsPage, name: 'contacts' },
        { path: '/posts/:slug', component: PostDetailPage, name: 'post-detail' },

        // ! SEMPRE IN FONDO!
        { path: '*', component: NotFoundPage, name: 'notFound' },

    ]
});

export default routes;