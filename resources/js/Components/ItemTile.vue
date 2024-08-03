<script setup>
import { usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";
import { ref } from "vue";

const props = defineProps({
    item: { type: Object, required: true },
});

const page = usePage();
const cartItems = ref(page.props.cart.items);

// Find the cart item related to the current product
const retrivedItem = computed(() =>
    cartItems.value.find((item) => item.product_id === props.item.id)
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
        {{ item.name }}
        <div class="right">
            {{ item.price }}
            <button @click="onAddToCart">Add to cart</button>
        </div>
    </div>
</template>
<style scoped>
.product {
    border: 1px solid black;
    padding: 1rem 2rem;
    width: 650px;
    display: flex;
    justify-content: space-between;
}

.right {
    display: flex;
    gap: 1rem;
}
</style>
