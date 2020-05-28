<template>
    <div>
        <header class="bg-blue-800 py-4 shadow-md">
            <nav class="container mx-auto flex items-center text-white">
                <router-link to="/" class="no-underline text-xl text-white mr-12">Home</router-link>
                <router-link to="/orders" class="no-underline text-xl text-white mr-12">Orders</router-link>
                <router-link to="/products" class="no-underline text-xl text-white mr-12">Products</router-link>
            </nav>
        </header>
        <div class="container mx-auto py-12">
            <router-view/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "App"
    }
</script>