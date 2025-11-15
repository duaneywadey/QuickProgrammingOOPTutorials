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
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header"><h1>Get User Info!</h1></div>
          <div class="card-body">
            <form id="getUsers">
              <input type="text" class="form-control" id="userIDInputVal">
            </form>
            <div id="resultHere"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function getUsersInJSON(userID="") {
      axios.get('https://jsonplaceholder.typicode.com/users/' + userID)
        .then(function (response) {
          console.log(response.data);
          console.log(response.config);
          console.log(response.headers);
          console.log(response.request);
          console.log(response);
          document.getElementById('resultHere').innerHTML = JSON.stringify(response);
        })
        .catch(function (error) {
          console.log(error);
        });
    }

    document.getElementById('getUsers').addEventListener('submit', function (event) {
      event.preventDefault();
      getUsersInJSON(document.getElementById('userIDInputVal').value);
    })
  </script>

  <!-- Optional Bootstrap JS (not required for this functionality) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
