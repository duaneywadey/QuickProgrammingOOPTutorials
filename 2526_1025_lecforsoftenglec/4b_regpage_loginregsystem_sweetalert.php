<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<h2>Register</h2>
<form id="regForm">
    <label>Username:</label><br>
    <input type="text" id="username"><br>
    <label>Email:</label><br>
    <input type="email" id="email"><br>
    <label>Password:</label><br>
    <input type="password" id="password"><br>
    <label>Contact Number:</label><br>
    <input type="text" id="contact_number"><br><br>
    <button type="submit">Register</button>
</form>
<p>Already have an account? <a href="4a_loginpage_loginregsystem_sweetalert.php">Login here</a></p>

<script>
document.getElementById('regForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const contact_number = document.getElementById('contact_number').value.trim();

    if (!username || !email || !password) {
        Swal.fire('Error', 'Please fill all required fields', 'error');
        return;
    }

    fetch('4c_handleforms.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ action: 'register', username, email, password, contact_number })
    }).then(res => res.json())
      .then(data => {
        if (data.success) {
            Swal.fire('Success', data.message, 'success').then(() => {
                window.location.href = '4a_loginpage_loginregsystem_sweetalert.php';
            });
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    });
});
</script>
</body>
</html>
