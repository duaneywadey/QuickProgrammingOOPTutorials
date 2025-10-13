<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Agrilands CRUD</title>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
  <h2>BOOTSTRAP 5 (Vanilla JS) Agrilands Management</h2>

  <div class="mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="Search farms..." />
  </div>
  <button class="btn btn-primary mb-3" id="btnResetForm">Reset Form</button>
  <button class="btn btn-primary mb-3" id="btnShowLocation" data-whatever="Batangas">Show Location</button>

  <button class="btn btn-primary mb-3" id="btnShowJsonData" data-whatever='{"farmland_id": 2,"farm_name": "Sunny Acres", "location": "Batangas", "crop_type": "Mango", "owner": "Maria Santos","date_added": "2024-11-30"}'>Show Farm JSON in Modal</button>

  <div id="bodyOfTemplate">
    Main Div
    <div class="paragraph">
      <div class="newparagraph" data-newpardata="Paragraph data 1">First Lorem, ipsum dolor sit amet consectetur, adipisicing elit. Vitae nihil sint, assumenda inventore. Numquam dicta vitae, beatae ipsa a vero quis, suscipit repudiandae velit molestias eligendi necessitatibus esse eos tempore.</div>
    </div>
    <div class="paragraph">
      <div class="newparagraph" data-newpardata="Paragraph data 2">Second Another lorem, ipsum dolor sit amet consectetur, adipisicing elit. Vitae nihil sint, assumenda inventore. Numquam dicta vitae, beatae ipsa a vero quis, suscipit repudiandae velit molestias eligendi necessitatibus esse eos tempore.</div>
    </div>
    <div class="paragraph">
      <div class="newparagraph" data-newpardata="Paragraph data 3">Third lorem, ipsum dolor sit amet consectetur, adipisicing elit. Vitae nihil sint, assumenda inventore. Numquam dicta vitae, beatae ipsa a vero quis, suscipit repudiandae velit molestias eligendi necessitatibus esse eos tempore.</div>
    </div>
    <div class="paragraph">
      <div class="newparagraph" data-newpardata="Paragraph data 4">Fourth lorem, ipsum dolor sit amet consectetur, adipisicing elit. Vitae nihil sint, assumenda inventore. Numquam dicta vitae, beatae ipsa a vero quis, suscipit repudiandae velit molestias eligendi necessitatibus esse eos tempore.</div>
    </div>
  </div>
</div>

<!-- Add/Edit Farm Modal -->
<div class="modal fade" id="farmModal" tabindex="-1" aria-labelledby="farmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="farmModalLabel">Add Farm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="farmForm">
          <input type="hidden" id="farmland_id" name="farmland_id" />
          <div class="mb-3">
            <label for="farm_name" class="form-label">Farm Name</label>
            <input type="text" class="form-control" id="farm_name" name="farm_name" required />
          </div>
          <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" required />
          </div>
          <div class="mb-3">
            <label for="crop_type" class="form-label">Crop Type</label>
            <input type="text" class="form-control" id="crop_type" name="crop_type" required />
          </div>
          <div class="mb-3">
            <label for="owner" class="form-label">Owner</label>
            <input type="text" class="form-control" id="owner" name="owner" required />
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger me-auto" id="btnDeleteFarm" style="display:none;">Delete</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="farmForm" class="btn btn-primary" id="btnSaveFarm">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const farmModalEl = document.getElementById('farmModal');
  const farmModal = new bootstrap.Modal(farmModalEl);


  // Event delegation example
  document.getElementById('bodyOfTemplate').addEventListener('click', function (e) {

    // Prints element we clicked
    console.log(e.target);

    // Prints the className of the clicked element (string)
    console.log(e.target.className);

    // Prints the element's attributes NamedNodeMap object
    console.log(e.target.attributes);

    // Prints the tag name of the element (e.g. "DIV", "BUTTON") - always present as a string
    console.log(e.target.tagName);

    // Prints the inner text of the element
    console.log(e.target.innerText);

    // Prints the element's CSS class list as a DOMTokenList
    console.log(e.target.classList);

    // Prints the parent element node (or null if none)
    console.log(e.target.parentElement);

    // Prints the value of the data attribute 'newpardata' (string or undefined if not set)
    console.log(e.target.dataset.newpardata);
  });



// Add click event listener to button with id 'btnShowLocation'
document.getElementById('btnShowLocation').addEventListener('click', function() {

  // Get the value of the 'data-whatever' attribute from the clicked button
  const farmData = this.getAttribute('data-whatever');
  
  // Log the data attribute value to the console
  console.log(farmData);
  
  // Show the modal dialog, assumed to be referenced by farmModal variable
  farmModal.show();
});

// Add click event listener to the element with ID 'btnShowLocation'
document.getElementById('btnShowLocation').addEventListener('click', function() {
  
  // Get the value of the attribute 'data-whatever' on the clicked button
  const farmData = this.getAttribute('data-whatever');
  
  // Log the value stored in the data-whatever attribute
  console.log(farmData);
  
  // Show the modal window referenced by farmModal
  farmModal.show();

});

// Add click event listener to the element with ID 'btnShowJsonData'
document.getElementById('btnShowJsonData').addEventListener('click', function() {
  
  // Parse the JSON string stored in the data attribute 'data-whatever' on the clicked button
  const farmData = JSON.parse(this.getAttribute('data-whatever'));
  
  // Log the parsed JavaScript object
  console.log(farmData);
  
  // Set the form input with ID 'farmland_id' to the parsed object's (farmData) farmland_id property
  document.getElementById('farmland_id').value = farmData.farmland_id;
  
  // Set the form input with ID 'farm_name' to the parsed object's (farmData) farm_name property
  document.getElementById('farm_name').value = farmData.farm_name;
  
  // Set the form input with ID 'location' to the parsed object's (farmData) location property
  document.getElementById('location').value = farmData.location;
  
  // Set the form input with ID 'crop_type' to the parsed object's (farmData) crop_type property
  document.getElementById('crop_type').value = farmData.crop_type;
  
  // Set the form input with ID 'owner' to the parsed object's (farmData) owner property
  document.getElementById('owner').value = farmData.owner;
  
  // Show the modal window referenced by farmModal
  farmModal.show();
});

// Add click event listener to the element with ID 'btnResetForm'
document.getElementById('btnResetForm').addEventListener('click', function () {
  
  // Reset all values of the form referenced by farmForm
  farmForm.reset();
  
  // Alert the user that the form has been reset
  alert("The form has been reset!");
});

</script>
</body>
</html>









