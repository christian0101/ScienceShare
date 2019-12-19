<template>
  <div v-if="currentUser" id="new_comment">
    <label>New Comment:</label>
    <div class="row">
      <div class="col-md-11 col-sm-9">
        <p>
          <textarea class="form-control" v-model="commentText"></textarea>
        </p>
      </div>
      <div class="col-md-1 col-sm-3">
        <button @click="addComment" class="btn btn-success w-100 p-3">Post</button>
      </div>
    </div>
  </div>
</template>
