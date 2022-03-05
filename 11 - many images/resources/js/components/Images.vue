<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">gallery nad images</div>
  
                    <div class="card-body">
                        
                            <form method="post" >
                                <input type="text" v-model="name"><br />

                                <input type="file" v-on:change="onFileChange1"><br />
                                <input type="file" v-on:change="onFileChange2" multiple><br /> 

                                <input type="submit" @click.prevent="send">
                            </form>
                            
                       
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
              name: null,
              photo1: null,
              photo2: null,
           }
       },

        mounted() {
            this.send
        },

        methods:{

            onFileChange1(e){
                console.log(e.target.files[0]);
                this.photo1 = e.target.files[0]; 
            },

            onFileChange2(e){
                console.log(e.target.files[0]);
                this.photo2 = e.target.files[0];
            },



            send: function()
            {
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                let data = new FormData();
                data.append('name', this.name);
                data.append('photo1', this.photo1);
                data.append('photo2', this.photo2);

                axios.post('/api/send_images', data, config).then(res=>{
                    if(res.status==200)
                    {
                        console.log("ok")
                    }
                })
            }

        },

        
    }
</script>