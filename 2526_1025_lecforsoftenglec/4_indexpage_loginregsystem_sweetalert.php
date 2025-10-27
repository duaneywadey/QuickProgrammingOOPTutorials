<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: 4a_loginpage_loginregsystem_sweetalert.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <form method="post" action="4c_handleforms.php" id="logoutForm">
        <button type="submit" name="logout">Logout</button>
    </form>
    <script>    
        document.getElementById('logoutForm').addEventListener('submit', function (e) {
          e.preventDefault();

          fetch('4c_handleforms.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'logout' })
          })
          .then(function (res) {
            return res.json();
          })
          .then(function (data) {
            console.log(data); // { success: true, message: "Logout successful" } or error

            if (data.success) {
              // Optionally redirect or update UI
              window.location.href = '4_indexpage_loginregsystem_sweetalert.php';
            } else {
              // Show error message to user
              alert(data.message);
            }
          })
          .catch(function (err) {
            console.error('Logout request failed', err);
            alert('Logout failed. Please try again.');
          });
        });
    </script>
</body>
</html>
