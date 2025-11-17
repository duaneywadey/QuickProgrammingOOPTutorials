<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="vendor/bootstrap.css">
    <script src="vendor/sweetalert.js"></script>
    <script src="vendor/jquery.js"></script>
    <script src="vendor/axios.js"></script>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h1>Login Now!</h1>
                </div>
                <div class="card-body">
                    <form id="loginForm">
                        <div class="form-group">
                            <label>Username:</label><br>
                            <input type="text" id="username" class="form-control"><br>
                        </div>
                        <div class="form-group">
                            <label>Password:</label><br>
                            <input type="password" id="password" class="form-control"><br><br>
                            <button type="submit" class="btn btn-primary float-right">Login</button>
                        </div>
                    </form>
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();

        if (!username || !password) {
            Swal.fire('Error', 'Please fill all fields', 'error');
            return;
        }

        axios.post('api.php', {
            action: 'login',
            username: username,
            password: password
        }, {
            headers: { 'Content-Type': 'application/json' }
        }).then(response => {
            if (response.data.success) {
                window.location.href = 'index.php';
            } else {
                Swal.fire('Error', response.data.message, 'error');
            }
        }).catch(error => {
            Swal.fire('Error', 'An error occurred. Please try again.', 'error');
        });
    });
</script>
</body>
</html>
