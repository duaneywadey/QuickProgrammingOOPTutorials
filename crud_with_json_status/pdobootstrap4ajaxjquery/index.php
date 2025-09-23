<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management with PHP, jQuery, Bootstrap 4, PDO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>User Management</h2>
        <div class="form-group">
            <input type="text" id="searchInput" class="form-control" placeholder="Search users by name or email">
        </div>
        <form id="addUserForm" class="form-inline mb-3">
            <input type="text" id="name" class="form-control mr-2" placeholder="Name" required>
            <input type="email" id="email" class="form-control mr-2" placeholder="Email" required>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
        <table class="table table-bordered table-striped" id="usersTable">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="deleteModal">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete user <strong id="deleteUserName"></strong>?</p>
        <input type="hidden" id="deleteUserId" />
    </div>
    <div class="modal-footer">
        <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
</div>
</div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){

        function loadUsers(search = '') {
            $.ajax({
                url: 'api.php?action=list&search=' + encodeURIComponent(search),
                method: 'GET',
                dataType: 'json',
                success: function(users) {
                    let rows = '';
                    for (let i = 0; i < users.length; i++) {
                        const user = users[i];
                        rows += `
                        <tr data-id="${user.id}">
                        <td>${user.id}</td>
                        <td class="editable name">${escapeHtml(user.name)}</td>
                        <td class="editable email">${escapeHtml(user.email)}</td>
                        <td>
                        <button class="btn btn-sm btn-danger btn-delete">Delete</button>
                        </td>
                        </tr>`;
                    }
                    $('#usersTable tbody').html(rows);
                }
            });
        }


        function escapeHtml(text) {
          return $('<div>').text(text).html();
      }

      loadUsers();

    // Search users on input
    $('#searchInput').on('input', function(){
        const query = $(this).val();
        loadUsers(query);
    });

    // Insert user without reload
    $('#addUserForm').on('submit', function(e){
        e.preventDefault();
        const name = $('#name').val().trim();
        const email = $('#email').val().trim();
        if(name === '' || email === '') return;
        $.ajax({
            url: 'api.php?action=insert',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({name, email}),
            dataType: 'json',
            success: function(response){
                if(response.success) {
                    $('#name').val('');
                    $('#email').val('');
                    loadUsers();
                } else {
                    alert('Insert Error: ' + (response.error || 'Unknown error'));
                }
            }
        });
    });

    // Double click row to edit
    $('#usersTable').on('dblclick', 'td.editable', function(){
        if($('#usersTable').find('tr.editing').length) return; // only one editing at a time

        const $td = $(this);
        const $tr = $td.closest('tr');
        const id = $tr.data('id');
        const currentName = $tr.find('td.name').text();
        const currentEmail = $tr.find('td.email').text();

        $tr.addClass('editing');

        // replace name and email cells with input fields
        $tr.find('td.name').html(`<input type="text" class="form-control form-control-sm" value="${escapeHtml(currentName)}" />`);
        $tr.find('td.email').html(`<input type="email" class="form-control form-control-sm" value="${escapeHtml(currentEmail)}" />`);

        // change actions column to show save and cancel buttons
        $tr.find('td:last').html(`
          <button class="btn btn-sm btn-success btn-save">Save</button>
          <button class="btn btn-sm btn-secondary btn-cancel">Cancel</button>
          `);
    });

    // Cancel edit
    $('#usersTable').on('click', '.btn-cancel', function(){
        const $tr = $(this).closest('tr');
        const id = $tr.data('id');
        $tr.removeClass('editing');
        loadUsers($('#searchInput').val());  // reload to reset row
    });

    // Save update
    $('#usersTable').on('click', '.btn-save', function(){
        const $tr = $(this).closest('tr');
        const id = $tr.data('id');
        const newName = $tr.find('td.name input').val().trim();
        const newEmail = $tr.find('td.email input').val().trim();
        if(newName === '' || newEmail === '') {
            alert('Name and email cannot be empty');
            return;
        }
        $.ajax({
            url: 'api.php?action=update',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({id, name: newName, email: newEmail}),
            dataType: 'json',
            success: function(response){
                if(response.success) {
                    $tr.removeClass('editing');
                    loadUsers($('#searchInput').val());
                } else {
                    alert('Update Error: ' + (response.error || 'Unknown error'));
                }
            }
        });
    });

    // Show delete confirmation modal
    $('#usersTable').on('click', '.btn-delete', function(){
        const $tr = $(this).closest('tr');
        const id = $tr.data('id');
        const name = $tr.find('td.name').text();
        $('#deleteUserId').val(id);
        $('#deleteUserName').text(name);
        $('#deleteModal').modal('show');
    });

    // Confirm delete
    $('#confirmDeleteBtn').on('click', function(){
        const id = $('#deleteUserId').val();
        $.ajax({
            url: 'api.php?action=delete',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({id}),
            dataType: 'json',
            success: function(response){
                if(response.success) {
                    $('#deleteModal').modal('hide');
                    loadUsers($('#searchInput').val());
                } else {
                    alert('Delete Error: ' + (response.error || 'Unknown error'));
                }
            }
        });
    });

});
</script>
</body>
</html>
