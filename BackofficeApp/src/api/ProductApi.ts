import { Wretch } from 'wretch/types';
import { Api } from './Api';
import { UserId } from './AuthApi';

export type ProductId = number;

export interface ProductListPagination {
  sortDirection: 'desc' | 'asc';
  sortField: string;
  perPage: number;
  page: number;
}

export type ProductListSearch = string | null | undefined;

export type ProductListConfig = ProductListPagination & {
  search: ProductListSearch;
};

export interface ProductListItem {
  id: ProductId;
  title: string;
  imageUrl: string;
  price: number;
  createdAt: string;
  updatedAt: string;
  createdBy: UserId;
  updatedBy: UserId;
}

export type ProductList = ProductListItem[];

export interface Product extends ProductListItem {
  slug: string;
  description: string;
}

export interface NewProduct {
  title: string;
  image?: File | null;
  price: number;
  description: string;
}

export class ProductApi extends Api {
  protected static get wretch() {
    return super.wretch.url('/products');
  }
  public static getList(
    config: ProductListConfig
  ): Promise<{ products: ProductList; totalCount: number }> {
    const urlSearchParams = new URLSearchParams();
    if (config.sortDirection) {
      urlSearchParams.append('sortDirection', config.sortDirection);
      urlSearchParams.append('sortField', config.sortField);
    }
    urlSearchParams.append('perPage', config.perPage.toString());
    urlSearchParams.append('page', config.page.toString());
    config.search && urlSearchParams.append('search', config.search);

    return this.wretch.get('?' + urlSearchParams.toString()).json();
  }

  public static create(product: NewProduct) {
    return this.wretch.formData(product).post().json();
  }

  public static get(id: ProductId): Promise<Product> {
    return this.wretch.get(`/${id}`).json();
  }

  public static update(id: ProductId, product: NewProduct): Promise<Product> {
    return this.wretch.put(product, `/${id}`).json();
  }

  public static delete(id: ProductId) {
    return this.wretch.delete(`/${id}`).res();
  }
}
