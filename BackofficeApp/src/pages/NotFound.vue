<template>
  <div
    class="error-page window-height window-width bg-light column items-center no-wrap"
  >
    <div
      class="error-code bg-primary flex items-center content-center justify-center"
    >
      404
    </div>
    <div>
      <div
        class="error-card shadow-4 bg-white column items-center justify-center no-wrap"
      >
        <q-icon name="error_outline" color="grey-5" />
        <p class="caption text-center">Oops. Nothing here...</p>
        <p class="text-center group">
          <q-btn
            v-if="canGoBack"
            color="primary"
            push
            icon="keyboard_arrow_left"
            @click="goBack"
          >
            Go back
          </q-btn>
          <q-btn
            class="ml-3"
            color="primary"
            push
            icon-right="home"
            @click="$router.replace('/')"
          >
            Go home
          </q-btn>
        </p>
      </div>
    </div>
  </div>
</template>
<script lang="ts" setup>
import { QBtn, QIcon } from 'quasar';
const canGoBack = window.history.length > 1;

const goBack = () => window.history.go(-1);
</script>

<style lang="sass">
.error-page
  .error-code
    height: 50vh
    width: 100%
    padding-top: 15vh
    @media (orientation: landscape)
      font-size: 30vw

    @media (orientation: portrait)
      font-size: 30vh

    color: rgba(255, 255, 255, .2)
    overflow: hidden
  .error-card
    border-radius: 2px
    margin-top: -50px
    width: 80vw
    max-width: 600px
    padding: 25px
    > i
      font-size: 5rem
</style>
