<template>
  <div class="flex items-center justify-center h-screen">
    <q-card class="my-card rounded-md max-w-lg w-[calc(100%)]">
      <q-card-section>
        <template v-if="resetPasswordForm">
          <h4 class="mt-2 text-center">Set your new password</h4>

          <q-form class="q-gutter-md" @submit="resetPassword">
            <q-input
              v-model="password"
              filled
              type="password"
              label="New password"
              lazy-rules
              :rules="[
                (val) => (val && val.length > 0) || 'New password is required',
              ]"
            />

            <q-input
              v-model="confirmPassword"
              filled
              type="password"
              label="Confirm password"
              :error-message="errors.password"
              lazy-rules
              :rules="[
                (val) =>
                  (val && val.length > 0) || 'Confirm password is required',
                (val) =>
                  (val && val === password) ||
                  'Confirm password must be same as password',
              ]"
            />

            <div>
              <q-btn
                label="Submit"
                type="submit"
                color="primary"
                :disable="loading"
                class="w-[calc(100%)]"
              />
            </div>
          </q-form>
        </template>
        <template v-if="forgotPasswordForm">
          <h4 class="mt-2 text-center">Restore password</h4>

          <q-form class="q-gutter-md" @submit="resetPassword">
            <q-input
              v-model="email"
              class="pb-5"
              filled
              label="Email"
              lazy-rules
              :rules="[(val) => (val && val.length > 0) || 'Email is required']"
            />

            <div>
              <q-btn
                label="Submit"
                type="submit"
                color="primary"
                :disable="loading"
                class="w-[calc(100%)]"
              />
            </div>
          </q-form>
        </template>
        <template v-else>
          <h4 class="mt-2 mb-4 text-center">Sign in to your account</h4>
          <q-banner v-if="!!errors.message" class="text-white bg-red mb-8">
            {{ errors.message }}
          </q-banner>
          <q-form @submit="signIn">
            <q-input
              v-model="email"
              class="pb-5"
              filled
              :error="!!errors.email || !!errors.message"
              :error-message="errors.email"
              label="Email"
              lazy-rules
              :rules="[(val) => (val && val.length > 0) || 'Email is required']"
            />

            <q-input
              v-model="password"
              filled
              :error="!!errors.password || !!errors.message"
              :error-message="errors.password"
              class="mt-2"
              type="password"
              label="Password"
              lazy-rules
              :rules="[
                (val) => (val && val.length > 0) || 'Password is required',
              ]"
            />

            <div class="row">
              <div class="col flex">
                <q-toggle v-model="rememberMe" label="Remember me" />
              </div>
              <div class="col flex items-center justify-end">
                <a href="#" @click="forgotPasswordForm = true"
                  >Reset password</a
                >
              </div>
            </div>

            <div>
              <q-btn type="submit" color="primary" class="w-[calc(100%)] mt-2"
                >Sign in</q-btn
              >
            </div>
          </q-form>
        </template>

        <q-inner-loading :showing="loading" label="Please wait..." />
      </q-card-section>
    </q-card>
  </div>
</template>
<script setup lang="ts">
import { useQuasar } from 'quasar';
import { reactive, ref } from 'vue';
import { WretchError } from 'wretch/resolver';
import { LoginError } from '../api/AuthApi';
import { useAppStore } from '../store/app.store';

defineProps<{
  resetPasswordForm?: boolean;
}>();

const $q = useQuasar();

const AppStore = useAppStore();

const errors = reactive({
  email: '',
  password: '',
  message: '',
});

const email = ref('admin@example.com');
const password = ref('admin123');
const confirmPassword = ref<string>('');
const rememberMe = ref(false);
const forgotPasswordForm = ref<boolean>(false);
const loading = ref<boolean>(false);
const signIn = async () => {
  Object.entries(errors).forEach(
    ([key]) => (errors[key as keyof typeof errors] = '')
  );
  if (!email.value || !password.value) {
    return;
  }
  try {
    loading.value = true;
    await AppStore.login(email.value, password.value, rememberMe.value);
  } catch (e) {
    const errorJson = (e as WretchError).json as LoginError;
    Object.entries(errorJson).forEach(
      ([key, err]) =>
        (errors[key as keyof typeof errors] = Array.isArray(err)
          ? err.join('\n')
          : err)
    );
  } finally {
    loading.value = false;
  }
};

const resetPassword = () => {
  console.log(email.value);
};
</script>
