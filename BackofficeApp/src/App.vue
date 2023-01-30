<script setup lang="ts">
import { useAppStore } from './store';
const AppStore = useAppStore();
if (AppStore.isAuthenticated) {
  AppStore.refreshUser();
}
</script>

<template>
  <RouterView></RouterView>
</template>
