<template>
    <div class="container">
        
        <div class="main-menu">
            <ul>
                <li><a :href="'/'">Dashboard</a></li>
                <li><a :href="'/products'">Produkty</a></li>
                <li><a :href="'/producers'">Producenci</a></li>
            </ul>
        </div>
        
    </div>
</template>

<script>
export default {
        data()
        {
            return {
              name:null,
              description: null,
              price: null,
               
            }
            
        },

        mounted() {
            console.log('Component mounted.')
        },
        mounted()
        {
           
        },
        methods:{
           
            
        }
    }


</script>
