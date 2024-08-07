<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";

const props = defineProps({
    confirmedOrders: { type: Array, required: true },
    unconfirmedOrders: { type: Array, required: true },
});
</script>

<template>
    <AuthLayout>
        <h1>The history of your orders</h1>

        <div v-if="confirmedOrders.length > 0">
            <h2>Confirmed orders</h2>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Payment Type</th>
                        <th>Delivery Type</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Main Street</th>
                        <th>House Number</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in confirmedOrders" :key="order.id">
                        <td>{{ order.id }}</td>
                        <td>{{ order.payment_type }}</td>
                        <td>{{ order.delivery_type }}</td>
                        <td>{{ order.phone }}</td>
                        <td>{{ order.city }}</td>
                        <td>{{ order.main_street }}</td>
                        <td>{{ order.house_number }}</td>
                        <td>{{ order.status }}</td>
                        <td>
                            {{ new Date(order.created_at).toLocaleString() }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="unconfirmedOrders.length > 0">
            <h2>Unconfirmed orders</h2>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Payment Type</th>
                        <th>Delivery Type</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Main Street</th>
                        <th>House Number</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in unconfirmedOrders" :key="order.id">
                        <td>{{ order.id }}</td>
                        <td>{{ order.payment_type }}</td>
                        <td>{{ order.delivery_type }}</td>
                        <td>{{ order.phone }}</td>
                        <td>{{ order.city }}</td>
                        <td>{{ order.main_street }}</td>
                        <td>{{ order.house_number }}</td>
                        <td>{{ order.status }}</td>
                        <td>
                            {{ new Date(order.created_at).toLocaleString() }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthLayout>
</template>

<style scoped>
.order-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 18px;
    text-align: left;
}

.order-table th,
.order-table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

.order-table th {
    background-color: #f2f2f2;
}

.order-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.order-table tr:hover {
    background-color: #f1f1f1;
}
</style>
