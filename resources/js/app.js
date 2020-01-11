/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        image_links: [],
        errors: {},
        youtube_url: null
    },
    computed: {
        baseUrl(){
            return process.env.MIX_APP_URL;
        }
    },
    methods: {
        sendUrl(){
            if(!this.youtube_url){
                return;
            }
            let url = this.baseUrl + '/api/fetch-thumbnail';
            axios.post(url, {youtube_url: this.youtube_url})
                .then(response => {
                    console.log(response.data)
                })
                .catch(err => {
                    console.log('err', err)
                });
        }
    }
});
