<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { router, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    product: { type: Object, required: true },
});

const page = usePage();
const cartItems = computed(() => page.props.cart.items);

// Find the cart item related to the current product
const retrivedItem = computed(() =>
    cartItems.value?.find((item) => item.product_id === props.product.id)
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
                product: props.product,
                quantity: 1,
            })
        );
    }
}
</script>

<template>
    <AuthLayout>
        <div class="product-container">
            <img :src="product.photo" alt="" class="product-image" />
            <div class="product-details">
                <h2>{{ product.name }}</h2>
                <div class="price">{{ product.price }}</div>
                <div class="actions">
                    <button @click="onAddToCart">Add to Cart</button>
                    <!-- Additional actions like Buy Now can go here -->
                </div>
            </div>
        </div>
    </AuthLayout>
</template>

<style scoped>
.product-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    padding: 30px;
    max-width: 900px;
    margin: 40px auto;
    align-items: center;
}

.product-image {
    width: 100%;
    border-radius: 10px;
    object-fit: cover;
}

.product-details {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: end;
}

.product-details h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 20px;
}

.product-details .price {
    font-size: 1.5rem;
    color: #007bff;
    margin-bottom: 20px;
    font-weight: bold;
}

.product-details .actions {
    display: flex;
    gap: 15px;
}

.product-details button {
    padding: 10px 20px;
    font-size: 1rem;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.product-details button:hover {
    background-color: #0056b3;
}
</style>
