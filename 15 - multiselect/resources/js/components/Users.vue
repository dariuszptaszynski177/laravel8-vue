<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Component</div>
  
                    <div class="card-body">
                        <div v-for="user in users" :key="user.id">
                            
                            <router-link :to="{name: 'user-page', params: {id:user.id}}"><p>{{user.name}}</p></router-link>
                            <!--<a :href="'user/'+user.id">test a</a>-->

                            
  

                        </div>
                    </div>
                </div>
                <div>
                    <form method="post" @submit.prevent="test">

                        <multiselect :multiple="true" v-model="value" :options="users" label="name" :custom-label="nameFormatter" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" track-by="id"  :taggable="true" @tag="addTag"></multiselect>
                        <br />
                        <input type="submit">
                    </form>
  </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import Multiselect from 'vue-multiselect';
    export default {
       data(){
           return{
               users:[],
               value: [],
               options: ['vue', 'script', 'com']
               
           }
       },

        mounted() {
            this.loadUsers();
        },

        methods:{
            nameFormatter({ name, email }) {
      return `${name} (${email})`;
    },


            addTag (newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
      }
      this.options.push(tag)
      this.value.push(tag)
    },

            test: function()
            {
                let a = this.value
                let b=[];

                a.forEach(element => {
                    console.log(element.name)
                    b.push(element.id)
                    
                });

                axios.post('/api/send_categories', {
                    categories: b,
                })
                
            },

            loadUsers: function()
        {
            axios.get('/api/users').then(res=>{
                if(res.status==200)
                {
                    this.users = res.data;
                }
            });
        }

        },
        components: { Multiselect },

        
    }
</script>