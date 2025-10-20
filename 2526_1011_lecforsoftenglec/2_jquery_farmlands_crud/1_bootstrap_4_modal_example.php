<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Agrilands CRUD</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h2>Bootstrap 4 (JQUERY) Agrilands Management</h2>
    <button class="btn btn-primary mb-3" id="btnResetForm">Reset Form</button>
    <button class="btn btn-primary mb-3" id="btnShowLocation" data-locationinput="Batangas">Show Location</button>

    <button class="btn btn-primary mb-3" id="btnShowJsonData" data-farmdatajson='{ "farmland_id": 2,"farm_name": "Sunny Acres", "location": "Cavite", "crop_type": "Corn", "owner": "Maria Santos","date_added": "2024-11-30"}'>Show Farm JSON in Modal</button>
</div>

<!-- Add/Edit Farm Modal -->
<div class="modal fade" id="farmModal" tabindex="-1" role="dialog" aria-labelledby="farmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="farmModalLabel">Add Farm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="farmForm">
            <input type="hidden" id="farmland_id" name="farmland_id" />
            <div class="form-group">
                <label for="farm_name">Farm Name</label>
                <input type="text" class="form-control" id="farm_name" name="farm_name" required />
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location" required />
            </div>
            <div class="form-group">
                <label for="crop_type">Crop Type</label>
                <input type="text" class="form-control" id="crop_type" name="crop_type" required />
            </div>
            <div class="form-group">
                <label for="owner">Owner</label>
                <input type="text" class="form-control" id="owner" name="owner" required />
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger mr-auto" id="btnDeleteFarm" style="display:none;">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="farmForm" class="btn btn-primary" id="btnSaveFarm">Save</button>
      </div>
    </div>
  </div>
</div>

<script>

// Show modal containing string
$('#btnShowLocation').click(function() {
    var button = $(this); // 'this' is the clicked button
    var farmData = button.data('locationinput'); // get value from data-whatever attribute
    console.log(farmData);
    $('#farmModal').modal('show');
});

// Show modal containing new farm data
$('#btnShowJsonData').click(function() {
    var button = $(this); // 'this' is the clicked button
    var farmData = button.data('farmdatajson'); // get value from data-whatever attribute
    console.log(farmData);
    $('#farm_name').val(farmData.farm_name);
    $('#location').val(farmData.location);
    $('#crop_type').val(farmData.crop_type);
    $('#owner').val(farmData.owner);
    $('#farmModal').modal('show');
});

// Reset form
$('#btnResetForm').click(function () {
    $('#farmForm')[0].reset();
})

// Returns the element
// console.log($('#farmForm')[0]);
</script>
</body>
</html>
