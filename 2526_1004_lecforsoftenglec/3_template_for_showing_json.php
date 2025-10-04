<!-- json.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Fetch JSON Example</title>
</head>
<body>
    <h1>Fetched JSON Data:</h1>
    <pre id="jsonData">Loading...</pre>

    <script>
        async function fetchData() {
            try {
                const response = await fetch('3a_posts_api.php');
                if (!response.ok) { 
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                document.getElementById('jsonData').textContent = JSON.stringify(data);
                // console.log(data);
                // console.log(JSON.stringify(data));
            } catch (error) {
                document.getElementById('jsonData').textContent = 'Error fetching data: ' + error;
            }
        }

        fetchData();
    </script>
</body>
</html>
