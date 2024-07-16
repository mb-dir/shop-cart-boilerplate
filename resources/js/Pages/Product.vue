<script setup>
import AuthLayout from "../Layouts/AuthLayout.vue";
import ItemTile from "../Components/ItemTile.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    products: { type: Array, required: true },
});
</script>

<template>
    <AuthLayout>
        <div class="products">
            <ItemTile v-for="item in products" :item />
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
