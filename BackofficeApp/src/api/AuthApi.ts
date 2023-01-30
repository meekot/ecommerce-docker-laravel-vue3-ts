import { Api } from './Api';

export type UserId = number;

export interface User {
  email: string;
  id: UserId;
  name: string;
}

export type LoginError = {
  message?: string[] | string;
  email?: string[] | string;
  password?: string[] | string;
};

export class AuthApi extends Api {
  public static login(
    email: string,
    password: string,
    remember = false
  ): Promise<{ token: string; user: User }> {
    return this.wretch.url('/login').post({ email, password, remember }).json();
  }

  public static getUser(): Promise<User> {
    return this.wretch.url('/user').get().json();
  }

  public static logout() {
    return this.wretch.url('/logout').post();
  }
}
