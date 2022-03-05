<template>
    <div class="container">
        <div class="row">
            <div class="w-25">
                <main-menu></main-menu>
            </div>

            <div class="w-75">

                <a :href="'/products'">Powrót do listy produktów</a>

                <form method="POST" >
                    Nazwa produktu<br />
                    <input type="text" v-model="name"><br/>
                    Opis<br />
                    <textarea v-model="description"></textarea><br />
                    Cena<br />
                    <input type="number" v-model="price"><br />

                    Producent<br />
                <!-- <select class="producers" v-model="producer">
                        <option v-for="producer in producers" :key="producer.id" v-bind:value="producer.id">{{producer.name}}</option>
                    </select> -->
                    <model-list-select :list="producers"
                     v-model="producer"
                     option-value="id"
                     option-text="name"
                     placeholder="Wybierz producenta">
                    </model-list-select>

                    <br />
                    <br />
                    Zdjęcie główne<br />
                    <input type="file" accept="image/jpeg, image/png" v-on:change="onChange"><br /><br />

                    Galeria<br />
                    <input type="file" accept="image/jpeg, image/png" v-on:change="onChangeGalery"><br /><br />

                    <input type="submit" class="my-btn add" @click.prevent="addProduct">
                    <button class="my-btn" @click.prevent="cancel">Anuluj</button>
                </form>
            </div>
        </div>
 
    </div>
</template>

<script>
import Menu from '../../components/Menu.vue';

import 'vue-search-select/dist/VueSearchSelect.css';
import { ModelListSelect } from 'vue-search-select';

export default {
        data()
        {
            return {
              name:null,
              description: null,
              price: null,
              file: null,
              producers: [],
              producer:null,
              gallery:null,
               
            }
            
        },

        mounted() {
            console.log('Component mounted.')
        },
        mounted()
        {
            this.setTitle();
           this.addProduct;
           this.getproducers();
        },
        methods:{
             setTitle: function()
           {
               document.title += " - Dodawanie produktu"
               
           },

            onChange(e) {
                this.file = e.target.files[0];
            },

            onChangeGalery(e) {
                this.gallery = e.target.files[0];
            },

            cancel: function()
            {
                window.location.href='/products';
            },

            getproducers: function()
            {
                axios.get('/api/product/producer').then(res=>{
                    if(res.status==200)
                    {
                        this.producers = res.data;
                    }
                })
            },

           addProduct: function()
           {
               const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let data = new FormData();
                data.append('name', this.name);
                data.append('description', this.description);
                data.append('price', this.price);
                data.append('producer', this.producer);
                data.append('photo', this.file);
                data.append('gallery', this.gallery);


               axios.post('/api/product/add', data, config).then(res => {
                   if(res.status==200)
                   {
                       window.location.href="/products"
                   }
               })
           },

          
            
        },

        components:
        {
            'main-menu': Menu,
            ModelListSelect,
        }
    }


</script>


