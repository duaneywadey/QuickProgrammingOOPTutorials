<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Users List with Axios and Promises</title>

  <!-- Bootstrap 4 CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Axios -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
  <div class="container my-4">
    <div class="row justify-content-center mb-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-3">Filter Users by ID</h5>
            <form id="filterForm" autocomplete="off" onsubmit="return false;">
              <div class="form-group">
                <label for="userIdInput">User ID</label>
                <input type="number" class="form-control" id="userIdInput" placeholder="Enter user ID (optional)" min="1" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="cards" class="row"></div>
  </div>

  <script>
    // Render users as Bootstrap cards using innerHTML
    function renderUsers(users) {
      const container = document.getElementById('cards');
      if (!users) {
        container.innerHTML = `
          <div class="col-12">
            <div class="alert alert-info" role="alert">No users found.</div>
          </div>
        `;
        return;
      }

      // For a single user object, normalize to an array
      const userArray = Array.isArray(users) ? users : [users];

      if (userArray.length === 0) {
        container.innerHTML = `
          <div class="col-12">
            <div class="alert alert-info" role="alert">No users found.</div>
          </div>
        `;
        return;
      }

      // Build a single HTML string by iterating over the data
      let html = '';

      for (let i = 0; i < userArray.length; i++) {
        const u = userArray[i];
        html += `
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title">${u.name || 'Unknown'}</h5>
                <h5 class="card-title">User ID: ${u.id}</h5>
                <p class="card-text mb-1"><strong>Username:</strong> ${u.username || ''}</p>
                <p class="card-text mb-0"><strong>Email:</strong> ${u.email || ''}</p>
              </div>
            </div>
          </div>
        `;
      }

      container.innerHTML = html;
    }

    // Load users from JSONPlaceholder with Promises (then/catch)
    function loadUsers(userIDVal = "") {
      // If a specific ID is provided, fetch that user; otherwise fetch all users
      const url = userIDVal ? `https://jsonplaceholder.typicode.com/users/${userIDVal}` : 'https://jsonplaceholder.typicode.com/users';
      axios.get(url)
        .then(function (response) {
          const data = response.data;
          // When a specific ID is requested, data is a single object; otherwise an array
          renderUsers(data);
        })
        .catch(function (error) {
          const msg = (error && error.response && error.response.data && error.response.data.message) ||
                      error.message ||
                      'Failed to fetch users';
          const container = document.getElementById('cards');
          container.innerHTML = `
            <div class="col-12">
              <div class="alert alert-danger" role="alert">${msg}</div>
            </div>
          `;
        });
    }

    document.getElementById('filterForm').addEventListener('submit', function (event) {
      event.preventDefault();
      loadUsers(document.getElementById('userIdInput').value);
    });

    // Initial load: fetch and display all users
    window.addEventListener('DOMContentLoaded', function() {
      loadUsers();
    });
  </script>

  <!-- Optional Bootstrap JS (not required for this functionality) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
