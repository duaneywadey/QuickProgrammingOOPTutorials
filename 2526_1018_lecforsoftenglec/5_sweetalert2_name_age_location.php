<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Age and Location Checker</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <h1>Only people from NCR and age at least 18 are accepted!</h1>
  <form id="checkForm">
    <label>
      Name:
      <input type="text" name="name" required />
    </label><br/><br/>
    <label>
      Age:
      <input type="number" name="age" min="0" required />
    </label><br/><br/>
    <label>
      Location:
      <input type="text" name="location" required />
    </label><br/><br/>
    <button type="submit">Submit</button>
  </form>

  <script>
    document.getElementById('checkForm').addEventListener('submit', function(e) {
      e.preventDefault();

      var formData = new FormData(e.target);
      var data = {
        action: 'checkAgeLocation',
        name: formData.get('name'),
        age: parseInt(formData.get('age')),
        location: formData.get('location').trim()
      };

      fetch('5a_name_age_location.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
      .then(function(response) {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(function(result) {
        if (result.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Request is successful',
            html: 'Hello, <strong>' + result.name + '</strong>! Your age <strong>' + result.age + '</strong> is valid. How is it there in <strong>' + result.location + '</strong>?',
            confirmButtonText: 'OK'
          });
        } else {
          // For any error, show one popup with the API-provided message
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: result.message || 'An unexpected error occurred',
            confirmButtonText: 'OK'
          });
        }
      })
      .catch(function(error) {
        Swal.fire({
          icon: 'error',
          title: 'Network Error',
          text: error.message,
          confirmButtonText: 'OK'
        });
      });
    });
  </script>
</body>
</html>
