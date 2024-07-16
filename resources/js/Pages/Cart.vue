<script setup>
import AuthLayout from "../Layouts/AuthLayout.vue";
import CartItem from "../Components/CartItem.vue";

const props = defineProps({
    cart: { type: Object },
});
</script>

<template>
    <AuthLayout>
        <div
            v-if="Object.keys(props.cart.items).length > 0"
            class="p-6 bg-gray-100 rounded-lg shadow-md"
        >
            <div class="space-y-4">
                <CartItem
                    :item="item"
                    v-for="item in cart.items"
                    :key="item.id"
                />
            </div>

            <div class="mt-6">
                <h2 class="text-xl font-semibold mb-2">
                    Podsumowanie koszyka:
                </h2>
                <p class="text-gray-700">
                    Cena:
                    <span class="font-medium">{{ cart.totalPrice }} PLN</span>
                </p>
                <p class="text-gray-700">
                    Ilość przedmiotów:
                    <span class="font-medium"
                        >{{ cart.totalQuantity }} szt.</span
                    >
                </p>
            </div>
        </div>
    </AuthLayout>
</template>
