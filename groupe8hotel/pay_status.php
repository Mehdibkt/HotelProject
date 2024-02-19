<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - BOOKING STATUS</title>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <div class="container">
    <div class="row">

      <div class="col-12 my-5 mb-3 px-4">
        <h2 class="fw-bold">PAYMENT STATUS</h2>
      </div>

      <?php 

        if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
          redirect('index.php');
        }

        $booking_q = "SELECT b.*, r.rental_status FROM `booking` b
          INNER JOIN `rental` r ON r.booking_id=b.booking_id
          WHERE b.order_id=? AND b.user_id=? ";

        $booking_res = select($booking_q,[$_GET['order'],$_SESSION['uId']],'si');

        if(mysqli_num_rows($booking_res)==0){
          redirect('index.php');
        }

        $booking_fetch = mysqli_fetch_assoc($booking_res);

        if($booking_fetch['rental_status'] == 1)
        {
          echo<<<data
            <div class="col-12 px-4">
              <p class="fw-bold alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                Payment done! Booking successful.
                <br><br>
                <a href='index.php'>Go back to Home</a>
              </p>
            </div>
          data;
        }
        else
        {
          echo<<<data
            <div class="col-12 px-4">
              <p class="fw-bold alert alert-info">
                <i class="bi bi-exclamation-triangle-fill"></i>
                Booking successful. Payment is pending..
                <br><br>
                <a href='index.php'>Go to back to Home</a>
              </p>
            </div>
          data;
        }

      ?>

    </div>
  </div>


  <?php require('inc/footer.php'); ?>

</body>
</html>
