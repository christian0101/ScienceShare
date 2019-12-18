<template>
  <div class="py-4" id="comments">
    <h3><b>Comments</b></h3>
      <div class="row">
        <div class="col-md-11 col-sm-9">
          <p><label>New Comment:</label>
            <textarea class="form-control" v-model="commentText"></textarea>
          </p>
        </div>
        <div class="col-md-1 col-sm-3">
          <button @click="addComment" class="btn btn-success">Post</button>
        </div>
      </div>
      <p v-if="comments.length == 0">No comments found :(</p>
      <div v-for="comment in comments" :id="'comment'+comment.id">
         <a :href="'/user/'+comment.user.id"> {{ comment.user.name }}</a> on {{ comment.created_at }}
        <p>{{ comment.text }}</p>
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
    },

    data() {
      return {
        comments: [],
        next_page_url: null,
        commentText: null,
      };
    },

    mounted() {
      this.getComments('/api/post/'+this.postId+'/comments');
    },

    methods: {
      addComment() {
        axios.post('/comments/new',{
          post_id: this.postId,
          text: this.commentText,
        })
        .then(response => {
          this.comments.unshift(response.data)
        })
        .catch(error => {
          console.log(error.response)
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
        })
      },

      update(id, text) {
        // TODO
      },

      del(id) {
        
      }
    },
  }
</script>
