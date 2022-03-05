<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home Component</div>
  
                    <div class="card-body">
                        Welcome to Homepage
                        <br/>
                        <router-link :to="{name: 'users-page'}">Go to User</router-link>
                        <!-- <router-link to="/user">Go to User</router-link> -->
                    </div>
                </div>

                
      <!-- <Select2 v-model="myValue" :options="myOptions" />

      <select class="js-data-example-ajax"></select> -->

      <model-list-select :list="users"
                     v-model="stringItem"
                     option-value="id"
                     option-text="name"
                     placeholder="select item">
  </model-list-select>
  
            </div>
        </div>
    </div>
</template>
   
<script>
import 'vue-search-select/dist/VueSearchSelect.css'
import { ModelListSelect } from 'vue-search-select'
    export default {
       components: {
      ModelListSelect
    },
    data() {
       return {
           myValue: '',
           users:[],
           myOptions: [{id:1, text: 'test'}], //['op1', 'op2', 'op3']  or [{id: key, text: value}, {id: key, text: value}]
          options1: [
          { code: '01', name: 'aa', desc: 'desc01' },
          { code: '02', name: 'ab', desc: 'desc02' },
          { code: '03', name: 'bc', desc: 'desc03' },
          { code: '04', name: 'cd', desc: 'desc04' },
          { code: '05', name: 'de', desc: 'desc05' },
          { code: '06', name: 'ef', desc: 'desc06' }
        ],
        stringItem: null,
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
                    console.log(res.data)
                }
            });
        }
         }
    }

    $('.js-data-example-ajax').select2({
  ajax: {
    url: 'https://api.github.com/search/repositories',
    dataType: 'json'
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});
</script>

