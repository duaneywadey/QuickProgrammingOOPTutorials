<?php require_once 'classloader.php'; ?>

<?php 
if (!$userObj->isLoggedIn()) {
  header("Location: ../index.php");
} 
?>
<!doctype html>
  <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
      body {
        font-family: "Arial";
      }
    </style>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container-fluid">
      <div class="display-4 text-center">Hello there and welcome! <span class="text-success"></span>. Here are all the articles</div>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card mt-4 shadow">
            <div class="card-body"> 
              <h1>Lorem</h1>
              <small>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae, quod architecto recusandae cum velit reiciendis aut impedit qui, ipsam minima explicabo, excepturi quaerat, ea eveniet? Soluta repudiandae, culpa numquam totam?  </small>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque ipsum at, quibusdam facilis id facere eius nobis culpa tempore tempora impedit nostrum labore eos quasi asperiores deleniti repudiandae possimus est.  </p>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </body>
</html>