<script setup>
import AuthLayout from "../Layouts/AuthLayout.vue";
import CartItemTile from "../Components/CartItemTile.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    cart: { type: Object, default: null },
});
</script>

<template>
    <AuthLayout>
        <div
            v-if="props.cart && Object.keys(props.cart?.items).length > 0"
            class="p-6 bg-gray-100 rounded-lg shadow-md"
        >
            <div class="space-y-4">
                <CartItemTile
                    :item="item"
                    v-for="item in cart.items"
                    :key="item.id"
                />
            </div>

            <div class="mt-6">
                <h2 class="text-xl font-semibold mb-2">Cart summary:</h2>
                <p class="text-gray-700">
                    Final price:
                    <span class="font-medium">{{ cart.totalPrice }} PLN</span>
                </p>
                <p class="text-gray-700">
                    Final quantity:
                    <span class="font-medium"
                        >{{ cart.totalQuantity }} pcs.</span
                    >
                </p>
                <Link :href="route('order.index')">Make an order</Link>
            </div>
        </div>
        <div v-else>Cart is empty</div>
    </AuthLayout>
</template>
