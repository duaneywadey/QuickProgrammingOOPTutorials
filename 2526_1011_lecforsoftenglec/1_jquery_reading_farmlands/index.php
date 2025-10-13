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
    <div id="farmTableBody"></div>

</div>

<script>
$(function() {
    // Initially load farms
    loadFarms();

    // Search event
    $('#searchInput').on('input', function() {
        loadFarms($(this).val());
    });

    // Function to load farms with optional search query
    function loadFarms(search = '') {
        $.ajax({
            url: 'api.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ action: 'read', search: search }),
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    $('#farmTableBody').html(JSON.stringify(res.data));
                    console.log(res);
                    // console.log(res.success);
                    // console.log(res.data);
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
