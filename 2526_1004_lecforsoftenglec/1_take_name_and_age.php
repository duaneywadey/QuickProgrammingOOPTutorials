<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>User Info Form with Fetch API</title>
</head>
<body>
<h2>User Information Form</h2>
<form id="userForm" onsubmit="sendUserData(event)">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required />
    <br /><br />
    <label for="age">Age:</label>
    <input type="number" id="age" name="age" min="0" required />
    <br /><br />
    <button type="submit">Submit</button>
</form>

<p id="result"></p>
<script>
async function sendUserData(event) {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const age = document.getElementById('age').value;

    // Prepare data to send
    const data = { name, age };

    // console.log(data);
    // console.log(JSON.stringify(data));

    try {
        const response = await fetch('1a_name_and_age_api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        const result = await response.json();
        // console.log(response);
        // console.log(response.status);
        // console.log(response.type);
        // console.log(response.url);
        
        // console.log(result);
        // console.log(JSON.stringify(result));

        if (response.ok) {
            document.getElementById('result').textContent = 'Your name is ' 
                + result.name + ', and you are ' + result.age + ' years old';
        } else {
            document.getElementById('result').textContent = JSON.stringify(result);
            document.getElementById('result').textContent = 'Error: ' + result.error;
        }
    } catch (error) {
        document.getElementById('result').textContent = 'Fetch error: ' + error.message;
    }
}
</script>
</body>
</html>
