<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
                <h1>Register now!</h1>
            </div>   
                <div class="card-body">
                    <form id="regForm">
                        <div class="form-group">
                            <label>Username:</label><br>
                            <input type="text" id="username" class="form-control"><br>
                        </div>
                        <div class="form-group">
                            <label>Email:</label><br>
                            <input type="email" id="email" class="form-control"><br>
                        </div>
                        <div class="form-group">    
                            <label>Password:</label><br>
                            <input type="password" id="password" class="form-control"><br>
                        </div>
                        <div class="form-group">
                            <label>Contact Number:</label><br>
                            <input type="text" id="contact_number" class="form-control"><br><br>
                            <button type="submit" class="btn btn-primary float-right">Register</button>
                        </div>
                        <p>Already have an account? <a href="login.php">Login here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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

        axios.post('api.php', 
          { action: 'register', username, email, password, contact_number },
          { headers: { 'Content-Type': 'application/json' } }
        )
        .then(function(response) {
            const data = response.data;
            if (data.success) {
                Swal.fire('Success', data.message, 'success').then(() => {
                    window.location.href = 'login.php';
                });
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(function(error) {
            Swal.fire('Error', 'An error occurred during registration.', 'error');
            console.error(error);
        });
    });
</script>
</body>
</html>
