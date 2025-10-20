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
    <h2>Agrilands Management</h2>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search farms..." />
    </div>

    <button class="btn btn-primary mb-3" id="btnAddFarm">Add New Farm</button>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Farm Name</th>
            <th>Location</th>
            <th>Crop Type</th>
            <th>Owner</th>
            <th>Date Added</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="farmTableBody">
        <!-- Data filled by jQuery -->
        </tbody>
    </table>
</div>

<!-- Add Farm Modal -->
<div class="modal fade" id="addFarmModal" tabindex="-1" role="dialog" aria-labelledby="addFarmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="addFarmForm">
        <div class="modal-header">
          <h5 class="modal-title" id="addFarmModalLabel">Add Farm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">            
            <div class="form-group">
                <label for="add_farm_name">Farm Name</label>
                <input type="text" class="form-control" id="add_farm_name" name="farm_name" required />
            </div>
            <div class="form-group">
                <label for="add_location">Location</label>
                <input type="text" class="form-control" id="add_location" name="location" required />
            </div>
            <div class="form-group">
                <label for="add_crop_type">Crop Type</label>
                <input type="text" class="form-control" id="add_crop_type" name="crop_type" required />
            </div>
            <div class="form-group">
                <label for="add_owner">Owner</label>
                <input type="text" class="form-control" id="add_owner" name="owner" required />
            </div>          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="btnSaveAddFarm">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Farm Modal -->
<div class="modal fade" id="editFarmModal" tabindex="-1" role="dialog" aria-labelledby="editFarmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="editFarmForm">
        <input type="hidden" id="edit_farmland_id" name="farmland_id" />
        <div class="modal-header">
          <h5 class="modal-title" id="editFarmModalLabel">Edit Farm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">         
            <div class="form-group">
                <label for="edit_farm_name">Farm Name</label>
                <input type="text" class="form-control" id="edit_farm_name" name="farm_name" required />
            </div>
            <div class="form-group">
                <label for="edit_location">Location</label>
                <input type="text" class="form-control" id="edit_location" name="location" required />
            </div>
            <div class="form-group">
                <label for="edit_crop_type">Crop Type</label>
                <input type="text" class="form-control" id="edit_crop_type" name="crop_type" required />
            </div>
            <div class="form-group">
                <label for="edit_owner">Owner</label>
                <input type="text" class="form-control" id="edit_owner" name="owner" required />
            </div>          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger mr-auto" id="btnDeleteFarm">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="btnSaveEditFarm">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(function() {
    loadFarms();

    $('#searchInput').on('input', function() {
        loadFarms($(this).val());
    });

    // Show add modal
    $('#btnAddFarm').click(function() {
        $('#addFarmForm')[0].reset();
        $('#addFarmModal').modal('show');
    });

    // Add farm submit
    $('#addFarmForm').submit(function(e) {
        e.preventDefault();
        let farmData = {
            farm_name: $('#add_farm_name').val(),
            location: $('#add_location').val(),
            crop_type: $('#add_crop_type').val(),
            owner: $('#add_owner').val()
        };

        $.ajax({
            url: 'api.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ action: 'create', farm: farmData }),
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    $('#addFarmModal').modal('hide');
                    loadFarms($('#searchInput').val());
                    console.log(res);
                } else {
                    alert(res.message || 'An error occurred');
                }
            }
        });
    });

    // Edit farm button click
    $(document).on('click', '.btn-edit', function() {
        // Decode URI component and parse JSON safely
        let farmJson = decodeURIComponent($(this).attr('data-farm'));
        let farm = JSON.parse(farmJson);
        $('#edit_farmland_id').val(farm.farmland_id);
        $('#edit_farm_name').val(farm.farm_name);
        $('#edit_location').val(farm.location);
        $('#edit_crop_type').val(farm.crop_type);
        $('#edit_owner').val(farm.owner);
        $('#editFarmModal').modal('show');
    });

    // Edit farm submit
    $('#editFarmForm').submit(function(e) {
        e.preventDefault();
        let farmData = {
            farmland_id: $('#edit_farmland_id').val(),
            farm_name: $('#edit_farm_name').val(),
            location: $('#edit_location').val(),
            crop_type: $('#edit_crop_type').val(),
            owner: $('#edit_owner').val()
        };

        $.ajax({
            url: 'api.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ action: 'update', farm: farmData }),
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    $('#editFarmModal').modal('hide');
                    loadFarms($('#searchInput').val());
                } else {
                    alert(res.message || 'An error occurred');
                }
            }
        });
    });

    // Delete farm
    $('#btnDeleteFarm').click(function() {
        if (confirm('Are you sure you want to delete this farm?')) {
            let farmland_id = $('#edit_farmland_id').val();
            $.ajax({
                url: 'api.php',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ action: 'delete', farmland_id: farmland_id }),
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        $('#editFarmModal').modal('hide');
                        loadFarms($('#searchInput').val());
                    } else {
                        alert(res.message || 'Failed to delete');
                    }
                }
            });
        }
    });

    // Load farms and render rows
    function loadFarms(search = '') {
        $.ajax({
            url: 'api.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ action: 'read', search: search }),
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    let rows = '';
                    res.data.forEach(farm => {
                        // Encode JSON object as URI component for safe attribute storing
                        let dataFarm = encodeURIComponent(JSON.stringify(farm));
                        rows += `<tr>
                                    <td>${farm.farm_name}</td>
                                    <td>${farm.location}</td>
                                    <td>${farm.crop_type}</td>
                                    <td>${farm.owner}</td>
                                    <td>${farm.date_added}</td>
                                    <td><button class="btn btn-sm btn-info btn-edit" data-farm="${dataFarm}">Edit</button></td>
                                </tr>`;
                    });
                    $('#farmTableBody').html(rows);
                } else {
                    $('#farmTableBody').html('<tr><td colspan="6">No records found</td></tr>');
                }
            }
        });
    }
});
</script>
</body>
</html>
