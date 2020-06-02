<template>
    <div class="flex flex-col h-screen">
        <header class="bg-blue-800 py-4 shadow-md">
            <nav class="container mx-auto flex items-center text-white">
                <router-link :to="{ name: 'home' }" class="no-underline text-xl text-white mr-12">Главная</router-link>
                <router-link :to="{ name: 'order.list'}" class="no-underline text-xl text-white mr-12">Заказы
                </router-link>
                <router-link :to="{ name: 'product.list' }" class="no-underline text-xl text-white mr-12">Продукты
                </router-link>
            </nav>
        </header>
        <main class="flex flex-1">
            <transition name="fade">
                <router-view></router-view>
            </transition>
        </main>
        <footer class="py-4 text-center text-gray-500 text-xs">&copy; 2020 - <a href="https://github.com/vlameh" target="_blank">VladMeh</a></footer>
    </div>
</template>

<script>
    export default {
        name: "App"
    }
</script>