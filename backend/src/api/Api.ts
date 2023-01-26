import wretch from 'wretch';
import { useAppStore } from '../store/app';

export class Api {
  protected static get wretch() {
    return wretch(`${import.meta.env.VITE_APP_BASE_URL}/api`)
      .auth(`Bearer ${useAppStore().userToken}`)
      .errorType('json')
      .accept('application/json');
  }
}
