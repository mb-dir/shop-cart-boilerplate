<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import ProductTile from "@/Components/ProductTile.vue";

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
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    padding: 2rem;
}
</style>
