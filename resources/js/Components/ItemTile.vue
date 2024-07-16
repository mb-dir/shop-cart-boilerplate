<script setup>
import { usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";
const props = defineProps({
    item: { type: Object, required: true },
});

const page = usePage();

const quantity = computed(() => {
    return page.props.cart?.items &&
        page.props.cart.items[props.item.id]?.quantity
        ? +page.props.cart.items[props.item.id].quantity + 1
        : 1;
});
</script>

<template>
    <div class="product">
        {{ item.name }}
        <div class="right">
            {{ item.price }}

            <button
                @click="
                    router.post(route('cart.add', { id: item.id, quantity }))
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
