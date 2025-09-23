<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>VueJS Bootstrap 4 PHP PDO Posts and Comments SPA</title>
  <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
  />
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <style>
    .editable {
      border-bottom: 1px dashed #ccc;
      cursor: pointer;
    }
    .edit-input {
      width: 100%;
      border: none;
      border-bottom: 1px solid #007bff;
      outline: none;
    }
  </style>
</head>
<body>
  <div id="app" class="container mt-4">
    <h1>Posts & Comments</h1>

    <!-- Add New Post -->
    <div class="form-group">
      <input
        type="text"
        v-model="newPost"
        @keyup.enter="addPost"
        placeholder="Add new post and press Enter"
        class="form-control"
      />
    </div>

    <div v-for="post in posts" :key="post.id" class="card mb-3">
      <div class="card-body">
        <!-- Editable Post Content -->
        <div v-if="editPostId !== post.id" @dblclick="startEdit('post', post)" class="editable">
          {{ post.content }}
        </div>
        
        <input
          v-else-if="editPostId === post.id && editType === 'post'"
          v-model="editContent"
          @blur="saveEdit(post)"
          @keyup.enter="saveEdit(post)"
          class="edit-input"
          type="text"
          ref="editInput"
        />

        <button
          class="btn btn-danger btn-sm float-right"
          @click="confirmDelete('post', post)"
        >
          Delete
        </button>

        <!-- Comments List -->
        <ul class="list-group mt-3">
          <li
            v-for="comment in post.comments"
            :key="comment.id"
            class="list-group-item d-flex justify-content-between align-items-center"
          >
            <span
              v-if="editCommentId !== comment.id"
              @dblclick="startEdit('comment', comment)"
              class="editable flex-grow-1"
            >
              {{ comment.content }}
            </span>
            <input
              v-else-if="editCommentId === comment.id && editType === 'comment'"
              v-model="editContent"
              @blur="saveEdit(comment, post)"
              @keyup.enter="saveEdit(comment, post)"
              class="edit-input flex-grow-1"
              type="text"
              ref="editInput"
            />
            <button
              class="btn btn-sm btn-outline-danger ml-2"
              @click="confirmDelete('comment', comment)"
            >
              Delete
            </button>
          </li>
        </ul>

        <!-- Add New Comment -->
        <div class="input-group mt-2">
          <input
            type="text"
            v-model="newComment[post.id]"
            @keyup.enter="addComment(post)"
            class="form-control"
            placeholder="Add comment and press Enter"
          />
          <div class="input-group-append">
            <button class="btn btn-primary" @click="addComment(post)">Add</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    new Vue({
      el: "#app",
      data: {
        posts: [],
        newPost: "",
        newComment: {},
        editPostId: null,
        editCommentId: null,
        editContent: "",
        editType: "", // 'post' or 'comment'
      },
      mounted() {
        this.loadPosts();
      },
      methods: {

        loadPosts() {
          axios
            .get("api.php")
            .then((res) => {
              this.posts = res.data;
            })
            .catch((err) => console.error(err));
        },

        addPost() {
          if (!this.newPost.trim()) return;
          axios
            .post("api.php", { type: "post", content: this.newPost })
            .then(() => {
              this.newPost = "";
              this.loadPosts();
            });
        },

        addComment(post) {
          if (!this.newComment[post.id] || !this.newComment[post.id].trim())
            return;
          axios
            .post("api.php", {
              type: "comment",
              content: this.newComment[post.id],
              post_id: post.id,
            })
            .then(() => {
              this.newComment[post.id] = "";
              this.loadPosts();
            });
        },


        startEdit(type, item) {
          this.editType = type;
          if (type === "post") {
            this.editPostId = item.id;
          } 
          else {
            this.editCommentId = item.id;
          }
          this.editContent = item.content;
        },


        saveEdit(item, post = null) {
          if (!this.editContent.trim()) return;
          const type = this.editType;
          const id = item.id;
          const data = {
            type,
            id,
            content: this.editContent,
          };
          axios
            .put("api.php", data)
            .then(() => {
              this.editPostId = null;
              this.editCommentId = null;
              this.editContent = "";
              this.loadPosts();
            })
            .catch((err) => console.error(err));
        },


        confirmDelete(type, item) {
          if (
            confirm(
              `Are you sure you want to delete this ${type === "post" ? "post" : "comment"}?`
            )
          ) {
            this.deleteItem(type, item);
          }
        },


        deleteItem(type, item) {
          axios
            .delete("api.php", { data: { type, id: item.id } })
            .then(() => {
              this.loadPosts();
            })
            .catch((err) => console.error(err));
        },


      },
    });
  </script>
</body>
</html>
