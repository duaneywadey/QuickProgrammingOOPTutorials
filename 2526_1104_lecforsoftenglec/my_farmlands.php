<?php require_once 'data_model/dbconfig.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>

<link rel="stylesheet" href="vendor/bootstrap.css">
<script src="vendor/jquery.js"></script>
<script src="vendor/popper.js"></script>
<script src="vendor/bootstrap.js"></script>
<script src="vendor/sweetalert.js"></script>
<style>
.redBorder { border-style: solid; }
</style>
</head>
<body>
<?php require_once 'includes/navbar.php'; ?>

<div class="container">
  <h1 class="display-4 text-center">Your Farmlands</h1>

  <div class="row justify-content-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add new farm</button>
  </div>

  <div class="row justify-content-center farmsByUserHere" id="farmsByUserHere"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="insertNewFarmForm" class="modal-form">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Farm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" id="farmlandAddressInput" required>
          </div>
          <div class="form-group">
            <label>Location</label>
            <input type="text" class="form-control" id="farmlandLocInput" required>
          </div>
          <div class="form-group">
            <label>Crop Type</label>
            <input type="text" class="form-control" id="farmlandCropTypeInput" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Farm</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
const userID = "<?php echo $_SESSION['user_id']; ?>";

function getFarmsByUserID() {
  return fetch('api.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ userIDInput: userID, action: 'getAllFarmsByUserID' })
  })
  .then(res => res.json())
  .then(data => {
    let rows = '';
    for (let i = 0; i < data.length; i++) {
      const item = data[i];
      rows += `
        <div class="col-md-4 mt-4">
          <div class="card shadow mt-4">
            <div class="card-body">
              <h4>Location: ${item.location}</h4>
              <p>Address: ${item.farmland_address}</p>
              <p>Crop: ${item.crop_type}</p>
              <button class="btn btn-danger btn-sm mt-2" onclick="deleteFarm(${item.farmland_id})">Delete</button>
            </div>
          </div>
        </div>`;
    }
    document.getElementById('farmsByUserHere').innerHTML = rows;
  })
  .catch(err => {
    console.error('Fetch error:', err);
  });
}

function deleteFarm(farmlandId) {
  // Confirm with SweetAlert
  Swal.fire({
    title: 'Delete this farm?',
    text: 'This action cannot be undone.',
    icon: 'warning',
    showCancelButton: true,
    cancelButtonText: 'Cancel',
    confirmButtonText: 'Yes, delete it'
  }).then((result) => {
    if (result.isConfirmed) {
      // Call API to delete
      fetch('api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'deleteFarm', farmland_id: farmlandId })
      })
      .then(res => res.json())
      .then(res => {
        if (res && res.success) {
          Swal.fire('Deleted!', 'The farm has been deleted.', 'success');
          getFarmsByUserID();
        } else {
          Swal.fire('Error', res.error || 'Could not delete', 'error');
        }
      })
      .catch(err => {
        console.error('Delete error:', err);
        Swal.fire('Error', 'Request failed', 'error');
      });
    }
  });
}


document.addEventListener('DOMContentLoaded', function () {
  getFarmsByUserID();
});

// Handle form submission with Promises
document.getElementById('insertNewFarmForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const payload = {
    userIDInput: userID,
    farmlandAddressInput: document.getElementById('farmlandAddressInput').value.trim(),
    farmlandLocInput: document.getElementById('farmlandLocInput').value.trim(),
    farmlandCropTypeInput: document.getElementById('farmlandCropTypeInput').value.trim(),
    action: 'insertFarm'
  };

  // Client-side validation
  if (!payload.farmlandAddressInput || !payload.farmlandLocInput || !payload.farmlandCropTypeInput) {
    alert('Please fill in all fields.');
    return;
  }

  fetch('api.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  })
  .then(res => res.json())
  .then(result => {
    if (result.success) {
      // Success: hide modal, reset form, refresh list
      $('#exampleModal').modal('hide');
      document.getElementById('insertNewFarmForm').reset();
      return getFarmsByUserID();
    } else {
      alert('Error saving farm: ' + (result.error || 'Unknown error'));
    }
  })
  .catch(err => {
    console.error('Insert error:', err);
  });
});
</script>
<script src="vendor/logout.js"></script>
</body>
</html>
