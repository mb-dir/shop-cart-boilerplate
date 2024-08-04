<script setup>
import AuthLayout from "../Layouts/AuthLayout.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    cart: { type: Object, default: null },
});

const form = useForm({
    city: "",
    main_street: "",
    house_number: "",
    phone: "",
    payment_type: 1,
    delivery_type: 1,
});
</script>

<template>
    <AuthLayout>
        <form class="form-container">
            <h1>Delivery and Payment</h1>
            <div class="form-group">
                <label for="city">City</label>
                <input id="city" placeholder="City" v-model="form.city" />
            </div>
            <div class="form-group">
                <label for="main_street">Main Street</label>
                <input
                    id="main_street"
                    placeholder="Main Street"
                    v-model="form.main_street"
                />
            </div>
            <div class="form-group">
                <label for="house_number">House Number</label>
                <input
                    id="house_number"
                    placeholder="House Number"
                    v-model="form.house_number"
                />
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input
                    type="tel"
                    id="phone"
                    placeholder="Phone"
                    v-model="form.phone"
                />
            </div>
            <div class="form-group">
                <label>Delivery Type</label>
                <div class="radio-group">
                    <div>
                        <input
                            type="radio"
                            id="delivery1"
                            value="1"
                            v-model="form.delivery_type"
                        />
                        <label for="delivery1">Standard Delivery</label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            id="delivery2"
                            value="2"
                            v-model="form.delivery_type"
                        />
                        <label for="delivery2">Express Delivery</label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            id="delivery3"
                            value="3"
                            v-model="form.delivery_type"
                        />
                        <label for="delivery3">Pickup</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Payment Type</label>
                <div class="radio-group">
                    <div>
                        <input
                            type="radio"
                            id="payment1"
                            value="1"
                            v-model="form.payment_type"
                        />
                        <label for="payment1">Credit Card</label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            id="payment2"
                            value="2"
                            v-model="form.payment_type"
                        />
                        <label for="payment2">PayPal</label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            id="payment3"
                            value="3"
                            v-model="form.payment_type"
                        />
                        <label for="payment3">Cash on Delivery</label>
                    </div>
                </div>
            </div>
        </form>
    </AuthLayout>
</template>

<style scoped>
.form-container {
    max-width: 600px;
    width: 100%;
    margin: auto;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input[type="text"],
.form-group input[type="tel"] {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.radio-group {
    display: flex;
    gap: 10px;
}

.radio-group div {
    display: flex;
    align-items: center;
}

.radio-group label {
    margin-left: 5px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}
</style>
