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
Vue.component('vote', require('./components/Vote.vue').default);

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

if ( document.querySelector( '#posts' )) {
  const posts = new Vue({
   el: '#posts',
  });
}

if ( document.querySelector( '#profile' )) {
  const posts = new Vue({
   el: '#profile',

   data() {
     return {
       editingBio: false,
       editor: null,
     };
   },

   methods: {
     updateBio(id) {
       axios.put('/profiles/'+id+'/update', {
         bio: this.editor.getData(),
       })
       .then((response) => {
         showNotification(response.data, 3);
         this.cancelEdit();
       })
       .catch(error => {
         if (error.response) {
           showNotification(error.response.data.message, 5);
           let errors = error.response.data.errors;
           Object.keys(errors).forEach(key => {
             showNotification(errors[key][0], 5);
           })
         } else {
           showNotification(error, 5);
         }
       })
     },

     createEditor() {
       let bio_text = document.querySelector( '#bio' );
       if (bio_text) {
         ClassicEditor
         .create( bio_text, {
           toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
         })
         .then(newEditor => {
           this.editor = newEditor;
         })
         .catch( error => {
           showNotification(error, 5);
           console.error( error );
         } );

         this.editingBio = true;
       }
     },

     cancelEdit() {
       this.editingBio = false;
       this.editor.destroy();
     },

   },

  });
}

if ( document.querySelector( '#createPost' )) {
  const createPost = new Vue({
   el: '#createPost',

   mounted() {
     $().ready(function () {
         tinymce.init({
             selector: 'textarea',
             height: 200,
             theme: 'modern',
             oninit : "setPlainText",
             plugins: [
                 'image imagetools', 'paste'
             ],
             toolbar1: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
             relative_urls: false,
             file_browser_callback: function(field_name, url, type, win) {
                 // trigger file upload form
                 if (type == 'image') $('#formUpload input').click();
             }
         });
     });
   },
  });
}

if ( document.querySelector( '#post' )) {
  const post = new Vue({
    el: '#post',

    data() {
      return {
        editingPost: false,
        editor: null,
        title: null,
        tags: [],
        post: null,
      };
    },

    mounted() {
      //this.populateTags(3);
    },

    methods: {
      createEditor(id) {
        tinymce.init({
            selector: '#post_text',
            theme: 'modern',
            oninit : "setPlainText",
            plugins: [
                'image imagetools', 'paste'
            ],
            toolbar1: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            relative_urls: false,
            file_browser_callback: function(field_name, url, type, win) {
                // trigger file upload form
                if (type == 'image') $('#formUpload input').click();
            },
        }).then(newEditor => {
          this.editor = '#post_text';

          this.populateTags(id);
          this.title = document.getElementById('title').innerHTML;
          this.editingPost = true;
        })
      },

      cancelEdit() {
        this.editingPost = false;
        tinymce.remove(this.editor);
      },

      populateTags(id) {
        axios.get('/api/posts/'+id+'/tags', {})
        .then((response) => {
          response.data.forEach((tag) => {
            let newTag = {
                key: tag.id,
                value: tag.name,
            }

            this.tags.push(newTag);
          })
        })
        .catch(error => {
          this.comments = []
          showNotification(error, 5);
        })
      },

      updatePost(id) {
        this.tags = JSON.parse(document.getElementById('tags').value);
        axios.put('/posts/'+id+'/update', {
          title: this.title,
          tags: JSON.stringify(this.tags),
          content: tinyMCE.activeEditor.getContent(),
        })
        .then(response => {
          showNotification(response.data);
          this.cancelEdit();
          this.$nextTick(() => {
            document.getElementById('title').innerHTML = this.title;
          })
        })
        .catch(error => {
          if (error.response) {
            let errors = error.response.data.errors;
            Object.keys(errors).forEach(key => {
              showNotification(errors[key][0], 5);
            })
          } else {
            showNotification(error, 5);
          }
        })
      },
    }
  });
}
