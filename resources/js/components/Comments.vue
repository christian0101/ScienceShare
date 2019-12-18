<template>
  <div class="py-4" id="comments">
    <h3><b>Comments</b></h3>
      <comment-form></comment-form>
      <div v-for="comment in comments" :id="'comment'+comment.id">
         <a :href="'/user/'+comment.user.id"> {{ comment.user.name }}</a> on {{ comment.created_at }}
        <p>{{ comment.text }}</p>
      </div>
      <p v-if="next_page_url" align="center">
        <button class='btn btn-dark' @click.prevent="loadMore()">Load More ...</button>
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
      };
    },

    mounted() {
      this.getComments('/api/post/'+this.postId+'/comments');
    },

    methods: {
      create() {
        // TODO
      },

      loadMore() {
        if (this.next_page_url) {
          this.getComments(this.next_page_url)
        }
      },

      getComments(page) {
        axios.get(page, {}).then((response) => {
          this.comments = this.comments.concat(response.data.data);
          this.next_page_url = response.data.next_page_url
        });
      },

      update(id, text) {
        // TODO
      },

      del(id) {
        // TODO
      }
    },
  }
</script>
