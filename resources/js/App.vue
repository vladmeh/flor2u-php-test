<template>
    <div>
        <header class="bg-blue-800 py-4 shadow-md">
            <nav class="container mx-auto flex items-center text-white">
                <router-link :to="{ name: 'home' }" class="no-underline text-xl text-white mr-12">Главная</router-link>
                <router-link :to="{ name: 'order.list'}" class="no-underline text-xl text-white mr-12">Заказы
                </router-link>
                <router-link :to="{ name: 'product.list' }" class="no-underline text-xl text-white mr-12">Продукты
                </router-link>
            </nav>
        </header>
        <div class="container mx-auto py-6">
            <transition name="fade">
                <router-view></router-view>
            </transition>
        </div>
    </div>
</template>

<script>
    export default {
        name: "App"
    }
</script>