<script setup>
import { ref, watchEffect } from "vue";
import { usePage } from "@inertiajs/vue3";

const isToastActive = ref(false);
const toastContent = ref("");
let toastTimeout;

const startToastTimeout = () => {
    //make sure there is no unnecessary timeout
    if (toastTimeout) {
        clearTimeout(toastTimeout);
    }

    toastTimeout = setTimeout(() => {
        isToastActive.value = false;
    }, 3000);
};

const closeToast = () => {
    isToastActive.value = false;
    clearTimeout(toastTimeout);
};

// https://github.com/inertiajs/inertia/issues/1218#issuecomment-1185405907
watchEffect(() => {
    const message = usePage().props.flash?.message;
    if (message) {
        toastContent.value = message;
        isToastActive.value = true;
        startToastTimeout();
    }
});
</script>

<template>
    <teleport to="body">
        <transition name="toast">
            <div v-if="isToastActive" class="toast">
                <button @click="closeToast" class="close">X</button>
                {{ toastContent }}
            </div>
        </transition>
    </teleport>
</template>

<style scoped>
.toast {
    position: fixed;
    top: 3%;
    left: 50%;
    width: 90%;
    max-width: 500px;
    transform: translateX(-50%);
    z-index: 9999;
    padding: 25px 50px;
    font-size: 12px;
    border: 1px solid black;
    background-color: white;
    border-radius: 5px;
    transition: opacity 0.5s ease-in-out;
    text-align: center;
}

.close {
    position: absolute;
    width: 18px;
    height: 18px;
    padding: 0;
    top: 8%;
    right: 2%;
    border: 1px solid black;
    border-radius: 50%;
}

@media (max-width: 768px) {
    .toast {
        padding: 10px 20px;
    }
}

.toast-enter-active,
.toast-leave-active {
    transition: opacity 0.5s ease-in-out;
}

.toast-enter,
.toast-leave-to {
    opacity: 0;
}
</style>
