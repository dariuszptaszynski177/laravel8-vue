<template>
    <div class="container">
        <div class="row">
            <div class="w-25">
                <main-menu></main-menu>
            </div>

            <div class="w-75">
                <a :href="'/producers'">Powrót do listy producentów</a>

                <form method="POST">
                    <input type="text" v-model="producer.name" name='name'><br/>
                    <!-- <input type="text" v-model="producer.logo" name="logo"><br /> -->
                    <input type="file" accept="image/jpeg, image/png" v-on:change="onChange" name="logo"><br />
                    <img v-bind:src="`/storage/producers/${producer.logo}`" width="200px"><br />

                

                    <input type="submit" @click.prevent="updateProducer">
                </form>

                <p class="confirm"></p>
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
               producer: {},
               
               producer_id: '',
               name: null,
               logo: null,
               file: null,
               
            }
            
        },

        mounted() {
            console.log('Component mounted.')
        },
        mounted()
        {
            this.setTitle();
            this.getProducer();
            this.updateProducer;
        },
        methods:{
             setTitle: function()
           {
               document.title += " - Edycja producenta"
               
           },

            onChange(e) {
                this.file = e.target.files[0];
            },

            getProducer: function()
            {
                let id = this.$route.params.id;
                axios.get('/api/producer/edit/'+id).then(res =>{
                    if(res.status==200)
                    {
                        this.producer = res.data;
                        
                    }
                })
            },

            

            updateProducer: function()
            {

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let id_producer = this.$route.params.id;

                let data = new FormData();
                data.append('id', id_producer);
                data.append('logo', this.file);
                data.append('name', this.producer.name);



                
                
                
                axios.post('/api/producer/update', data, config
                )
                .then(res=>{
                    if(res.status==200)
                    {
                    location.reload();

                    let confirm = document.querySelector('.confirm');
                    confirm.innerHTML = 'Dane zaktualizowane'
                    }
                    
                })
            }
            
        },

        components:
        {
            'main-menu': Menu,
        }
    }


</script>
