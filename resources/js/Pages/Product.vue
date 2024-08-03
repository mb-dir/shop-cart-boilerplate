<script setup>
import AuthLayout from "../Layouts/AuthLayout.vue";
import ProductTile from "../Components/ProductTile.vue";

const props = defineProps({
    products: { type: Array, required: true },
});
</script>

<template>
    <AuthLayout>
        <div class="products">
            <ProductTile v-for="item in products" :item />
        </div>
    </AuthLayout>
</template>

<style scoped>
.products {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    padding: 2rem;
}
</style>
