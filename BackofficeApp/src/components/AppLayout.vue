<template>
  <q-layout
    view="hHh Lpr lff"
    container
    class="shadow-2 rounded-borders h-screen"
  >
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          round
          dense
          icon="menu"
          class="q-mr-sm"
          @click="drawer = !drawer"
        />

        <q-toolbar-title>Ecommerce Laravel Vue3 TS</q-toolbar-title>
        <q-btn flat round dense class="mr-2ВА" icon="whatshot" />
        <q-btn flat dense class="mr-2" label="Test" />
        <q-btn-dropdown
          v-if="AppStore.user"
          flat
          dense
          :label="AppStore.user.name"
        >
          <q-list>
            <q-item v-close-popup clickable @click="AppStore.logout()">
              <q-item-section>
                <q-item-label>Logout</q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </q-btn-dropdown>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="drawer"
      show-if-above
      :width="200"
      :breakpoint="500"
      bordered
      class="bg-grey-3"
    >
      <q-scroll-area class="fit">
        <q-list>
          <template v-for="(menuItem, index) in menuList" :key="index">
            <q-item
              v-ripple
              clickable
              :active="menuItem.routeName === route.name"
              @click="router.push({ name: menuItem.routeName })"
            >
              <q-item-section avatar>
                <q-icon :name="menuItem.icon" />
              </q-item-section>
              <q-item-section>
                {{ menuItem.label }}
              </q-item-section>
            </q-item>
            <q-separator v-if="menuItem.separator" :key="'sep' + index" />
          </template>
        </q-list>
      </q-scroll-area>
    </q-drawer>

    <q-footer elevated>
      <q-toolbar>
        <q-toolbar-title>Meekot</q-toolbar-title>
      </q-toolbar>
    </q-footer>

    <q-page-container>
      <q-page padding>
        <RouterView></RouterView>
      </q-page>
    </q-page-container>
  </q-layout>
</template>
<script lang="ts" setup>
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useAppStore } from '../store';

const route = useRoute();
const router = useRouter();

const AppStore = useAppStore();

const drawer = ref<boolean>(false);
const menuList = [
  {
    icon: 'home',
    label: 'Dashboard',
    routeName: 'app.dashboard',
    separator: false,
  },
  {
    icon: 'inventory_2',
    label: 'Products',
    routeName: 'app.products',
    separator: false,
  },
  {
    icon: 'group',
    label: 'Users',
    routeName: 'app.users',
    separator: false,
  },
  {
    icon: 'leaderboard',
    label: 'Reports',
    routeName: 'app.reports',
    separator: false,
  },
];
</script>
