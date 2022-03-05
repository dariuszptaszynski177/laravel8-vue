<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Component</div>
  
                    <input type="text" v-model="keyword" >

                    <br />
                    <div class="card-body">
                        <div v-for="user in users" :key="user.id">
                            
                            <router-link :to="{name: 'user-page', params: {id:user.id}}"><p>{{user.name}}</p></router-link>
                            <!--<a :href="'user/'+user.id">test a</a>-->
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
               keyword: null,
               users:[],
           }
       },

        mounted() {
            this.loadUsers1();
        },

        watch: {
        keyword(after, before) {
            this.loadUsers2();
        }
    },

        methods:{

            loadUsers1: function()
        {
            
                console.log(this.keyword)
            axios.get('/api/users').then(res=>{
                if(res.status==200)
                {
                    this.users = res.data;
                }
            });
            
           
        },

        loadUsers2: function()
        {
            
                console.log(this.keyword)
            axios.get('/api/users', { params: { keyword: this.keyword } }).then(res=>{
                if(res.status==200)
                {
                    this.users = res.data;
                }
            });
        }

        

        },

        
    }
</script>