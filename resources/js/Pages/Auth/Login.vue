<script setup>
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import AuthLayout from '@/Layouts/AuthLayout.vue';
  import { Head, Link, useForm } from '@inertiajs/vue3';

  const form = useForm({
    email: '',
    password: '',
  });

  const submit = () => {
    form.post(route('login'), {
      onFinish: () => form.reset('password'),
    });
  };
</script>

<template>
  <Head title="Log in" />
  <AuthLayout>
    <form class="form" @submit.prevent="submit">
      <div>
        <InputLabel for="email" value="Email" />

        <TextInput
          id="email"
          v-model="form.email"
          autocomplete="username"
          autofocus
          class="mt-1 block w-full"
          required
          type="email"
        />

        <InputError :message="form.errors.email" class="mt-2" />
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Password" />

        <TextInput
          id="password"
          v-model="form.password"
          autocomplete="current-password"
          class="mt-1 block w-full"
          required
          type="password"
        />

        <InputError :message="form.errors.password" class="mt-2" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <PrimaryButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          class="ms-4"
        >
          Log in
        </PrimaryButton>
        <Link :href="route('register')">Register</Link>
      </div>
    </form>
  </AuthLayout>
</template>

<style scoped>
  .flex {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 2rem;
  }

  .form {
    width: 40%;
    margin-top: 2rem;
  }
</style>
