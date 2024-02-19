<?php 

  require('../inc/db_config.php');
  require('../inc/essentials.php');
  adminLogin();

  if(isset($_POST['add_room']))
  {
    $features = json_decode($_POST['features']);
    $facilities = json_decode($_POST['facilities']);

    $flag = 0;

    $q1 = "INSERT INTO `rooms` (`name`, `n_bed`, `price`, `quantity`, `hotel_id`) VALUES (?,?,?,?,?)";
    $values = [$_POST['name'],$_POST['n_bed'],$_POST['price'],$_POST['quantity'],$_POST['hotel_id']];

    if(insert($q1,$values,'siiii')){
      $flag = 1;
    }
    
    $room_id = mysqli_insert_id($con);

    $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";
    if($stmt = mysqli_prepare($con,$q2))
    {
      foreach($facilities as $f){
        mysqli_stmt_bind_param($stmt,'ii',$room_id,$f);
        mysqli_stmt_execute($stmt);
      }
      mysqli_stmt_close($stmt);
    }
    else{
      $flag = 0;
      die('query cannot be prepared - insert');
    }

    
    $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";
    if($stmt = mysqli_prepare($con,$q3))
    {
      foreach($features as $f){
        mysqli_stmt_bind_param($stmt,'ii',$room_id,$f);
        mysqli_stmt_execute($stmt);
      }
      mysqli_stmt_close($stmt);
    }
    else{
      $flag = 0;
      die('query cannot be prepared - insert');
    }
    
    if($flag){
      updateTotalRoomsForHotel($_POST['hotel_id']);
      echo 1;
    }
    else{
      echo 0;
    }


  }


  if(isset($_POST['get_all_rooms']))
  {
    $res = selectAll('rooms');
    $i=1;

    $data = "";

    while($row = mysqli_fetch_assoc($res))
    {
      if($row['status']==1){
        $status = "<button onclick='toggle_status($row[room_id],0)' class='btn btn-dark btn-sm shadow-none'>active</button>";
      }
      else{
        $status = "<button onclick='toggle_status($row[room_id],1)' class='btn btn-warning btn-sm shadow-none'>inactive</button>";
      }


      $data.="
        <tr class='align-middle'>
          <td>$i</td>
          <td>$row[name]</td>
          <td>$row[n_bed]</td>
          <td>$$row[price]</td>
          <td>$row[quantity]</td>
          <td>$status</td>
          <td>
            <button type='button' onclick='edit_details($row[room_id])' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-room'>
              <i class='bi bi-pencil-square'></i> 
            </button>
            <button type='button' onclick=\"room_images($row[room_id],'$row[name]')\" class='btn btn-info shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#room-images'>
              <i class='bi bi-images'></i> 
            </button>
            <button type='button' onclick='remove_room($row[room_id],$row[hotel_id])' class='btn btn-danger shadow-none btn-sm'>
              <i class='bi bi-trash'></i> 
            </button>
          </td>
        </tr>
      ";
      $i++;
    }

    echo $data;
  }

  if(isset($_POST['get_room']))
  {

    $res1 = select("SELECT * FROM `rooms` WHERE `room_id`=?",[$_POST['get_room']],'i');
    $res2 = select("SELECT * FROM `room_features` WHERE `room_id`=?",[$_POST['get_room']],'i');
    $res3 = select("SELECT * FROM `room_facilities` WHERE `room_id`=?",[$_POST['get_room']],'i');

    $roomdata = mysqli_fetch_assoc($res1);
    $features = [];
    $facilities = [];

    if(mysqli_num_rows($res2)>0)
    {
      while($row = mysqli_fetch_assoc($res2)){
        array_push($features,$row['features_id']);
      }
    }

    if(mysqli_num_rows($res3)>0)
    {
      while($row = mysqli_fetch_assoc($res3)){
        array_push($facilities,$row['facilities_id']);
      }
    }

    $data = ["roomdata" => $roomdata, "features" => $features, "facilities" => $facilities];
    
    $data = json_encode($data);

    echo $data;

  }

  if(isset($_POST['edit_room']))
  {
    $features = json_decode($_POST['features']);
    $facilities = json_decode($_POST['facilities']);
    $original_hotel_id = $_POST['original_hotel_id'];
    $new_hotel_id = $_POST['hotel_id'];


    $flag = 0;

    $q1 = "UPDATE `rooms` SET `name`=?,`n_bed`=?,`price`=?,`quantity`=?,`hotel_id`=? WHERE `room_id`=?";
    $values = [$_POST['name'],$_POST['n_bed'],$_POST['price'],$_POST['quantity'],$_POST['hotel_id'],$_POST['room_id']];
    
    if(update($q1,$values,'siiiii')){
      $flag = 1;
    }


    $del_features = delete("DELETE FROM `room_features` WHERE `room_id`=?", [$_POST['room_id']],'i');
    $del_facilities = delete("DELETE FROM `room_facilities` WHERE `room_id`=?", [$_POST['room_id']],'i');

    if(!($del_facilities && $del_features)){
      $flag = 0;
    }

    $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";
    if($stmt = mysqli_prepare($con,$q2))
    {
      foreach($facilities as $f){
        mysqli_stmt_bind_param($stmt,'ii',$_POST['room_id'],$f);
        mysqli_stmt_execute($stmt);
      }
      $flag = 1;
      mysqli_stmt_close($stmt);
    }
    else{
      $flag = 0;
      die('query cannot be prepared - insert');
    }

    
    $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";
    if($stmt = mysqli_prepare($con,$q3))
    {
      foreach($features as $f){
        mysqli_stmt_bind_param($stmt,'ii',$_POST['room_id'],$f);
        mysqli_stmt_execute($stmt);
      }
      $flag = 1;
      mysqli_stmt_close($stmt);
    }
    else{
      $flag = 0;
      die('query cannot be prepared - insert');
    }
    
    if($flag){
      updateTotalRooms($_POST['original_hotel_id'], $_POST['hotel_id']);
      echo 1;
    } else {
      echo 0;
    }

  }

  if(isset($_POST['toggle_status']))
  {


    $q = "UPDATE `rooms` SET `status`=? WHERE `room_id`=?";
    $v = [$_POST['value'],$_POST['toggle_status']];

    if(update($q,$v,'ii')){
      echo 1;
    }
    else{
      echo 0;
    }
  }

  if(isset($_POST['add_image']))
  {

    $img_r = uploadImage($_FILES['image'],ROOMS_FOLDER);

    if($img_r == 'inv_img'){
      echo $img_r;
    }
    else if($img_r == 'inv_size'){
      echo $img_r;
    }
    else if($img_r == 'upd_failed'){
      echo $img_r;
    }
    else{
      $q = "INSERT INTO `room_images`(`room_id`, `image`) VALUES (?,?)";
      $values = [$_POST['room_id'],$img_r];
      $res = insert($q,$values,'is');
      echo $res;
    }
  }

  if(isset($_POST['get_room_images']))
  {
    $res = select("SELECT * FROM `room_images` WHERE `room_id`=?",[$_POST['get_room_images']],'i');

    $path = ROOMS_IMG_PATH;

    while($row = mysqli_fetch_assoc($res))
    {
      if($row['thumb']==1){
        $thumb_btn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
      }
      else{
        $thumb_btn = "<button onclick='thumb_image($row[sr_no],$row[room_id])' class='btn btn-secondary shadow-none'>
          <i class='bi bi-check-lg'></i>
        </button>";
      }

      echo<<<data
        <tr class='align-middle'>
          <td><img src='$path$row[image]' class='img-fluid'></td>
          <td>$thumb_btn</td>
          <td>
            <button onclick='rem_image($row[sr_no],$row[room_id])' class='btn btn-danger shadow-none'>
              <i class='bi bi-trash'></i>
            </button>
          </td>
        </tr>
      data;
    }

  }

  if(isset($_POST['rem_image']))
  {

    $values = [$_POST['image_id'],$_POST['room_id']];

    $pre_q = "SELECT * FROM `room_images` WHERE `sr_no`=? AND `room_id`=?";
    $res = select($pre_q,$values,'ii');
    $img = mysqli_fetch_assoc($res);

    if(deleteImage($img['image'],ROOMS_FOLDER)){
      $q = "DELETE FROM `room_images` WHERE `sr_no`=? AND `room_id`=?";
      $res = delete($q,$values,'ii');
      echo $res;
    }
    else{
      echo 0;
    }

  }

  if(isset($_POST['thumb_image']))
  {

    $pre_q = "UPDATE `room_images` SET `thumb`=? WHERE `room_id`=?";
    $pre_v = [0,$_POST['room_id']];
    $pre_res = update($pre_q,$pre_v,'ii');

    $q = "UPDATE `room_images` SET `thumb`=? WHERE `sr_no`=? AND `room_id`=?";
    $v = [1,$_POST['image_id'],$_POST['room_id']];
    $res = update($q,$v,'iii');

    echo $res;

  }

  if (isset($_POST['remove_room']) && isset($_POST['hotel_id'])) {
    $res1 = select("SELECT * FROM `room_images` WHERE `room_id`=?", [$_POST['room_id']], 'i');

    while ($row = mysqli_fetch_assoc($res1)) {
        deleteImage($row['image'], ROOMS_FOLDER);
    }

    $res2 = delete("DELETE FROM `room_images` WHERE `room_id`=?", [$_POST['room_id']], 'i');
    $res3 = delete("DELETE FROM `room_features` WHERE `room_id`=?", [$_POST['room_id']], 'i');
    $res4 = delete("DELETE FROM `room_facilities` WHERE `room_id`=?", [$_POST['room_id']], 'i');
    $res5 = delete("DELETE FROM `rooms` WHERE `room_id`=?", [$_POST['room_id']], 'i');

    if ($res2 || $res3 || $res4 || $res5) {
        updateTotalRoomsForHotel($_POST['hotel_id']);
        echo 1;
    } else {
        echo 0;
    }
}


?>
