<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Component</div>
  
                    <div class="card-body">
                        
                        <span>{{user.id}} - {{user.name}}</span>
                        <br/>
                        <span>data {{ user.created_at | moment("Do")}}{{user.created_at | moment("MM")}}.{{user.created_at | moment("YYYY")}}</span>
                        
                        <router-link :to="{name: 'main-page'}">Go to Home</router-link>
                        <!-- <router-link to="/">Go to Home</router-link> -->

                        <new :user=user></new>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import New from './new.vue'

   export default {
       
       data(){
           
           return{
               user:[],
           }
       },

        mounted() {
            this.loadUser();
            
        },

        methods:{

            loadUser: function()
        {
            let id = this.$route.params.id;
            axios.get('/api/user/'+ id,
            {
                
            }).then(res=>{
                if(res.status==200)
                {
                    this.user = res.data;
                }
            })
            .catch(err =>{
                console.log(err)
            });
        },

        

        },

        components:{
            New,
        },

        
    }
</script>