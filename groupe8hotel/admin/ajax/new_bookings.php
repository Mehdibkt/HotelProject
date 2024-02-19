<?php 

  require('../inc/db_config.php');
  require('../inc/essentials.php');
  adminLogin();

  if(isset($_POST['get_bookings']))
  {

    $query = "SELECT r.*, b.*, u.name FROM `rental` r
      INNER JOIN `booking` b ON b.booking_id = r.booking_id
      INNER JOIN `user_cred` u ON b.user_id = u.id
      WHERE (b.order_id LIKE ? OR b.phonenum LIKE ? OR u.name LIKE ?) 
      ORDER BY r.booking_id DESC";


    $res = select($query,["%$_POST[search]%","%$_POST[search]%","%$_POST[search]%"],'sss');
    
    $i=1;
    $table_data = "";

    if(mysqli_num_rows($res)==0){
      echo"<b>No Data Found!</b>";
      exit;
    }

    while($data = mysqli_fetch_assoc($res))
    {
      $date = date("d-m-Y",strtotime($data['datentime']));
      $checkin = date("d-m-Y",strtotime($data['check_in']));
      $checkout = date("d-m-Y",strtotime($data['check_out']));
      $status = "<button onclick='toggle_status($data[booking_id],1)' class='btn btn-dark btn-sm shadow-none'>
        Rented
      </button>";

      if(!$data['rental_status']){
        $status = "<button onclick='toggle_status(\"$data[booking_id]\",0)' class='btn btn-danger btn-sm shadow-none'>
        Booked
      </button>";
      }

      $table_data .="
        <tr>
          <td>$i</td>
          <td>
            <span class='badge bg-primary'>
              Order ID: $data[order_id]
            </span>
            <br>
            <b>Name:</b> $data[name]
            <br>
            <b>Phone No:</b> $data[phonenum]
          </td>
          <td>
            <b>Price:</b> $$data[price]
            <br>
            <b>Room ID:</b> $data[room_id]
          </td>
          <td>
            <b>Check-in:</b> $checkin
            <br>
            <b>Check-out:</b> $checkout
            <br>
            <b>Total:</b> $$data[total_pay]
            <br>
            <b>Date:</b> $date
          </td>
          <td>
          $status
          </td>
        </tr>
      ";

      $i++;
    }

    echo $table_data;
  }

  if(isset($_POST['toggle_status']))
  {
    $q = "UPDATE `rental` SET `rental_status`=? WHERE `booking_id`=?";
    $v = [$_POST['value'],$_POST['toggle_status']];

    if(update($q,$v,'is')){
      echo 1;
    }
    else{
      echo 0;
    }
  }

  

?>