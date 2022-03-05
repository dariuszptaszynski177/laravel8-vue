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

                        <div id="app">
        <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
   
<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    export default {
        mounted() {
            console.log('Component mounted.')
        },
         name: 'app',
        data() {
            return {
                editor: ClassicEditor,
                editorData: '',
                editorConfig: {
                    // The configuration of the editor.
                }
            };
        }
    }
</script>