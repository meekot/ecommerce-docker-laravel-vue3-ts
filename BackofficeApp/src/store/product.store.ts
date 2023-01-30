import { defineStore } from 'pinia';
import { ref, watchEffect, computed, Ref } from 'vue';
import {
  NewProduct,
  ProductApi,
  ProductId,
  ProductList,
  ProductListSearch,
  ProductListPagination,
} from '../api';

export interface ProductTablePagination {
  sortBy?: string | undefined;
  descending?: boolean | undefined;
  page?: number | undefined;
  rowsPerPage?: number | undefined;
  rowsNumber?: number | undefined;
}

export const useProductStore = defineStore('product', () => {
  const productList = ref<ProductList | null>(null);
  const productListLoading = ref<boolean>(false);
  const productListCount = ref<number>();
  const productListPagination = ref<ProductListPagination>({
    sortDirection: 'desc',
    sortField: 'updated_at',
    perPage: 10,
    page: 1,
  });
  const productListSearch = ref<ProductListSearch>();

  const productTablePagination = computed({
    get: (): ProductTablePagination => {
      const { perPage, page, sortField, sortDirection } =
        productListPagination.value;
      const pagination: ProductTablePagination = {
        page: page,
        rowsPerPage: perPage,
        rowsNumber: productListCount.value,
        descending: sortDirection === 'desc',
        sortBy: sortField,
      };
      return pagination;
    },
    set: (value: ProductTablePagination) => {
      productListPagination.value = {
        sortDirection: value.descending ? 'desc' : 'asc',
        sortField: value.sortBy || '',
        perPage: value.rowsPerPage || 10,
        page: value.page || 1,
      };
    },
  });

  const loadProductList = async () => {
    try {
      productListLoading.value = true;
      const response = await ProductApi.getList({
        ...productListPagination.value,
        search: productListSearch.value,
      });
      productList.value = response.products;
      productListCount.value = response.totalCount;
      return response;
    } finally {
      productListLoading.value = false;
    }
  };

  const createOrUpdateProduct = async (
    product: NewProduct,
    id: number | null = null
  ) => {
    const response = id
      ? await ProductApi.update(id, product)
      : await ProductApi.create(product);
    console.log('wtf?');
    loadProductList();
    return response;
  };

  const deleteProduct = async (id: ProductId) => {
    const response = await ProductApi.delete(id);
    loadProductList();
    return response;
  };

  return {
    productList,
    productListLoading,
    productListSearch,
    productTablePagination,
    loadProductList,
    createOrUpdateProduct,
    deleteProduct,
  };
});
