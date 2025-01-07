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
    el: '#root_element',
    data: {
        thumbnails_data: {},
        max_resolution_thumbnail: {},
        error: null,
        youtube_url: null,
        is_data_loading: false,
        isActive: false
    },
    computed: {
        baseUrl(){
            return process.env.MIX_APP_URL;
        }
    },
    methods: {
        sendUrl(target = 'fetch-thumbnail'){
            if(!this.youtube_url){
                return;
            }
            this.is_data_loading = true;
            let url = this.baseUrl + '/api/' + target;
            axios.post(url, {youtube_url: this.youtube_url})
                .then(response => {
                    if(!response.data){
                        return this.error = 'Something went wrong...';
                    }
                    if (target === 'fetch-thumbnail') {
                        this.thumbnails_data = response.data;
                        this.defineMaxResolutionImg(response.data);
                    } else {
                        console.log(response.data)
                    }
                })
                .catch(err => {
                    if(err && err.response && err.response.data && err.response.data.errors){
                        this.error = err.response.data.errors['youtube_url'][0];
                    } else if (err && err.response && err.response.data && err.response.data.message) {
                        this.error = err.response.data.message;
                    } else {
                        console.log(err)
                        this.error = 'Something went wrong...';
                    }
                })
                .finally(() => {
                    this.is_data_loading = false;
                });
        },
        clearResults(){
            this.thumbnails_data = {},
            this.max_resolution_thumbnail = {},
            this.error = null,
            this.youtube_url = null
        },
        defineMaxResolutionImg(data){
            let thumbnails = data.thumbnails;
            let maxResolutionWidth = 0;
            let maxResolutionImg;
            for (let key in thumbnails) {
                if(thumbnails[key].width > maxResolutionWidth){
                    maxResolutionWidth = thumbnails[key].width;
                    maxResolutionImg = thumbnails[key];
                }
            }
            this.max_resolution_thumbnail = maxResolutionImg;
        },
        getScrollbarWidth() {
            return window.innerWidth - document.documentElement.clientWidth;
        },
        toggleActive(){
            this.isActive = !this.isActive
            if(this.isActive){
                let marginRight = this.getScrollbarWidth();
                document.documentElement.style.overflow = 'hidden'
                document.body.style.marginRight = marginRight + 'px'
            } else {
                document.documentElement.style.overflow = 'auto',
                document.body.style.marginRight = '0px'
            }
        }
    }
});

