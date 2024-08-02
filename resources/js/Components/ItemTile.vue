<script setup>
import { usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";
const props = defineProps({
    item: { type: Object, required: true },
});

const page = usePage();

const quantity = computed(() => {
    const retrivedItem = page.props.cart.items.filter(
        (item) => item.product_id === props.item.id
    )[0];
    return retrivedItem ? retrivedItem.quantity + 1 : 1;
});
</script>

<template>
    <div class="product">
        {{ item.name }}
        <div class="right">
            {{ item.price }}

            <button
                @click="
                    router.post(route('cart.add', { product: item, quantity }))
                "
            >
                Add to cart
            </button>
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
