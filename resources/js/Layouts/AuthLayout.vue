<script setup>
import { router, Link } from "@inertiajs/vue3";

const handleLogout = () => {
    router.post(route("logout"));
};
</script>

<template>
    <header>
        <nav
            class="bg-white border-gray-200 px-4 lg:px-6 py-6 dark:bg-gray-800"
        >
            <div
                class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl"
            >
                <span
                    class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"
                    >Cart boilerplate</span
                >
                <div class="flex items-center lg:order-2">
                    <button
                        @click="handleLogout"
                        class="text-gray-800 dark:text-white focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2"
                    >
                        Log out
                    </button>
                    <Link :href="route('product.get')" class="link"
                        >Products</Link
                    >
                </div>
            </div>
        </nav>
    </header>

    <main class="main">
        <slot />
    </main>
</template>

<style scoped>
.main {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.link {
    color: white;
}
</style>
