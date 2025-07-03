<template>
    <div>


        <div class="container mx-auto mt-4">

        <a style="float:right" @click="doLogout" class="bg-blue-500 text-white font-medium p-2 rounded shadow-sm hover:bg-blue-600">Logout</a>
        <br />

        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-50">
                <th v-for="header in headers" class="text-left px-4 py-3 font-medium text-gray-700">{{ header.text }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in itemsTable">
                <td>{{ item.name }}</td>
                <td>{{ item.email }}</td>
                <td>{{ item.person?.cep }}</td>
                <td>{{ item.person?.street }}</td>
                <td>{{ item.person?.city }}</td>
                <td>{{ item.person?.street_number }}</td>
            </tr>
        </tbody>
    </table>
    </div>

    </div>
  </template>

  <script lang="ts" setup>
  import type { Header, Item } from "vue3-easy-data-table";
  import { ref, onMounted } from 'vue'
  import { useRouter } from 'vue-router';

  const router = useRouter();

  const headers: Header[] = [
    { text: "Nome", value: "name" },
    { text: "Email", value: "email" },
    { text: "CEP", value: "cep" },
    { text: "Logradouro", value: "street" },
    { text: "Cidade", value: "city" },
    { text: "Numero", value: "street_number" },
  ];


  const itemsTable = ref([]);

  function getUsersPaginate() {
    axios.get('/api/home/users', {}, {
      Authorization: "Bearer " + localStorage.getItem('APP_USER_TOKEN')
    })
    .then(response => {
      const responseApi = response.data.data;
      itemsTable.value = responseApi;
    })
    .catch(error => {
      console.error('Error fetching users:', error);
    });
  }

  onMounted(() => {
    getUsersPaginate();
  });

  function doLogout()
  {
    localStorage.removeItem("APP_USER_TOKEN");

    router.push('/login');
}

  </script>

  <style scoped>
  </style>
