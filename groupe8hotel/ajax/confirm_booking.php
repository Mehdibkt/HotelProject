<?php 

  require('../admin/inc/db_config.php');
  require('../admin/inc/essentials.php');

  date_default_timezone_set("Canada/Eastern");

  if(isset($_POST['check_availability']))
  {
    $status = "";
    $result = "";

    // check in and out validations

    
    $today_date = new DateTime(date("Y-m-d"));
    $checkin_date = new DateTime($_POST['check_in']);
    $checkout_date = new DateTime($_POST['check_out']);

    if($checkin_date == $checkout_date){
      $status = 'check_in_out_equal';
      $result = json_encode(["status"=>$status]);
    }
    else if($checkout_date < $checkin_date){
      $status = 'check_out_earlier';
      $result = json_encode(["status"=>$status]);
    }
    else if($checkin_date < $today_date){
      $status = 'check_in_earlier';
      $result = json_encode(["status"=>$status]);
    }

    // check booking availability if status is blank else return the error

    if($status!=''){
      echo $result;
    }
    else{
      session_start();

      
      // Compter le nombre total de réservations pour cette salle avec les dates données
        $tb_query = "SELECT COUNT(*) AS `total_rentings` FROM `rental`
        WHERE rental_status=? AND room_id=?
        AND check_out > ? AND check_in < ?";

        $tb_values = [1, $_SESSION['room']['id'], $_POST['check_in'], $_POST['check_out']];
        $tb_fetch = mysqli_fetch_assoc(select($tb_query, $tb_values, 'siss'));

        // Récupérer la quantité de chambres disponibles
        $rq_result = select("SELECT `quantity` FROM `rooms` WHERE `room_id`=?", [$_SESSION['room']['id']], 'i');
        $rq_fetch = mysqli_fetch_assoc($rq_result);

        // Vérifier si la chambre est disponible
        if (($rq_fetch['quantity'] - $tb_fetch['total_rentings']) == 0) {
          $status = 'unavailable';
          $result = json_encode(['status' => $status]);
          echo $result;
          exit;
        }

     

      $count_days = date_diff($checkin_date,$checkout_date)->days;
      $payment = $_SESSION['room']['price'] * $count_days;

      $_SESSION['room']['payment'] = $payment;
      $_SESSION['room']['available'] = true;
      
      $result = json_encode(["status"=>'available', "days"=>$count_days, "payment"=> $payment]);
      echo $result;
    }

  }

?>