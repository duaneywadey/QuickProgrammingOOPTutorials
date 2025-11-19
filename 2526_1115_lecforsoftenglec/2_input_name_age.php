<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>User Validation</title>
  <link rel="stylesheet" href="vendor/bootstrap.css">
  <script src="vendor/axios.js"></script>
  <script src="vendor/sweetalert.js"></script>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header"><h1>Input Name and Age</h1></div>
          <div class="card-body">
             <form id="validationForm" autocomplete="off" onsubmit="return false;">
              <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" id="name" name="name" required/>
              </div>
              <div class="form-group">
                <label> Location (NCR or other): </label>
                <input type="text" class="form-control" id="location" name="location" required />
              </div>
              <button type="submit" onclick="validateUser()" class="btn btn-primary float-right">Validate</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function validateUser() {
      const data = { 
        name:  document.getElementById('name').value || '',
        location: document.getElementById('location').value || '' 
      };

      // Use Promise-based Axios call
      axios.post('2_receive_name_age.php', data, {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      }).then(function (response) {
        console.log(response);
        const data = response.data;
        console.log(data);
        if (data && data.success === true) {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: data.message
          });
        } else {
          Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: data.message
          });
        }
      }).catch(function (err) {
        const msg = (err && err.response && err.response.data && err.response.data.message) || err.message || 'An error occurred';
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: msg
        });
      });
    }
  </script>
</body>
</html>
