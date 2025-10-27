<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="sweetalert.js"></script>
</head>
<body>
<h2>Login</h2>
<form id="loginForm">
    <label>Username:</label><br>
    <input type="text" id="username"><br>
    <label>Password:</label><br>
    <input type="password" id="password"><br><br>
    <button type="submit">Login</button>
</form>
<p>Don't have an account? <a href="4b_regpage_loginregsystem_sweetalert.php">Register here</a></p>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    if (!username || !password) {
        Swal.fire('Error', 'Please fill all fields', 'error');
        return;
    }

    fetch('4c_handleforms.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ action: 'login', username, password })
    }).then(res => res.json())
      .then(data => {
        if (data.success) {
            window.location.href = '4_indexpage_loginregsystem_sweetalert.php';
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    });
});
</script>
</body>
</html>
