<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student Record To-Do List - Alpine.js</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
  <div class="container" x-data="nameAndLocationComponent()">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-header">
            <h2>Get Name Age and Location!</h2>
          </div>
          <div class="card-body">
            <form action="#" @submit.prevent="submitNameLoc">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" 
                       x-model="newNameAndLocation.nameInput" 
                       placeholder="Enter name" required>
              </div>
              <div class="form-group">
                <label>Location</label>
                <input type="text" class="form-control" 
                       x-model="newNameAndLocation.locationInput" 
                       placeholder="Enter location" required>
              </div>
              <input type="submit" class="btn btn-primary float-right mt-4" value="Submit">

              <!-- Live display using exact same nested paths -->
              <div class="mt-4 p-3 border rounded">
                <h5>Live Preview:</h5>
                   <p><strong>Name:</strong> 
                   <span x-text="newNameAndLocation.nameInput || 'Not entered'"></span></p>
                   <p><strong>Location:</strong> 
                   <span x-text="newNameAndLocation.locationInput || 'Not entered'"></span></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function nameAndLocationComponent() {
      return {
        newNameAndLocation: { 
          nameInput: '',
          locationInput: ''
        },
        submitNameLoc() {
          const formData = new FormData();
          formData.append('name', this.newNameAndLocation.nameInput);
          formData.append('location', this.newNameAndLocation.locationInput);

          fetch('handleForms.php', {
            method: 'POST',
            body: formData  
          })
          .then(response => response.json())
          .then(data => {
            alert(data.message); // Shows "Hello there, <name> and you're from <location>"
          })
          .catch(error => console.error('Error:', error));
        }

        // submitNameLoc() {
        //   console.log(this.newNameAndLocation);
        //   console.log(this.newNameAndLocation.nameInput);
        //   console.log(this.newNameAndLocation.locationInput);
        //   console.log("FORM SUBMITTED, NAME: " + this.newNameAndLocation.nameInput + ", LOC: " + this.newNameAndLocation.locationInput);
        // }
      }
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
