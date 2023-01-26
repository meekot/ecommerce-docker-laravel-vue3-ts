import { defineStore } from 'pinia';
import { Auth, User } from '../api/Auth';

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
      const { token, user } = await Auth.login(email, password, rememberMe);
      sessionStorage.setItem('USER_TOKEN', token);
      this.$patch({
        userToken: token,
        user: user,
      });
      this.$router.push({ name: 'app.dashboard' });
    },
    async logout() {
      await Auth.logout();
      this.userToken = null;
      sessionStorage.removeItem('USER_TOKEN');
      this.$router.push({ name: 'login' });
    },
    async refreshUser() {
      try {
        this.user = await Auth.getUser();
      } catch (e) {
        this.userToken = null;
        sessionStorage.removeItem('USER_TOKEN');
        this.$router.push({ name: 'login' });
      }
    },
  },
});
