<script setup lang="ts">
import { useAppStore } from './store/app';
  const AppStore = useAppStore();
  if (AppStore.isAuthenticated) {
    AppStore.refreshUser()
  }
</script>

<template>
  <RouterView></RouterView>
</template>
