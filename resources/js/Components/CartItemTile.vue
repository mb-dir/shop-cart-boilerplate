<script setup>
import { useForm, router } from "@inertiajs/vue3";

const props = defineProps({
    item: { type: Object, required: true },
});

const form = useForm({
    quantity: props.item.quantity,
});

function onChange() {
    form.patch(route("cart.item.update", { cartItem: props.item }));
}
</script>

<template>
    <div
        class="p-4 bg-white rounded-lg shadow-md flex items-center space-x-4 w-100 mb-4"
    >
        <div class="flex-1">
            <h2 class="text-lg font-semibold">{{ item.name }}</h2>
            <p class="text-gray-600">
                {{ item.price }} | {{ $page.props.activeCurrency.code }}
            </p>
        </div>
        <div class="flex items-center space-x-2">
            <input
                @change="onChange"
                type="number"
                min="1"
                v-model="form.quantity"
                class="w-16 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <button
                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                @click="
                    router.delete(
                        route('cart.item.destory', { cartItem: item })
                    )
                "
            >
                Delete item
            </button>
        </div>
    </div>
</template>
