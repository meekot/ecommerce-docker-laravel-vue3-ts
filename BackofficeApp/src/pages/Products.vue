<template>
  <div class="q-pa-md">
    <q-table
      v-model:pagination="productTablePagination"
      title="Products"
      :rows="productList || []"
      :columns="columns"
      row-key="id"
      :loading="productListLoading"
      :filter="productListSearch"
      binary-state-sort
      @request="onRequest"
    >
      <template #body-cell-imageUrl="{ value }">
        <q-td class="text-center">
          <q-img
            :src="value || 'https://via.placeholder.com/70'"
            spinner-color="blue"
            placeholder-src="https://via.placeholder.com/70"
            height="70px"
          >
            <template #error>
              <img
                src="https://via.placeholder.com/70"
                class="w-100% h-100%"
                style="object-fit: cover; object-position: 50% 50%"
              />
            </template>
          </q-img>
        </q-td>
      </template>
      <template #body-cell-action="{ row }">
        <q-td class="text-center">
          <q-btn-dropdown size="md" dense flat color="primary" label="">
            <q-list>
              <q-item v-close-popup clickable @click="removeProduct(row)">
                <q-item-section>
                  <q-item-label class="text-warning"
                    ><q-icon name="warning" /> Remove product</q-item-label
                  >
                </q-item-section>
              </q-item>
            </q-list>
          </q-btn-dropdown>
        </q-td>
      </template>
      <template #top-right>
        <q-input
          v-model="productListSearch"
          borderless
          dense
          class="mr-12"
          debounce="300"
          placeholder="Search"
        >
          <template #append>
            <q-icon name="search" />
          </template>
        </q-input>
        <q-btn color="primary" @click="showAddProductModal = true">
          Add product
        </q-btn>
      </template>
    </q-table>
  </div>
  <q-dialog v-model="showAddProductModal" persistent @hide="clearProduct">
    <q-card class="w-100%" style="max-width: 800px">
      <q-card-section class="row items-center q-pb-none">
        <div class="text-h6">Add product</div>
        <q-space />
        <q-btn v-close-popup icon="close" flat round dense />
      </q-card-section>

      <q-card-section>
        <q-form @submit="createProduct">
          <div class="row q-col-gutter-sm">
            <div class="col-12 col-md-5">
              <q-uploader
                label="Upload"
                class="w-100% h-100% min-h-60"
                @added="(files) => (product.image = files[0])"
                @removed="product.image = null"
              />
            </div>
            <div class="col-12 col-md-7">
              <div class="row q-col-gutter-sm">
                <div class="col-9">
                  <q-input
                    v-model="product.title"
                    filled
                    label="Title"
                    hint="Ex: Table"
                    lazy-rules
                    :rules="[
                      (val) =>
                        (val && val.length > 0) || 'Please type something',
                    ]"
                  />
                </div>
                <div class="col-3">
                  <q-input
                    v-model="product.price"
                    filled
                    mask="#.##"
                    fill-mask="0"
                    reverse-fill-mask
                    label="Price"
                    lazy-rules
                    input-class="text-right"
                    :rules="[(val) => val > 0 || 'Please type a price']"
                    suffix="€"
                  >
                  </q-input>
                </div>
              </div>
              <div class="row mt-5">
                <div class="col">
                  <label class="text-gray-600">Description</label>
                  <q-editor v-model="product.description" class="min-h-10" />
                </div>
              </div>
            </div>
          </div>

          <div class="mt-5 text-right">
            <q-btn label="Submit" type="submit" color="primary" />
            <q-btn
              v-close-popup
              label="Close"
              type="reset"
              color="secondary"
              flat
              class="q-ml-sm"
            />
          </div>
        </q-form>
      </q-card-section>
      <q-inner-loading :showing="productLoading" />
    </q-card>
  </q-dialog>
</template>
<script lang="ts" setup>
import { QTableColumn, useQuasar } from 'quasar';
import { reactive, ref } from 'vue';
import { NewProduct, ProductListItem } from '../api';
import { useProductStore } from '../store';
import { storeToRefs } from 'pinia';
import dayjs from 'dayjs';

const $q = useQuasar();

const columns: QTableColumn[] = [
  {
    name: 'action',
    label: '',
    field: 'action',
  },
  {
    name: 'id',
    required: true,
    label: '#',
    align: 'left',
    field: 'id',
    sortable: true,
  },
  {
    name: 'imageUrl',
    label: 'Image',
    align: 'center',
    field: 'imageUrl',
  },
  {
    name: 'title',
    align: 'center',
    label: 'Title',
    field: 'title',
    sortable: true,
  },
  {
    name: 'price',
    align: 'center',
    label: 'Price',
    field: 'price',
    sortable: true,
  },
  {
    name: 'created_at',
    align: 'center',
    label: 'Created at',
    field: 'createdAt',
    sortable: true,
    format: (val: string) => dayjs(val).format('DD/MM/YYYY, HH:mm'),
  },
  {
    name: 'updated_at',
    align: 'center',
    label: 'Updated at',
    field: 'updatedAt',
    sortable: true,
    format: (val: string) => dayjs(val).format('DD/MM/YYYY, HH:mm'),
  },
];

const ProductStore = useProductStore();

const {
  productList,
  productListLoading,
  productListSearch,
  productTablePagination,
} = storeToRefs(ProductStore);

ProductStore.loadProductList();

const showAddProductModal = ref<boolean>(false);

const removeProduct = (product: ProductListItem) => {
  $q.dialog({
    title: 'Confirm',
    message: `Are you sure you want to delete \n "${product.title}" ?`,
    cancel: true,
    persistent: true,
  }).onOk(() => {
    ProductStore.deleteProduct(product.id);
  });
};

const product = reactive<NewProduct>({
  title: '',
  price: 0,
  description: '',
  image: null,
});

const productLoading = ref<boolean>(false);

const clearProduct = () => {
  product.title = '';
  product.price = 0;
  product.description = '';
  product.image = null;
};

const createProduct = async () => {
  try {
    productLoading.value = true;

    await ProductStore.createOrUpdateProduct(product);
  } finally {
    productLoading.value = false;
  }
};

const onRequest: (requestProp: {
  pagination: {
    sortBy: string;
    descending: boolean;
    page: number;
    rowsPerPage: number;
  };
  filter?: string | any;
}) => void = ({ pagination, filter }) => {
  productTablePagination.value = pagination;
  productListSearch.value = filter;
  ProductStore.loadProductList();
};
</script>
