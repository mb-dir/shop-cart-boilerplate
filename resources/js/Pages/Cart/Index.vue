<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import CartItemTile from "@/Components/CartItemTile.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    cart: { type: Object, default: null },
});
</script>

<template>
    <AuthLayout>
        <h1>Your cart</h1>
        <div
            v-if="props.cart && Object.keys(props.cart?.items).length > 0"
            class="cart-container"
        >
            <div>
                <CartItemTile
                    :item="item"
                    v-for="item in cart.items"
                    :key="item.id"
                />
            </div>

            <div class="cart-summary">
                <div>
                    <h2>Cart summary:</h2>
                    <p>
                        Final price:
                        <span>{{ cart.total_price }} PLN</span>
                    </p>
                    <p>
                        Final quantity:
                        <span>{{ cart.total_quantity }} pcs.</span>
                    </p>
                </div>

                <Link :href="route('order.create')">Make an order</Link>
            </div>
        </div>
        <div v-else>Cart is empty</div>
    </AuthLayout>
</template>

<style scoped>
.cart-container {
    display: grid;
    grid-template-columns: 1fr 350px;
    width: 100%;
    gap: 2rem;
}

.cart-summary {
    background: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    height: 250px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
</style>
