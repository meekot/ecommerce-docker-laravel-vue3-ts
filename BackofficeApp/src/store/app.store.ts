import { defineStore } from 'pinia';
import { AuthApi, User } from '../api';

interface AppStore {
  userToken: null | string;
  user: null | User;
}

export const useAppStore = defineStore({
  id: 'appStore',
  state: (): AppStore => ({
    userToken: sessionStorage.getItem('USER_TOKEN'),
    user: null,
  }),
  getters: {
    isAuthenticated: ({ userToken }) => !!userToken,
  },
  actions: {
    async login(email: string, password: string, rememberMe: boolean) {
      const { token, user } = await AuthApi.login(email, password, rememberMe);
      sessionStorage.setItem('USER_TOKEN', token);
      this.$patch({
        userToken: token,
        user: user,
      });
      this.$router.push({ name: 'app.dashboard' });
    },
    logout() {
      AuthApi.logout();
      this.userToken = null;
      sessionStorage.removeItem('USER_TOKEN');
      this.$router.push({ name: 'login' });
    },
    async refreshUser() {
      try {
        this.user = await AuthApi.getUser();
      } catch (e) {
        this.userToken = null;
        sessionStorage.removeItem('USER_TOKEN');
        this.$router.push({ name: 'login' });
      }
    },
  },
});
