<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>User Info Form with XHR</title>
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
function sendUserData(event) {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const age = document.getElementById('age').value;

    const data = JSON.stringify({ name, age });

    console.log(data);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '2a_api_for_xhr_example.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    console.log(xhr);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            const resultElem = document.getElementById('result');
            if (xhr.status >= 200 && xhr.status < 300) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    resultElem.textContent = 'Your name is ' 
                        + response.name + ', and you are ' + response.age + ' years old';
                } catch (e) {
                    resultElem.textContent = 'Error parsing response';
                }
            } else {
                try {
                    const errorResp = JSON.parse(xhr.responseText);
                    resultElem.textContent = 'Error: ' + (errorResp.error || 'Unknown error');
                } catch (e) {
                    resultElem.textContent = 'Request failed with status ' + xhr.status;
                }
            }
        }
    };

    xhr.onerror = function() {
        document.getElementById('result').textContent = 'XHR request error';
    };

    xhr.send(data);
}
</script>
</body>
</html>
