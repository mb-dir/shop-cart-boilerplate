<script setup>
  import AuthLayout from '@/Layouts/AuthLayout.vue';
  import Modal from '@/Components/Modal.vue';
  import { router, usePage, useForm } from '@inertiajs/vue3';
  import { computed, ref } from 'vue';

  const props = defineProps({
    product: { type: Object, required: true },
  });

  const page = usePage();
  const cartItems = computed(() => page.props.cart?.items);

  const form = useForm({
    name: props.product.name,
    price: props.product.price,
    photo: null,
  });

  // Find the cart item related to the current product
  const retrivedItem = computed(() =>
    cartItems.value?.find((item) => item.product_id === props.product.id),
  );

  const show = ref(false);

  function onAddToCart() {
    if (retrivedItem.value) {
      // Update the existing cart item
      router.patch(
        route('cart.item.update', {
          cartItem: retrivedItem.value,
        }),
      );
    } else {
      // Create a new cart item
      router.post(
        route('cart.item.store', {
          product: props.product,
          quantity: 1,
        }),
      );
    }
  }

  function onPhotoChange({ target }) {
    form.photo = target.files[0];
  }

  function onSubmit() {
    form.post(route('product.update', { product: props.product }), {
      onSuccess: () => {
        show.value = false;
      },
    });
  }
</script>

<template>
  <Modal :show="show" @close="show = false">
    <form @submit.prevent="onSubmit">
      <input v-model="form.name" placeholder="Name" type="text" />
      <input
        v-model="form.price"
        min="0"
        placeholder="Price"
        step="0.01"
        type="number"
      />

      <!-- Display the current product photo if it exists -->
      <div v-if="product.photo" class="photo-preview">
        <label>Current Photo:</label>
        <img
          :src="product.photo"
          alt="Current Product Photo"
          class="current-photo"
        />
      </div>

      <!-- File input for selecting a new photo -->
      <input
        accept="image/jpeg, image/png"
        placeholder="Photo"
        type="file"
        @change="onPhotoChange"
      />

      <button>Save</button>
    </form>
  </Modal>

  <AuthLayout>
    <div class="product-container">
      <img :src="product.photo" alt="" class="product-image" />
      <div class="product-details">
        <button v-if="!!$page.props.auth.user" class="edit-btn" @click="show = true">Edit</button>
        <h2>{{ product.name }}</h2>
        <div class="price">
          {{ product.price }} {{ page.props.activeCurrency.code }}
        </div>
        <div class="actions">
          <button @click="onAddToCart">Add to Cart</button>
        </div>
      </div>
    </div>
  </AuthLayout>
</template>

<style scoped>
  .product-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    padding: 30px;
    max-width: 900px;
    margin: 40px auto;
    align-items: center;
    position: relative;
  }

  .product-image {
    width: 100%;
    border-radius: 10px;
    object-fit: cover;
  }

  .product-details {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: end;
  }

  .edit-btn {
    position: absolute;
    top: 0;
    right: 0;
  }

  .product-details h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 20px;
  }

  .product-details .price {
    font-size: 1.5rem;
    color: #007bff;
    margin-bottom: 20px;
    font-weight: bold;
  }

  .product-details .actions {
    display: flex;
    gap: 15px;
  }

  .product-details button {
    padding: 10px 20px;
    font-size: 1rem;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .product-details button:hover {
    background-color: #0056b3;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  /* Styling the input fields inside the form */
  form input[type="text"],
  form input[type="number"],
  form input[type="file"] {
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  /* Styling the button inside the form */
  form button {
    padding: 10px;
    font-size: 1rem;
    color: #fff;
    background-color: #28a745;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  form button:hover {
    background-color: #218838;
  }

  .photo-preview {
    margin-bottom: 15px;
    text-align: center;
  }

  .current-photo {
    max-width: 100px;
    max-height: 100px;
    object-fit: cover;
    border-radius: 8px;
    margin-top: 5px;
  }
</style>
