<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Add New User with Axios</title>
  <!-- Bootstrap 4 CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Axios -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
  <div class="container my-4">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header"><h1>Add a New User</h1></div>
          <div class="card-body">
            <form id="addUserForm">
              <div class="form-group">
                <label for="usernameInput">Username</label>
                <input type="text" class="form-control" id="usernameInput" required>
              </div>
              <div class="form-group">
                <label for="emailInput">Email</label>
                <input type="email" class="form-control" id="emailInput" required>
              </div>
              <button type="submit" class="btn btn-primary">Add User</button>
            </form>
            <div id="statusMessage" class="mt-3"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.getElementById('addUserForm').addEventListener('submit', function(event) {
      event.preventDefault();
      document.getElementById('statusMessage').textContent = ''; // Clear previous

      const username = document.getElementById('usernameInput').value;
      const email = document.getElementById('emailInput').value;

      axios.post('https://jsonplaceholder.typicode.com/users', {
        username: username,
        email: email
      })
      .then(function(response) {
        document.getElementById('statusMessage').innerHTML =
          '<div class="alert alert-success">User added!<br>Returned ID: ' +
          response.data.id +
          '<br><strong>Username:</strong> ' + response.data.username +
          '<br><strong>Email:</strong> ' + response.data.email +
          '</div>';
        console.log(response);
      })
      .catch(function(error) {
        document.getElementById('statusMessage').innerHTML =
          '<div class="alert alert-danger">Error: ' + error + '</div>';
      });
    });
  </script>

  <!-- Optional Bootstrap JS (not required for this functionality) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
