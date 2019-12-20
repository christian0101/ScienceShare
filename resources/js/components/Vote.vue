<template>
  <div align="center" class="col-1 mb-3">
        <button v-if="currentUser" @click="vote(1)" class="btn btn-success">Up Vote</button>
        <h6 class="mt-2 mb-2">{{ votes }} Vote(s)</h6>
        <button v-if="currentUser" @click="vote(-1)" class="btn btn-danger">Down Vote</button>
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
      votes: null,
    };
  },

  mounted() {
    this.getVotes();
  },

  methods: {
    getVotes() {
      axios.get('/api/posts/'+this.postId+'/votes', {})
      .then((response) => {
        this.votes = response.data;
      })
      .catch(error => {
        showNotification(error, 5);
      })
    },

    vote(_type) {
      axios.post('/votes/'+this.postId+'/new', {
        type: _type
      })
      .then((response) => {
        showNotification(response.data, 3);
        if (response.data == "Vote Added" || response.data == "Vote Updated") {
          this.getVotes();
        }
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
  },
}
</script>
