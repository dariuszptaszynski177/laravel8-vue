<template>
    <div class="container">
        <div class="row">
            <div class="w-25">
                <main-menu></main-menu>
            </div>

            <div class="w-75">

                <a :href="'/producers'">Powrót do listy producentów</a>

                <form method="POST" >
                    Nazwa producenta<br />
                    <input type="text" v-model="name"><br/>
                    Logo
                    <input type="file"  name="logo" accept="image/jpeg, image/png" v-on:change="onChange"><br />


                

                    <br />
                    <br />

                    <input type="submit" class="my-btn add" @click.prevent="addProducer">
                    <button class="my-btn" @click.prevent="cancel">Anuluj</button>
                </form>
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
              name:null,
              file:null,
               logo:null,
            }
            
        },

        mounted() {
            console.log('Component mounted.')
        },
        mounted()
        {
            this.setTitle();
            this.addProducer;
           
        },
        methods:{
             setTitle: function()
           {
               document.title += " - Dodanie producenta"
               
           },

            onChange(e) {
                this.file = e.target.files[0];
            },

            cancel: function()
            {
                window.location.href='/producers';
            },

           

           addProducer: function()
           {
               const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let data = new FormData();
                data.append('logo', this.file);
                data.append('name', this.name);
               
               axios.post('/api/producer/add',data, config).then(res => {
                   if(res.status==200)
                   {
                       window.location.href="/producers"
                   }
               })
           },

           

          
            
        },

        components:
        {
            'main-menu': Menu,
        }
    }


</script>


