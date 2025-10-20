<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Agrilands CRUD</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>Agrilands Management</h2>
    <div id="farmTableBody"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const farmTableBody = document.getElementById('farmTableBody');

    function loadFarms() {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '2c_api_for_farm_records_api.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        const res = JSON.parse(xhr.responseText);
                        if (res.success) {
                            farmTableBody.innerHTML = JSON.stringify(res.data);
                            console.log(res);
                        } else {
                            farmTableBody.innerHTML = '<h1>No records found</h1>';
                        }
                    } catch (e) {
                        farmTableBody.innerHTML = '<h1>Error parsing response</h1>';
                        console.error('Parsing error:', e);
                    }
                } else {
                    farmTableBody.innerHTML = '<h1>No records found</h1>';
                    console.error('Request failed with status', xhr.status);
                }
            }
        };

        xhr.onerror = function () {
            farmTableBody.innerHTML = '<h1>No records found</h1>';
            console.error('XHR request error');
        };

        xhr.send(JSON.stringify({ action: 'read' }));
    }

    loadFarms();
});
</script>

</body>
</html>
