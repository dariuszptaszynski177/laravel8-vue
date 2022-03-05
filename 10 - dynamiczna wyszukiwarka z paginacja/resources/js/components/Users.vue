<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Component</div>

                   
                    <input type="text" v-model="keyword" @keyup="loadUsers1"><br />
                    
                    <br />
                    <div class="card-body">
                        <div v-for="user in users.data" :key="user.id">
                            
                            <router-link :to="{name: 'user-page', params: {id:user.id}}"><p>{{user.name}}</p></router-link>
                            <!--<a :href="'user/'+user.id">test a</a>-->
                        </div>
                    </div>
                    <pagination :data="users" @pagination-change-page="loadUsers1"></pagination>

                    <select v-model="perPage" @change="loadUsers1" >
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
    export default {
       data(){
           return{
               keyword: null,
               users: {},
               perPage: null,


               
           }
       },

        created() {
            this.loadUsers1();
        },

        
    

        methods:{

            loadUsers1: function(page=1)
        {
            
                console.log(this.keyword)
            axios.post('/api/search?page='+page, {   
                keyword: this.keyword,
                perPage: this.perPage,
                }).then(res=>{
                
                    this.users = res.data
                
            });
            
           
        },

        

        

        },

        
    }
</script>