<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Divide Two Numbers using Fetch API</title>
</head>
<body>

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

<p id="result"></p>
<script>
async function divideNumbers(event) {
    event.preventDefault();
    const numerator = document.getElementById('numerator').value;
    const denominator = document.getElementById('denominator').value;
    // Prepare data to send
    const data = { numerator, denominator };

    // console.log(data);
    // console.log(JSON.stringify(data));
    try {
        const response = await fetch('2a_divisor_dividend.php', {
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
            document.getElementById('result').textContent = 'Result: ' + result.quotient;
        } else {
            document.getElementById('result').textContent = 'Error: ' + result.error;
        }
    } catch (error) {
        document.getElementById('result').textContent = 'Fetch error: ' + error.message;
    }
}
</script>
</body>
</html>
