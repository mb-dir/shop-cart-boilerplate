<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    confirmedOrders: { type: Array, required: true },
    unconfirmedOrders: { type: Array, required: true },
});
</script>

<template>
    <AuthLayout>
        <div class="order-history-container">
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
                            <td>
                                <Link :href="route('order.show', { order })">{{
                                    order.id
                                }}</Link>
                            </td>
                            <td>{{ order.payment_type.name }}</td>
                            <td>{{ order.delivery_type.name }}</td>
                            <td>{{ order.phone }}</td>
                            <td>{{ order.city }}</td>
                            <td>{{ order.main_street }}</td>
                            <td>{{ order.house_number }}</td>
                            <td>{{ order.status.name }}</td>
                            <td>
                                {{
                                    new Date(order.created_at).toLocaleString()
                                }}
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
                            <td>
                                <Link :href="route('order.show', { order })">{{
                                    order.id
                                }}</Link>
                            </td>
                            <td>{{ order.payment_type.name }}</td>
                            <td>{{ order.delivery_type.name }}</td>
                            <td>{{ order.phone }}</td>
                            <td>{{ order.city }}</td>
                            <td>{{ order.main_street }}</td>
                            <td>{{ order.house_number }}</td>
                            <td>{{ order.status.name }}</td>
                            <td>
                                {{
                                    new Date(order.created_at).toLocaleString()
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthLayout>
</template>

<style scoped>
.order-history-container {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

h1 {
    font-size: 32px;
    margin-bottom: 20px;
    text-align: center;
}

h2 {
    font-size: 24px;
    margin: 30px 0 15px;
    border-bottom: 2px solid #ddd;
    padding-bottom: 5px;
}

.order-table {
    width: 100%;
    max-width: 1000px;
    margin: 0 auto;
    border-collapse: collapse;
    font-size: 16px;
    text-align: left;
    table-layout: fixed;
}

.order-table th,
.order-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
}

.order-table th {
    background-color: #f5f5f5;
    font-weight: bold;
}

.order-table td {
    background-color: #fff;
}

.order-table tr:nth-child(even) td {
    background-color: #f9f9f9;
}

.order-table tr:hover td {
    background-color: #f1f1f1;
}

.order-table a {
    color: #007bff;
    text-decoration: none;
    transition: color 0.3s ease;
}

.order-table a:hover {
    color: #0056b3;
}

.order-table th:first-child,
.order-table td:first-child {
    padding-left: 20px;
}

.order-table th:last-child,
.order-table td:last-child {
    padding-right: 20px;
}
</style>
