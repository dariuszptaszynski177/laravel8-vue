<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Component</div>
  
                    <div class="card-body">
                        <div v-for="user in users" :key="user.id">
                            
                            <router-link :to="{name: 'user-page', params: {id:user.id}}"><p>{{user.name}}</p></router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
    export default {
       data(){
           return{
               users:[],
           }
       },

        mounted() {
            this.loadUsers();
        },

        methods:{

            loadUsers: function()
        {
            axios.get('/users').then(res=>{
                if(res.status==200)
                {
                    this.users = res.data;
                }
            });
        }

        },

        
    }
</script>