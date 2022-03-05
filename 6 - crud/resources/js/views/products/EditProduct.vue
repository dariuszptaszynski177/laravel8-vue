<template>
    <div class="container">
        <div class="row">
            <div class="w-25">
                <main-menu></main-menu>
            </div>

            <div class="w-75">

                <a :href="'/products'">Powrót do listy produktów</a>

                <form method="POST">
                    <input type="text" v-model="product.name" name='name'><br/>
                    <textarea v-model="product.description"></textarea><br />
                    <input type="number" v-model="product.price"><br />

                    

                    Producent<br />
                    <!-- <select class="producers" v-model="product.producer_id">
                    
                        <option v-for="producer in producers" :key="producer.id" v-bind:value="producer.id">{{producer.name}}</option>
                        
                    </select> -->

                    <model-list-select :list="producers"
                     v-model="product.producer_id"
                     option-value="id"
                     option-text="name"
                     placeholder="Wybierz producenta">
                    </model-list-select>

                    <br />
                    <input type="file" accept="image/jpeg, image/png" v-on:change="onChange"><br />

                    <img v-bind:src="`/storage/products/${product.photo}`" width="200px"><br />

                    Galeria<br />

                    <input type="file" accept="image/jpeg, image/png" v-on:change="onChangeGalery"><br /><br />

                    <div class="row">
                        <div v-for="image in gallery" :key="image.id" style="width:70px; height: 70px; position: relative;">
                            <img v-bind:src="`/storage/gallery/${image.photo}`" style="max-width:70px; max-height:70px;">
                            <div @click.prevent="deleteImage(image.id)" style="position: absolute; right: 0px; top:0px; cursor: pointer" class="bg-primary rounded p-1">
                                x
                            </div>
                        </div>
                    </div>

                    <input type="submit" @click.prevent="updateProduct">
                </form>

                <p class="confirm"></p>
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
               product: {},
               producers: [],
               producer_id: '',
               file: null,
               gallery:[],
               addGallery:null,
               
            }
            
        },

        mounted() {
            console.log('Component mounted.')
        },
        mounted()
        {
            this.setTitle();
            this.getProduct();
            this.getproducers();
            this.getGallery();
        },
        methods:{
             setTitle: function()
           {
               document.title += " - Edcycja produktu"
               
           },

            onChange(e) {
                this.file = e.target.files[0];
            },

            onChangeGalery(e) {
                this.addGallery = e.target.files[0];
            },

            getProduct: function()
            {
                let id = this.$route.params.id;
                axios.get('/api/product/edit/'+id).then(res =>{
                    if(res.status==200)
                    {
                        this.product = res.data;
                        
                    }
                })
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

            getGallery: function()
            {
               let id = this.$route.params.id;
               axios.get('/api/gallery/'+id).then(res=>{
                   this.gallery = res.data;
                  // console.log(res.data)
               }) 
            },

            deleteImage: function(id)
            {console.log('del')
                axios.get(`/api/image/delete/${id}`).then(res=>{
                    if(res.status==200)
                    {
                        location.reload();
                    }
                })
            },

            updateProduct: function()
            {
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let id_product = this.$route.params.id;

                let data = new FormData();
                data.append('id', id_product);
                data.append('name', this.product.name);
                data.append('description', this.product.description);
                data.append('price', this.product.price);
                data.append('producer_id', this.product.producer_id);
                data.append('photo', this.file);
                data.append('gallery', this.addGallery);


                console.log(data)
                axios.post('/api/product/update', data, config
                )
                .then(res=>{
                    if(res.status==200)
                    {
                    location.reload();

                    let confirm = document.querySelector('.confirm');
                    confirm.innerHTML = 'Dane zaktualizowane'
                    //window.location.href='/products'
                    }
                })
            }
            
        },

        components:
        {
            'main-menu': Menu,
            ModelListSelect,
        }
    }


</script>
