<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Combined Forms with Fetch API and PHP Backend</title>
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
<p id="resultUser"></p>

<hr>

<h2>Divide Two Numbers</h2>
<form id="divideForm" onsubmit="divideNumbers(event)">
    <label for="numerator">Numerator:</label>
    <input type="number" id="numerator" name="numerator" step="any" required />
    <br /><br />
    <label for="denominator">Denominator:</label>
    <input type="number" id="denominator" name="denominator" step="any" required />
    <br /><br />
    <button type="submit">Divide</button>
</form>
<p id="resultDivide"></p>

<script>
async function sendUserData(event) {
    event.preventDefault();

    const name = document.getElementById('name').value.trim();
    const age = document.getElementById('age').value.trim();

    const data = { name, age };

    try {
        const response = await fetch('2ba_api_for_two_forms.php?action=getNameAndAge', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
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
            document.getElementById('resultUser').textContent = 
                `Your name is ${result.name}, and you are ${result.age} years old.`;
        } else {
            document.getElementById('resultUser').textContent = 'Error: ' + result.error;
        }
    } catch (error) {
        document.getElementById('resultUser').textContent = 'Fetch error: ' + error.message;
    }
}

async function divideNumbers(event) {
    event.preventDefault();

    const numerator = document.getElementById('numerator').value.trim();
    const denominator = document.getElementById('denominator').value.trim();

    const data = { numerator, denominator };

    try {
        const response = await fetch('2ba_api_for_two_forms.php?action=getQuotient', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
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
            document.getElementById('resultDivide').textContent = 
                `Result: ${result.quotient}`;
        } else {
            document.getElementById('resultDivide').textContent = 'Error: ' + result.error;
        }
    } catch (error) {
        document.getElementById('resultDivide').textContent = 'Fetch error: ' + error.message;
    }
}
</script>

</body>
</html>
