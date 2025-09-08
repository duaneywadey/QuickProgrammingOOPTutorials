<?php require_once 'classloader.php'; ?>
<?php 
if (!$userObj->isLoggedIn()) {
  header("Location: login.php");
}

if ($userObj->isAdmin()) {
  header("Location: ../client/index.php");
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
      <div class="display-4 text-center">Hello there and welcome! </div>
      <div class="row justify-content-center">
        <div class="col-md-12">
          <?php $getProposalsByUserID = $proposalObj->getProposalsByUserID($_SESSION['user_id']); ?>
          <?php foreach ($getProposalsByUserID as $proposal) { ?>
          <div class="card shadow mt-4 mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <h2><a href="#"><?php echo $proposal['username']; ?></a></h2>
                  <img src="<?php echo '../images/'.$proposal['image']; ?>" class="img-fluid" alt="">
                  <p class="mt-4 mb-4"><?php echo $proposal['description']; ?></p>
                  <h4><i><?php echo number_format($proposal['min_price']) . " - " . number_format($proposal['max_price']);?> PHP</i></h4>
                  <div class="float-right">
                    <a href="#">Check out services</a>
                  </div>
                </div>
                <div class="col-md-6">
                  <h2><a href="#">All Offers</a></h2>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Illo tempora atque voluptates delectus quos, expedita velit, magnam vitae ut error eligendi sint provident iure esse dolor dolorem alias cumque earum?</p>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </body>
</html>