<template>
  <div class="py-4">
    <h3><b>Comments</b></h3>
    <div v-if="currentUser && !editing" id="new_comment">
      <label>New Comment:</label>
      <p>
        <textarea id="comment_text" class="form-control"></textarea>
        <button @click="addComment" class="btn btn-success mt-2">Post</button>
      </p>
      </div>
      <p v-if="comments.length == 0">No comments found :(</p>
      <div @delete="destroy" v-for="comment in comments" :id="comment.id" class="mb-2">
        <a :href="'/user/'+comment.user.id">{{ comment.user.name }}</a> on {{ comment.created_at }}
        <div v-if="currentUser && currentUser.id == comment.user.id" class="btn-group">
          <a href="#" class="more-opts" id="moreOptionsLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

          <div class="dropdown-menu" aria-labelledby="moreOptionsLink">
            <a v-if="('comment_'+comment.id+'_text') != editing" @click="createEditor('comment_'+comment.id+'_text')" class="dropdown-item">Edit</a>
            <a @click="destroy(comment.id)" class="dropdown-item">Delete</a>
          </div>
        </div>
        <p :id="'comment_'+comment.id+'_text'" v-html="comment.text">
          <div v-if="editing == ('comment_'+comment.id+'_text')" class="btn-group mt-2">
            <button @click="update(comment.id)" class="btn btn-success">Save</button>
            <button @click="cancelEdit" class="btn btn-danger">Cancel</button>
          </div>
        </p>
      </div>
      <p v-if="next_page_url" align="center">
        <button class='btn btn-dark' @click="loadMore()">Load More ...</button>
      </p>
  </div>
</template>

<script>
  export default {
    props: {
      postId: {
        type: Number,
        default: 1
      },
      currentUser: {
        type: Object,
        default: null
      },
    },

    data() {
      return {
        comments: [],
        next_page_url: null,
        editing: null,
        editor: null,
      };
    },

    mounted() {
      this.getComments('/api/comments/'+this.postId);
      this.createEditor('comment_text');
    },

    methods: {
      addComment() {
        axios.post('/comments/new',{
          post_id: this.postId,
          text: this.editor.getData(),
        })
        .then(response => {
          this.comments.unshift(response.data)
          this.editor.setData("");
          showNotification('Comment Posted', 5);
        })
        .catch(error => {
          if (error.response) {
            let errors = error.response.data.errors.text;
            errors.forEach(e => {
              showNotification(e, 5);
            })
          } else {
            showNotification(error, 5);
          }
        })
      },

      loadMore() {
        if (this.next_page_url) {
          this.getComments(this.next_page_url)
        }
      },

      getComments(page) {
        axios.get(page, {})
        .then((response) => {
          this.comments = this.comments.concat(response.data.data);
          this.next_page_url = response.data.next_page_url
        })
        .catch(error => {
          this.comments = []
          showNotification(error, 5);
        })
      },

      createEditor(id) {
        let el = document.getElementById(id);
        //console.log(el);
        if (el) {
          ClassicEditor
          .create(el, {
            toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
          }).then(newEditor => {
            if (this.editor) {
                this.editor.destroy();
            }

            if (id != "comment_text") {
              this.editing = id;
            }

            this.editor = newEditor;
          })
          .catch( error => {
            showNotification(error, 5);
          });
        }
      },

      cancelEdit() {
        this.editing = null;
        this.$nextTick(() => {
          this.createEditor('comment_text');
        });
      },

      update(id) {
        axios.put('/comments/'+id+'/update', {
          text: this.editor.getData(),
        })
        .then(response => {
          showNotification(response.data, 5);
          this.cancelEdit();
        })
        .catch(error => {
          if (error.response) {
            let errors = error.response.data.errors.text;
            errors.forEach(e => {
              showNotification(e, 5);
            })
          } else {
            showNotification(error, 5);
          }
        })
      },

      destroy(id) {
        axios.delete('/comments/'+id)
        .then(response => {
          if (this.editor && this.editing == 'comment_'+id+'_text') {
            this.cancelEdit();
          }
          const index = this.comments.findIndex(comment => comment.id === id);
          this.comments.splice(index, 1);
          showNotification(response.data, 5);
        })
        .catch(error => {
          showNotification(error, 5);
        })
      }
    },
  }
</script>
