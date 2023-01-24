<template>
  <q-card class="my-card rounded-md" style="width: 500px">
    <q-card-section>
      <template v-if="resetPasswordForm">
        <h4 class="mt-2">Restore password</h4>

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
              style="width: 100%"
            />
          </div>
        </q-form>
      </template>
      <template v-else>
        <h4 class="mt-2">Sign in to your account</h4>

        <q-form class="q-gutter-md" @submit="signIn">
          <q-input
            v-model="email"
            class="q-pb-sm"
            filled
            label="Email"
            lazy-rules
            :rules="[(val) => (val && val.length > 0) || 'Email is required']"
          />

          <q-input
            v-model="password"
            filled
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
              <a href="#" @click="resetPasswordForm = true">Reset password</a>
            </div>
          </div>

          <div>
            <q-btn
              label="Sign in"
              type="submit"
              color="primary"
              style="width: 100%"
            />
          </div>
        </q-form>
      </template>
    </q-card-section>
  </q-card>
</template>
<script setup lang="ts">
import { useQuasar } from 'quasar';
import { ref } from 'vue';

const $q = useQuasar();

const email = ref(null);
const password = ref(null);
const rememberMe = ref(false);
const resetPasswordForm = ref<boolean>(false);

const signIn = () => {
  console.log(email.value);
};

const resetPassword = () => {
  console.log(email.value);
};
</script>
