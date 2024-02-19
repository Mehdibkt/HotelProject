<?php 

  require('admin/inc/db_config.php');
  require('admin/inc/essentials.php');


  date_default_timezone_set("Canada/Eastern");

  session_start();

  if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
    redirect('index.php');
  }

  if(isset($_POST['pay_now']))
  {
    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");
    $rental_statut = 1;


    $ORDER_ID = 'ORD_'.$_SESSION['uId'].random_int(11111,9999999);    
    $CUST_ID = $_SESSION['uId'];
    $TXN_AMOUNT = $_SESSION['room']['payment'];


    // Insert payment data into database
    
    $query1 = "INSERT INTO `booking`( `price`, `total_pay`, `room_id`,`user_id`, `phonenum`, `address`,`order_id`) VALUES (?,?,?,?,?,?,?)";
    
    insert($query1,[$_SESSION['room']['price'],$TXN_AMOUNT,$_SESSION['room']['id'],$CUST_ID,$_POST['phonenum'],$_POST['address'],$ORDER_ID],'iiiisss');

    $booking_id_q = select("SELECT * FROM `booking` WHERE `order_id`=?",[$ORDER_ID],'s');
    $booking_res = mysqli_fetch_assoc($booking_id_q);


    $query2 = "INSERT INTO `rental`(`user_id`, `room_id`, `booking_id`, `check_in`, `check_out`, `rental_status`) VALUES (?,?,?,?,?,?)";

    insert($query2,[$CUST_ID,$_SESSION['room']['id'],$booking_res['booking_id'],$_POST['checkin'], $_POST['checkout'],$rental_statut],'iiissi');

  }else if(isset($_POST['pay_later']))
  {
    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");
    $rental_statut = 0;


    $ORDER_ID = 'ORD_'.$_SESSION['uId'].random_int(11111,9999999);    
    $CUST_ID = $_SESSION['uId'];
    $TXN_AMOUNT = $_SESSION['room']['payment'];


    // Insert payment data into database
    
    $query1 = "INSERT INTO `booking`( `price`, `total_pay`, `room_id`,`user_id`, `phonenum`, `address`,`order_id`) VALUES (?,?,?,?,?,?,?)";
    
    insert($query1,[$_SESSION['room']['price'],$TXN_AMOUNT,$_SESSION['room']['id'],$CUST_ID,$_POST['phonenum'],$_POST['address'],$ORDER_ID],'iiiisss');

    $booking_id_q = select("SELECT * FROM `booking` WHERE `order_id`=?",[$ORDER_ID],'s');
    $booking_res = mysqli_fetch_assoc($booking_id_q);


    $query2 = "INSERT INTO `rental`(`user_id`, `room_id`, `booking_id`, `check_in`, `check_out`, `rental_status`) VALUES (?,?,?,?,?,?)";

    insert($query2,[$CUST_ID,$_SESSION['room']['id'],$booking_res['booking_id'],$_POST['checkin'], $_POST['checkout'],$rental_statut],'iiissi');

  }

?>

<html>
  <head>
    <title>Processing</title>
    <meta http-equiv="refresh" content="5;url=pay_status.php?order=<?php echo $ORDER_ID ?>">   
  </head>
  <body>

		<h1>Please do not refresh this page...</h1>
  </body>
</html>