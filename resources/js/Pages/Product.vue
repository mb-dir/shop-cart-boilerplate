<script setup>
import AuthLayout from "../Layouts/AuthLayout.vue";

const props = defineProps({
    products: { type: Array, required: true },
});
</script>

<template>
    <AuthLayout>
        <div class="products">
            <div class="product" v-for="product in products">
                {{ product.name }}
                <div class="right">
                    {{ product.price }}

                    <button>Add to cart</button>
                </div>
            </div>
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
