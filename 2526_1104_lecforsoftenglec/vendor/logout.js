document.getElementById('logoutForm').addEventListener('submit', function (e) {
	e.preventDefault();
  fetch('api.php', {
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
        window.location.href = 'login.php';
      } 
      else {
      // Show error message to user
      alert(data.message);
    }
  })
  .catch(function (err) {
    console.error('Logout request failed', err);
    alert('Logout failed. Please try again.');
  });
});