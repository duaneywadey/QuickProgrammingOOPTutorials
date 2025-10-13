<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Agrilands CRUD</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h2>Agrilands Management</h2>
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search farms..." />
    </div>
    <div id="farmTableBody"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const farmTableBody = document.getElementById('farmTableBody');

    // Initially load farms
    loadFarms();

    // Search event
    searchInput.addEventListener('input', () => {
        loadFarms(searchInput.value);
    });

    // Function to load farms with optional search query
    function loadFarms(search = '') {
        fetch('api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ action: 'read', search: search })
        })
        .then(response => response.json())
        .then(res => {
            if (res.success) {
                farmTableBody.innerHTML = JSON.stringify(res.data);
                console.log(res);
            } else {
                farmTableBody.innerHTML = '<h1>No records found</h1>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            farmTableBody.innerHTML = '<h1>No records found</h1>';
        });
    }
});
</script>

</body>
</html>
