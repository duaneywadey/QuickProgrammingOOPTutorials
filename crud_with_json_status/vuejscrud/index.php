<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student Record To-Do List</title>
  <!-- Bootstrap 4 CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>

<div id="app" class="container my-4">
  <h2 class="mb-4">Student Records</h2>

  <!-- Insert New Student -->
  <form @submit.prevent="addStudent" class="mb-3">
    <div class="form-row">
      <div class="col">
        <input v-model="newStudent.name" type="text" class="form-control" placeholder="Name" required />
      </div>
      <div class="col">
        <input v-model="newStudent.age" type="number" class="form-control" placeholder="Age" required min="1" />
      </div>
      <div class="col">
        <input v-model="newStudent.email" type="email" class="form-control" placeholder="Email" required />
      </div>
      <div class="col-auto">
        <button class="btn btn-primary" type="submit">Add Student</button>
      </div>
    </div>
  </form>

  <!-- Student List Table -->
  <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Email</th>
        <th style="width:120px;">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="student in students" :key="student.id">
        <td>{{ student.name }}</td>
        <td>{{ student.age }}</td>
        <td>{{ student.email }}</td>
        <td>
          <button class="btn btn-info btn-sm mr-2" @click="openEditModal(student)">Edit</button>
          <button class="btn btn-danger btn-sm" @click="openDeleteModal(student)">Delete</button>
        </td>
      </tr>
      <tr v-if="students.length === 0">
        <td colspan="4" class="text-center">No students found.</td>
      </tr>
    </tbody>
  </table>

  <!-- Edit Student Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" ref="editModal">
    <div class="modal-dialog" role="document">
      <form @submit.prevent="updateStudent" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
          <button type="button" class="close" @click="closeEditModal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Name</label>
            <input v-model="editStudent.name" type="text" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Age</label>
            <input v-model="editStudent.age" type="number" class="form-control" min="1" required />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input v-model="editStudent.email" type="email" class="form-control" required />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="closeEditModal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Student</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Delete Student Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true" ref="deleteModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
          <button type="button" class="close" @click="closeDeleteModal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete student "<strong>{{ deleteStudent.name }}</strong>"?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="closeDeleteModal">Cancel</button>
          <button type="button" class="btn btn-danger" @click="deleteStudentConfirm">Delete</button>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- VueJS CDN -->
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<!-- Bootstrap 4 JS + dependencies (jQuery & Popper.js) CDN -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
new Vue({
  el: '#app',
  data: {
    students: [],
    newStudent: { name: '', age: '', email: '' },
    editStudent: {},
    deleteStudent: {},
  },
  mounted() {
    this.fetchStudents();
  },
  methods: {
    fetchStudents() {
      fetch('students.php?action=list')
        .then(res => res.json())
        .then(data => {
          this.students = data;
        });
    },
    addStudent() {
      fetch('students.php?action=add', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(this.newStudent)
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          this.fetchStudents();
          this.newStudent = { name: '', age: '', email: '' };
        } else {
          alert('Failed to add student');
        }
      });
    },
    openEditModal(student) {
      this.editStudent = Object.assign({}, student);
      $('#editModal').modal('show');
    },
    closeEditModal() {
      $('#editModal').modal('hide');
    },
    updateStudent() {
      fetch('students.php?action=edit', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(this.editStudent)
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          this.fetchStudents();
          this.closeEditModal();
        } else {
          alert('Failed to update student');
        }
      });
    },
    openDeleteModal(student) {
      this.deleteStudent = student;
      $('#deleteModal').modal('show');
    },
    closeDeleteModal() {
      $('#deleteModal').modal('hide');
    },
    deleteStudentConfirm() {
      fetch('students.php?action=delete', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ id: this.deleteStudent.id })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          this.fetchStudents();
          this.closeDeleteModal();
        } else {
          alert('Failed to delete student');
        }
      });
    }
  }
});
</script>
</body>
</html>
