<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    order: { type: Object, default: null },
});

function onConfirm() {
    router.put(route("order.confirm", { order: props.order }));
}
</script>

<template>
    <AuthLayout>
        <div class="order-summary">
            <h1>Order Summary</h1>
            <div class="section">
                <h2>Delivery Address</h2>
                <p><strong>City:</strong> {{ order.city }}</p>
                <p><strong>Main Street:</strong> {{ order.main_street }}</p>
                <p><strong>House Number:</strong> {{ order.house_number }}</p>
                <p><strong>Phone:</strong> {{ order.phone }}</p>
            </div>
            <div class="section">
                <h2>Delivery meta</h2>
                <p>
                    <strong>Delivery type:</strong>
                    {{ order.delivery_type.name }}
                </p>
                <p>
                    <strong>Payment type:</strong>
                    {{ order.payment_type.name }}
                </p>
            </div>
            <div class="section">
                <h2>Orders status</h2>
                <p><strong>Status:</strong> {{ order.status.name }}</p>
            </div>
            <div class="section">
                <h2>Cart Items</h2>
                <ul>
                    <li v-for="item in order.cart.items" :key="item.id">
                        <strong>{{ item.name }}</strong> - Quantity:
                        {{ item.quantity }} - Price: {{ item.price }}
                    </li>
                </ul>
            </div>
            <button @click="onConfirm" class="place-order-btn">
                Confirm and pay
            </button>
        </div>
    </AuthLayout>
</template>

<style scoped>
.order-summary {
    width: 100%;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

.section {
    margin-bottom: 20px;
}

.section h2 {
    color: #555;
    margin-bottom: 10px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
}

p {
    margin: 5px 0;
    color: #666;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
}

.place-order-btn {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    text-align: center;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.place-order-btn:hover {
    background-color: #0056b3;
}
</style>
