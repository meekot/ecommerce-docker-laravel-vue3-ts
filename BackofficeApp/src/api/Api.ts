import wretch from 'wretch';
import { useAppStore } from '../store';
import FormDataAddon from 'wretch/addons/formData';
export abstract class Api {
  protected static get wretch() {
    return wretch(`${import.meta.env.VITE_APP_BASE_URL}/api`)
      .auth(`Bearer ${useAppStore().userToken}`)
      .errorType('json')
      .addon(FormDataAddon)
      .accept('application/json');
  }
}
