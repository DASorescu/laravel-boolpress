<template>
    <div>
        <ul class="contacts-list">
            <li><i class="fa-solid fa-user mx-2"></i>Name:Andrei</li>
            <li><i class="fa-solid fa-phone mx-2"></i>Phone:3378380759</li>
            <li><i class="fa-solid fa-location-dot mx-2"></i>Address:<strong>Via Rocco Siffredi 27</strong></li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'ContactsPage'
}
</script>
<style scoped lang="scss">
.contacts-list {
    list-style-type: none;
}
</style>