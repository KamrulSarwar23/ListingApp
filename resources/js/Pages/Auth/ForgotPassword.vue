<script setup>
import Container from "../../Components/Container.vue";
import Title from "../../Components/Title.vue";
import InputField from "../../Components/InputField.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";
import { useForm } from "@inertiajs/vue3";
import SessionMessages from "../../Components/SessionMessages.vue";


const form = useForm({
  email: "",
});

defineProps({
    status: String
})

const submit = () => {
  form.post(route("password.email"), {
    onFinish: () => form.reset("email"),
  });
};
</script>

<template>
  <Container class="w-1/2">
    <Head title="- Forgot Password" />
    <div class="mb-8 text-center">
      <p>
        Forgot your password? No problem just let me know your email address and
        we will email you a password reset link that will allow you to choose a
        new one.
      </p>
    </div>

    <ErrorMessages :errors="form.errors" />

    <SessionMessages :status="status"/>
    <form @submit.prevent="submit" class="space-y-6">
      <InputField label="Email" type="email" icon="at" v-model="form.email" />

      <PrimaryBtn :disabled="form.processing"
        >Send Password Reset Link</PrimaryBtn
      >
    </form>
  </Container>
</template>