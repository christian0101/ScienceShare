/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

window.Vue = require('vue');
window.ClassicEditor = ClassicEditor;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('examplecomponent', require('./components/ExampleComponent.vue').default);
Vue.component('tags-input', require('./components/TagsInput.vue').default);
Vue.component('comments', require('./components/Comments.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
if ( document.querySelector( '#comments' )) {
  const comments = new Vue({
   el: '#comments',
  });
}

if ( document.querySelector( '#createPost' )) {
  const createPost = new Vue({
   el: '#createPost',

   mounted() {
     let post_text = document.querySelector( '#post_text' );
     if (post_text) {
       ClassicEditor
       .create(post_text, {
         
       })
       .catch( error => {
         showNotification(error, 5);
         console.error( error );
       });

       post_text.id = "editing_post_text";
     }
   },
  });
}

if ( document.querySelector( '#post' )) {
  const post = new Vue({
    el: '#post',

    methods: {
      createEditor() {
        let post_text = document.querySelector( '#post_text' );
        if (post_text) {
          ClassicEditor
          .create( post_text )
          .catch( error => {
            showNotification(error, 5);
            console.error( error );
          } );

          post_text.id = "editing_post_text";
        }
      }
    }
  });
}
