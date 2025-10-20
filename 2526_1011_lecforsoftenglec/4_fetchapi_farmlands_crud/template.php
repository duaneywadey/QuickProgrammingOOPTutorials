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
        <!-- Data filled by Fetch API -->
        </tbody>
    </table>
</div>

<!-- Add Farm Modal -->
<div class="modal fade" id="addFarmModal" tabindex="-1" aria-labelledby="addFarmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="addFarmForm">
        <div class="modal-header">
          <h5 class="modal-title" id="addFarmModalLabel">Add Farm</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="add_farm_name" class="form-label">Farm Name</label>
                <input type="text" class="form-control" id="add_farm_name" name="farm_name" required />
            </div>
            <div class="mb-3">
                <label for="add_location" class="form-label">Location</label>
                <input type="text" class="form-control" id="add_location" name="location" required />
            </div>
            <div class="mb-3">
                <label for="add_crop_type" class="form-label">Crop Type</label>
                <input type="text" class="form-control" id="add_crop_type" name="crop_type" required />
            </div>
            <div class="mb-3">
                <label for="add_owner" class="form-label">Owner</label>
                <input type="text" class="form-control" id="add_owner" name="owner" required />
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Farm</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Farm Modal -->
<div class="modal fade" id="editFarmModal" tabindex="-1" aria-labelledby="editFarmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editFarmForm">
        <input type="hidden" id="edit_farmland_id" name="farmland_id" />
        <div class="modal-header">
          <h5 class="modal-title" id="editFarmModalLabel">Edit Farm</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="edit_farm_name" class="form-label">Farm Name</label>
                <input type="text" class="form-control" id="edit_farm_name" name="farm_name" required />
            </div>
            <div class="mb-3">
                <label for="edit_location" class="form-label">Location</label>
                <input type="text" class="form-control" id="edit_location" name="location" required />
            </div>
            <div class="mb-3">
                <label for="edit_crop_type" class="form-label">Crop Type</label>
                <input type="text" class="form-control" id="edit_crop_type" name="crop_type" required />
            </div>
            <div class="mb-3">
                <label for="edit_owner" class="form-label">Owner</label>
                <input type="text" class="form-control" id="edit_owner" name="owner" required />
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger me-auto" id="btnDeleteFarm">Delete</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const farmTableBody = document.getElementById('farmTableBody');

    const addFarmModalEl = document.getElementById('addFarmModal');
    const addFarmModal = new bootstrap.Modal(addFarmModalEl);
    const addFarmForm = document.getElementById('addFarmForm');

    const editFarmModalEl = document.getElementById('editFarmModal');
    const editFarmModal = new bootstrap.Modal(editFarmModalEl);
    const editFarmForm = document.getElementById('editFarmForm');

    const btnAddFarm = document.getElementById('btnAddFarm');
    const btnDeleteFarm = document.getElementById('btnDeleteFarm');

    // Load farms initially
    loadFarms();

    // Search event
    searchInput.addEventListener('input', () => {
        loadFarms(searchInput.value);
    });

    // Show Add Farm modal
    btnAddFarm.addEventListener('click', () => {
        addFarmForm.reset();
        addFarmModal.show();
    });

    // Handle Add Farm form submission
    addFarmForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const farmData = {
            farm_name: document.getElementById('add_farm_name').value,
            location: document.getElementById('add_location').value,
            crop_type: document.getElementById('add_crop_type').value,
            owner: document.getElementById('add_owner').value
        };
        try {
            const response = await fetch('api.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ action: 'create', farm: farmData })
            });
            const res = await response.json();

            if (res.success) {
                addFarmModal.hide();
                loadFarms(searchInput.value);
            } else {
                alert(res.message || 'An error occurred');
            }
        } catch (error) {
            console.error(error);
            alert('Failed to add farm');
        }
    });

    // Handle table edit click (event delegation)
    farmTableBody.addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-edit')) {
            const farm = JSON.parse(e.target.dataset.farm);
            document.getElementById('edit_farmland_id').value = farm.farmland_id;
            document.getElementById('edit_farm_name').value = farm.farm_name;
            document.getElementById('edit_location').value = farm.location;
            document.getElementById('edit_crop_type').value = farm.crop_type;
            document.getElementById('edit_owner').value = farm.owner;
            btnDeleteFarm.style.display = 'inline-block';
            editFarmModal.show();
        }
    });

    // Handle Edit Farm form submission (update)
    editFarmForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const farmData = {
            farmland_id: document.getElementById('edit_farmland_id').value,
            farm_name: document.getElementById('edit_farm_name').value,
            location: document.getElementById('edit_location').value,
            crop_type: document.getElementById('edit_crop_type').value,
            owner: document.getElementById('edit_owner').value
        };
        try {
            const response = await fetch('api.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ action: 'update', farm: farmData })
            });
            const res = await response.json();

            if (res.success) {
                editFarmModal.hide();
                loadFarms(searchInput.value);
            } else {
                alert(res.message || 'An error occurred');
            }
        } catch (error) {
            console.error(error);
            alert('Failed to update farm');
        }
    });

    // Handle delete farm button in edit modal
    btnDeleteFarm.addEventListener('click', async () => {
        if (confirm('Are you sure you want to delete this farm?')) {
            const farmland_id = document.getElementById('edit_farmland_id').value;
            try {
                const response = await fetch('api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'delete', farmland_id: farmland_id })
                });
                const res = await response.json();

                if (res.success) {
                    editFarmModal.hide();
                    loadFarms(searchInput.value);
                } else {
                    alert(res.message || 'Failed to delete');
                }
            } catch (error) {
                console.error(error);
                alert('Failed to delete farm');
            }
        }
    });

    // Function to load farms with optional search query
    async function loadFarms(search = '') {
        try {
            const response = await fetch('api.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'read', search: search })
            });
            console.log(response)
            const res = await response.json();

            if (res.success) {
                let rows = '';
                res.data.forEach(farm => {
                    rows += `<tr>
                                <td>${farm.farm_name}</td>
                                <td>${farm.location}</td>
                                <td>${farm.crop_type}</td>
                                <td>${farm.owner}</td>
                                <td>${farm.date_added}</td>
                                <td><button class="btn btn-sm btn-primary btn-edit" data-farm='${JSON.stringify(farm).replace(/'/g, "&#39;").replace(/"/g, "&quot;")}'>Edit</button></td>
                            </tr>`;
                });
                farmTableBody.innerHTML = rows;
            } else {
                farmTableBody.innerHTML = '<tr><td colspan="6">No records found</td></tr>';
            }
        } catch (error) {
            console.error(error);
            farmTableBody.innerHTML = '<tr><td colspan="6">Error loading data</td></tr>';
        }
    }
});
</script>
</body>
</html>
