<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <BreezeAuthenticatedLayout>
        <Head title="Products"/>
        <div class="flex justify-center">
            <div class="mb-3 xl:w-96">
                <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
                <input type="search" v-model="searchTerm" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                <button class="btn inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center" type="button" id="button-addon2" @click="getProducts">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                    </svg>
                </button>
                </div>
            </div>
        </div>

        <!-- <template> -->
            <div class="bg-white" >
                <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Customers also purchased</h2>
                <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    <div v-for="(product,index) in products" :key="product.id+index" class="group relative">
                    <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        <img :src="product.image?product.image['src']:''" :key="product.image?product.image['alt']:''" class="w-full h-full object-center object-cover lg:w-full lg:h-full" />
                    </div>
                    {{}}
                    <div class="mt-4 flex justify-between">
                        <div>
                        <h3 class="text-sm text-gray-700">
                            <a :href="product.href">
                            <span aria-hidden="true" class="relative">
                            {{ product.title }}
                            </span>
                            </a>
                        <p class="block w-full text-sm font-medium text-gray-900">{{ this.convertDate(product.created_at) }}</p>
                        </h3>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">{{ product.product_type }}</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        <!-- </template> -->

    </BreezeAuthenticatedLayout>

</template>

<script>
export default {
    data() {
        return {
            searchTerm:null,
            products:[]
        }
    },
    methods: {
        async getProducts()
        {

            let reqRoute = route('api.products.index') //see routs/api.php

            /**
             * Call the route through axios and don't forget to console.log potential errors from the api
             */
            axios.post(reqRoute, {
                params: {
                    search: this.searchTerm
                }
            }).then((response) => {
                this.products = response.data
                console.log(response.data)
            })
            .catch( (error) =>  {
                console.log(error)
            });
        },
        convertDate(inputFormat){
            function pad(s) { return (s < 10) ? '0' + s : s; }
            var d = new Date(inputFormat)
            return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('.')
        },
    },
    mounted(){
        this.getProducts();
    }
}
</script>
