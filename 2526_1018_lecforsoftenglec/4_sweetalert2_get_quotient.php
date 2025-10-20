<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Quotient Calculator</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <form id="divideForm">
        <label for="dividend">Dividend:</label>
        <input type="number" id="dividend" name="dividend" required />
        <br>
        <label for="divisor">Divisor:</label>
        <input type="number" id="divisor" name="divisor" required />
        <br>
        <button type="submit">Calculate Quotient</button>
    </form>

    <script>
        document.getElementById('divideForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(e.target);
            var data = {
                action: 'getQuotient',
                dividend: Number(formData.get('dividend')),
                divisor: Number(formData.get('divisor'))
            };

            fetch('4a_quotient.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(function(result) {
                if (result.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Division Successful',
                        html: 'The quotient is <strong>' + result.quotient + '</strong>'
                    });
                } else {
                    // Single error popup for any error state
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.message || 'An error occurred'
                    });
                }
            })
            .catch(function(error) {
                Swal.fire({
                    icon: 'error',
                    title: 'An error occurred!',
                    text: error.message
                });
            });
        });
    </script>
</body>
</html>
