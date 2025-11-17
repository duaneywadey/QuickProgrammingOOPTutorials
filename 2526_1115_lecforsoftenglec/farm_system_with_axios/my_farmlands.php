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
<script src="vendor/axios.js"></script>

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

<!-- Update Farm Modal -->
<div class="modal fade" id="updateFarmModal" tabindex="-1" aria-labelledby="updateFarmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="updateFarmForm" class="modal-form">
        <div class="modal-header">
          <h5 class="modal-title" id="updateFarmModalLabel">Update Farm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Hidden input for farm id -->
          <input type="hidden" id="updateFarmlandId" name="farmland_id" />
          <div class="form-group">
            <label for="updateFarmlandAddressInput">Address</label>
            <input type="text" class="form-control" id="updateFarmlandAddressInput" name="farmland_address" required>
          </div>
          <div class="form-group">
            <label for="updateFarmlandLocInput">Location</label>
            <input type="text" class="form-control" id="updateFarmlandLocInput" name="location" required>
          </div>
          <div class="form-group">
            <label for="updateFarmlandCropTypeInput">Crop Type</label>
            <input type="text" class="form-control" id="updateFarmlandCropTypeInput" name="crop_type" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Farm</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  const userID = "<?php echo $_SESSION['user_id']; ?>";

  function getFarmsByUserID() {
    return axios.post('api.php', {
      userIDInput: userID,
      action: 'getAllFarmsByUserID'
    })
    .then(res => {
      const data = res.data; 
      let rows = '';
      for (let i = 0; i < data.result_set.length; i++) {
        rows += `
          <div class="col-md-4 mt-4">
            <div class="farmCard card shadow mt-4">
              <div class="card-body">
                <h4>Location: ${data.result_set[i].location}</h4>
                <p>Address: ${data.result_set[i].farmland_address}</p>
                <p>Crop: ${data.result_set[i].crop_type}</p>
                
                <button class="showInfo btn btn-info btn-sm mt-2" data-json='${JSON.stringify(data.result_set[i])}'>Update</button>

                <button class="btn btn-danger btn-sm mt-2" onclick="deleteFarm(${data.result_set[i].farmland_id})">Delete</button>

              </div>
            </div>
          </div>`;
      }
      document.getElementById('farmsByUserHere').innerHTML = rows;
    })
    .catch(err => {
      console.error('Axios getFarmsByUserID error:', err);
    });
  }

function deleteFarm(farmlandId) {
  Swal.fire({
    title: 'Delete this farm?',
    text: 'This action cannot be undone.',
    icon: 'warning',
    showCancelButton: true,
    cancelButtonText: 'Cancel',
    confirmButtonText: 'Yes, delete it'
  }).then((result) => {
    if (result.isConfirmed) {
      axios.post('api.php', {
        action: 'deleteFarm',
        farmland_id: farmlandId
      })
      .then(res => {
        const data = res.data;
        if (data && data.success) {
          Swal.fire('Deleted!', 'The farm has been deleted.', 'success');
          getFarmsByUserID();
        } else {
          Swal.fire('Error', data.error || 'Could not delete', 'error');
        }
      })
      .catch(err => {
        console.error('Axios deleteFarm error:', err);
        Swal.fire('Error', 'Request failed', 'error');
      });
    }
  });
}

document.addEventListener('DOMContentLoaded', function () {
  getFarmsByUserID();

  document.getElementById('farmsByUserHere').addEventListener('click', function(e) {
    if(e.target && e.target.classList.contains('showInfo')) {
      const farmData = JSON.parse(e.target.getAttribute('data-json'));
      document.getElementById('updateFarmlandId').value = farmData.farmland_id;
      document.getElementById('updateFarmlandAddressInput').value = farmData.farmland_address;
      document.getElementById('updateFarmlandLocInput').value = farmData.location;
      document.getElementById('updateFarmlandCropTypeInput').value = farmData.crop_type;
      $('#updateFarmModal').modal('show');
    }
  });
});

document.getElementById('insertNewFarmForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const payload = {
    userIDInput: userID,
    farmlandAddressInput: document.getElementById('farmlandAddressInput').value.trim(),
    farmlandLocInput: document.getElementById('farmlandLocInput').value.trim(),
    farmlandCropTypeInput: document.getElementById('farmlandCropTypeInput').value.trim(),
    action: 'insertFarm'
  };

  if (!payload.farmlandAddressInput || !payload.farmlandLocInput || !payload.farmlandCropTypeInput) {
    Swal.fire('Error', 'Please fill all required fields', 'error');
    return;
  }

  axios.post('api.php', payload)
  .then(res => {
    const result = res.data;
    if (result.success) {
      $('#exampleModal').modal('hide');
      document.getElementById('insertNewFarmForm').reset();
      getFarmsByUserID();
    } else {
      alert('Error saving farm: ' + (result.error || 'Unknown error'));
    }
  })
  .catch(err => {
    console.error('Axios insertNewFarm error:', err);
  });
});

document.getElementById('updateFarmForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const payload = {
    farmland_id: document.getElementById('updateFarmlandId').value,
    farmland_address: document.getElementById('updateFarmlandAddressInput').value.trim(),
    location: document.getElementById('updateFarmlandLocInput').value.trim(),
    crop_type: document.getElementById('updateFarmlandCropTypeInput').value.trim(),
    action: 'updateFarm'
  };

  if (!payload.farmland_address || !payload.location || !payload.crop_type) {
    alert('Please fill in all fields.');
    return;
  }

  axios.post('api.php', payload)
  .then(res => {
    const result = res.data;
    if (result.success) {
      $('#updateFarmModal').modal('hide');
      getFarmsByUserID();
    } else {
      alert('Error updating farm: ' + (result.error || 'Unknown error'));
    }
  })
  .catch(err => {
    console.error('Axios updateFarm error:', err);
    alert('Update request failed');
  });
});

</script>
<script src="vendor/logout.js"></script>
</body>
</html>
