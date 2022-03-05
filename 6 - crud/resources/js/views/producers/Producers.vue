<template>
    <div class="container">
        <div class="row">
            <div class="w-25">
                <main-menu></main-menu>
            </div>

            <div class="w-75">
                <div class="row d-flex justify-content-between">
                    <div>
                        <span class="my-btn add"><a :href="'/producer/new'">Dodaj</a></span>
                    </div>
                    <div>
                        <input type="text" placeholder="Szukaj" v-model="search" @keyup="getProducers">
                    </div>
               </div>
                <table>
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Nazwa producenta</td>
                            <td>Logo</td>
                            <td colspan="2" class="text-center">Akcje</td>
                        </tr>
                    </thead>
                    <tbody v-if="producers && producers.data != 0">
                        <tr v-for="producer in producers.data" :key="producer.id">
                                <td>{{producer.id}}</td>
                                <td>{{producer.name}}</td>
                                <td><img v-bind:src="`/storage/producers/${producer.logo}`" width="50px"></td>
                                <td><a :href="'/producer/edit/'+producer.id"><span class="my-btn edit">Edytuj</span></a></td>
                                <td><span class="my-btn delete" @click.prevent="deleteProducer(producer.id)" style="cursor:pointer">Usuń</span></td>
                            
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="5">Brak producentów</td>
                        </tr>
                    </tbody>
                </table>

                <br />
                <pagination :data="producers" @pagination-change-page="getProducers"></pagination>

                <select v-model="perPage" @change="getProducers">
                    <option value="" disabled>Ilość producentów na stronę</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>

                <p class="confirm"></p>
                <p class="empty"></p>
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
                producers: {},
                search: null,
                perPage: "",
               
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
            this.getProducers();
            
        },

        // watch: {
        // keyword(after, before) {
        //     this.searchProducers();
        //     }
        // },

        methods:{
             setTitle: function()
           {
               document.title += " - Producenci"
               
           },

            getProducers: function(page = 1)
            {
                axios.post('/api/producers?page='+page, {
                    search: this.search,
                    perPage: this.perPage,
                }).then(res =>{
                    if(res.status==200)
                    {
                        if(res.data.length!=0)
                        {
                         this.producers = res.data;
                        //console.log(res.data)
                        }
                        else
                        {
                            //console.log('brak')
                            let empty = document.querySelector('.empty');
                            empty.innerHTML = 'Brak producentów';
                        }
                    }
                })
            },


            // searchProducers: function()
            // {
            //     console.log(this.search)
            //     axios.get('/api/producers', { params: { search: this.search } }).then(res =>{
            //         if(res.status==200)
            //         {
                        
            //              this.producers = res.data;
                        
            //         }
            //     })
            // },


            deleteProducer: function(id)
            {
                axios.get(`/api/producer/delete/${id}`).then(res=>{
                    if(res.status==200)
                    {
                       let confirm = document.querySelector('.confirm');

                       window.location.href = '/producers';
                       confirm.innerHTML = 'Producent usunięty';
                    }
                })
            }
        }
    }


</script>
