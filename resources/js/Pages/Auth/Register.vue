<script setup>
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import { Head, Link, useForm } from '@inertiajs/vue3';
  import AuthLayout from '@/Layouts/AuthLayout.vue';

  const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
  });

  const submit = () => {
    form.post(route('register'), {
      onFinish: () => form.reset('password', 'password_confirmation'),
    });
  };
</script>

<template>
  <Head title="Register" />
  <AuthLayout class="flex">
    <form class="form" @submit.prevent="submit">
      <div>
        <InputLabel for="name" value="Name" />

        <TextInput
          id="name"
          v-model="form.name"
          autocomplete="name"
          autofocus
          class="mt-1 block w-full"
          required
          type="text"
        />

        <InputError :message="form.errors.name" class="mt-2" />
      </div>

      <div class="mt-4">
        <InputLabel for="email" value="Email" />

        <TextInput
          id="email"
          v-model="form.email"
          autocomplete="username"
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
          autocomplete="new-password"
          class="mt-1 block w-full"
          required
          type="password"
        />

        <InputError :message="form.errors.password" class="mt-2" />
      </div>

      <div class="mt-4">
        <InputLabel
          for="password_confirmation"
          value="Confirm Password"
        />

        <TextInput
          id="password_confirmation"
          v-model="form.password_confirmation"
          autocomplete="new-password"
          class="mt-1 block w-full"
          required
          type="password"
        />

        <InputError
          :message="form.errors.password_confirmation"
          class="mt-2"
        />
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link
          :href="route('login')"
          class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Already registered?
        </Link>

        <PrimaryButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          class="ms-4"
        >
          Register
        </PrimaryButton>
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
