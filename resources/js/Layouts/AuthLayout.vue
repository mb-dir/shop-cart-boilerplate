<script setup>
import { router, Link } from "@inertiajs/vue3";
import Toast from "../Components/Toast.vue";

const handleLogout = () => {
    router.post(route("logout"));
};
</script>

<template>
    <Toast />
    <header class="header">
        <Link :href="route('dashboard')">Cart boilerplate</Link>

        <nav class="navigation">
            <Link :href="route('product.index')">Products</Link>
            <Link :href="route('order.index')">Your order history</Link>
            <div class="cart-link">
                <Link :href="route('cart.index')" v-if="$page.props.cart?.items"
                    >{{ $page.props.cart.total_price }}zł({{
                        $page.props.cart.total_quantity
                    }})
                </Link>
                <span v-else>Cart is empty</span>
            </div>
            <button class="logout" @click="handleLogout">Log out</button>
        </nav>
    </header>

    <main class="main">
        <slot />
    </main>
</template>

<style scoped>
.header {
    background-color: black;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    position: sticky;
    top: 0;
}

.navigation {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.logout {
    background-color: white;
    color: black;
    border-radius: 5px;
    padding: 4px 12px;
}

.cart-link {
    border: 2px solid white;
    border-radius: 5px;
    padding: 4px 12px;
}

.main {
    display: flex;
    width: 80%;
    flex-direction: column;
    align-items: center;
    margin: 0 auto;
    padding: 1rem;
}
</style>
