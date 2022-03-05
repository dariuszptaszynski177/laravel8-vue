<template>
    <div class="container">
        <div class="row">
            <div class="w-25">
                <main-menu></main-menu>
            </div>

            <div class="w-75">
                <div class="row d-flex justify-content-between">
                    <div>
                        <span class="my-btn add"><a :href="'/product/new'">Dodaj</a></span>
                    </div>
                    <div> 
                        <input type="text" placeholder="Szukaj" v-model="search" @keyup="getProducts">
                    </div>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Nazwa produktu</td>
                            <td>Cena</td>
                            <td>Producent</td>
                            <td colspan="2" class="text-center">Akcje</td>
                        </tr>
                    </thead>
                    <tbody v-if="products && products.data != 0">
                        <tr v-for="product in products.data" :key="product.id">
                                <td>{{product.id}}</td>
                                <td>{{product.name}}</td>
                                <td>{{product.price}}</td>
                                <td>{{product.producer.name}}</td>
                                <td><a :href="'/product/edit/'+product.id"><span class="my-btn edit">Edytuj</span></a></td>
                                <td><span class="my-btn delete" @click.prevent="deleteProduct(product.id)" style="cursor:pointer">Usuń</span></td>
                            
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="6">Brak produktów</td>
                        </tr>
                    </tbody>
                </table>

                <br />
                <pagination :data="products" @pagination-change-page="getProducts"></pagination>

                <select v-model="perPage" @change="getProducts">
                    <option value="" disabled>Ilość produktów na stronę</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>


                <p class="confirm"></p>
                <!-- <p class="empty"></p> -->
            </div>
        </div>
    </div>
</template>



<script>
import Menu from '../../components/Menu.vue';
export default {
        data()
        {
            return {
                products: {},
                search: null,
                perPage: '',
            }
            
        },

        mounted() {
            console.log('Component mounted.')
        },

        components:{
            'main-menu': Menu,
        },

        mounted()
        {
            this.setTitle();
            this.getProducts();
        },
        methods:{
             setTitle: function()
           {
               document.title += " - Produkty"
               
           },

            getProducts: function(page = 1)
            {
                axios.post('/api/products?page=' + page, {
                    search: this.search,
                    perPage: this.perPage,
                }).then(res =>{
                    if(res.status==200)
                    {
                        if(res.data.length!=0)
                        {
                         this.products = res.data;
                        //console.log(res.data)
                        }
                        // else
                        // {
                        //     //console.log('brak')
                        //     let empty = document.querySelector('.empty');
                        //     empty.innerHTML = 'Brak produktów';
                        // }
                    }
                })
            },

            deleteProduct: function(id)
            {
                axios.get(`/api/product/delete/${id}`).then(res=>{
                    if(res.status==200)
                    {
                       let confirm = document.querySelector('.confirm');

                       window.location.reload;
                       confirm.innerHTML = 'Produkt usunięty';
                    }
                })
            }
        }
    }


</script>

