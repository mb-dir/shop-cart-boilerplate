<script setup>
import { usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    item: { type: Object, required: true },
});

const page = usePage();
const cartItems = computed(() => page.props.cart.items);

// Find the cart item related to the current product
const retrivedItem = computed(() =>
    cartItems.value?.find((item) => item.product_id === props.item.id)
);

function onAddToCart() {
    if (retrivedItem.value) {
        // Update the existing cart item
        router.patch(
            route("cart.item.update", {
                cartItem: retrivedItem.value,
            })
        );
    } else {
        // Create a new cart item
        router.post(
            route("cart.item.store", {
                product: props.item,
                quantity: 1,
            })
        );
    }
}
</script>

<template>
    <div class="product">
        <img class="product-image" :src="item.photo" alt="" />
        <div class="product-details">
            <h2 class="product-name">{{ item.name }}</h2>
            <p class="product-price">${{ item.price }}</p>
            <button class="add-to-cart-button" @click="onAddToCart">
                Add to cart
            </button>
        </div>
    </div>
</template>

<style scoped>
.product {
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 1.5rem;
    width: 100%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background-color: #fff;
}

.product:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.product-image {
    width: 100%;
    max-width: 300px;
    border-radius: 8px;
    object-fit: cover;
    margin-bottom: 1rem;
}

.product-details {
    text-align: center;
}

.product-name {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #333;
}

.product-price {
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 1rem;
    color: #666;
}

.add-to-cart-button {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    font-weight: 600;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.add-to-cart-button:hover {
    background-color: #0056b3;
}
</style>
