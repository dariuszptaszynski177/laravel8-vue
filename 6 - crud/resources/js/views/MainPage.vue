<template>
    <div class="container">
        
        <div class="row">
            <div class="w-25">
                <main-menu></main-menu>
            </div>
            <div class="w-75">
                Dashboard
            </div>
        </div>
        
    </div>
</template>

<script>
import Menu from '../components/Menu.vue';
export default {
        data()
        {
            return {
             
               
            }
            
        },

        mounted() {
            console.log('Component mounted.')
        },
        mounted()
        {
           this.setTitle()
        },
        components:
        {
            'main-menu': Menu,
        },

        methods:{
           setTitle: function()
           {
               document.title += " - Dashboard"
               
           },
            
        }
    }


</script>
