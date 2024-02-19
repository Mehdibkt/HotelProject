<?php

  require('../inc/db_config.php');
  require('../inc/essentials.php');
  adminLogin();

  if(isset($_POST['add_hotel']))
  {

    $flag = 0;

    $q1 = "INSERT INTO `hotels` (`name`, `nb_rooms`, `h_address`, `h_email`,`h_pn`,`rating`,`chain_id`) VALUES (?,?,?,?,?,?,?)";
    $values = [$_POST['name'],$_POST['nb_rooms'],$_POST['h_address'],$_POST['h_email'],$_POST['h_pn'],$_POST['rating'],$_POST['chain_id']];

    if(insert($q1,$values,'sisssii')){
      $flag = 1;
    }
    $hotel_id = mysqli_insert_id($con);
    if($flag){
      updateTotalHotelsForChains($_POST['chain_id']);

      echo 1;
    }
    else{
      echo 0;
    }


  }


  if(isset($_POST['get_all_hotels']))
  {
    $res = selectAll('hotels');
    $i=1;

    $data = "";

    while($row = mysqli_fetch_assoc($res))
    {
      $data.="
        <tr class='align-middle'>
          <td>$i</td>
          <td>$row[name]</td>
          <td>$row[nb_rooms]</td>
          <td>$row[h_address]</td>
          <td>$row[h_email]</td>
          <td>$row[h_pn]</td>
          <td>$row[rating]</td>
          <td>
            <button type='button' onclick='edit_details($row[hotel_id])' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-hotel'>
              <i class='bi bi-pencil-square'></i>
            </button>
            <button type='button' onclick=\"hotel_images($row[hotel_id],'$row[name]')\" class='btn btn-info shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#hotel-images'>
              <i class='bi bi-images'></i>
            </button>
            <button type='button' onclick='remove_hotel($row[hotel_id])' class='btn btn-danger shadow-none btn-sm'>
              <i class='bi bi-trash'></i>
            </button>
          </td>
        </tr>
      ";
      $i++;
    }

    echo $data;
  }

  if(isset($_POST['get_hotel']))
  {

    $res1 = select("SELECT * FROM `hotels` WHERE `hotel_id`=?",[$_POST['get_hotel']],'i');

    $hoteldata = mysqli_fetch_assoc($res1);

    $data = ["hoteldata" => $hoteldata];

    $data = json_encode($data);

    echo $data;

  }

  if(isset($_POST['edit_hotel']))
  {
    $original_chain_id = $_POST['original_chain_id'];
    $new_chain_id = $_POST['chain_id'];

    $flag = 0;

    $q1 = "UPDATE `hotels` SET `name`=?,`nb_rooms`=?,`h_address`=?,`h_email`=?,`h_pn`=?,`rating`=? ,`chain_id`=? WHERE `hotel_id`=?";
    $values = [$_POST['name'],$_POST['nb_rooms'],$_POST['h_address'],$_POST['h_email'],$_POST['h_pn'],$_POST['rating'],$_POST['chain_id'],$_POST['hotel_id']];

    if(update($q1,$values,'sisssiii')){
      $flag = 1;
    }

    if($flag){
      updateTotalHotels($original_chain_id, $new_chain_id);
      echo 1;
    }
    else{
      echo 0;
    }

  }



  if(isset($_POST['add_image']))
  {

    $img_r = uploadImage($_FILES['image'],HOTELS_FOLDER);

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
      $q = "INSERT INTO `hotel_images`(`hotel_id`, `image`) VALUES (?,?)";
      $values = [$_POST['hotel_id'],$img_r];
      $res = insert($q,$values,'is');
      echo $res;
    }
  }

  if(isset($_POST['get_hotel_images']))
  {
    $res = select("SELECT * FROM `hotel_images` WHERE `hotel_id`=?",[$_POST['get_hotel_images']],'i');

    $path = HOTELS_IMG_PATH;

    while($row = mysqli_fetch_assoc($res))
    {
      if($row['thumb']==1){
        $thumb_btn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
      }
      else{
        $thumb_btn = "<button onclick='thumb_image($row[sr_no],$row[hotel_id])' class='btn btn-secondary shadow-none'>
          <i class='bi bi-check-lg'></i>
        </button>";
      }

      echo<<<data
        <tr class='align-middle'>
          <td><img src='$path$row[image]' class='img-fluid'></td>
          <td>$thumb_btn</td>
          <td>
            <button onclick='rem_image($row[sr_no],$row[hotel_id])' class='btn btn-danger shadow-none'>
              <i class='bi bi-trash'></i>
            </button>
          </td>
        </tr>
      data;
    }

  }

  if(isset($_POST['rem_image']))
  {

    $values = [$_POST['image_id'],$_POST['hotel_id']];

    $pre_q = "SELECT * FROM `hotel_images` WHERE `sr_no`=? AND `hotel_id`=?";
    $res = select($pre_q,$values,'ii');
    $img = mysqli_fetch_assoc($res);

    if(deleteImage($img['image'],HOTELS_FOLDER)){
      $q = "DELETE FROM `hotel_images` WHERE `sr_no`=? AND `hotel_id`=?";
      $res = delete($q,$values,'ii');
      echo $res;
    }
    else{
      echo 0;
    }

  }

  if(isset($_POST['thumb_image']))
  {

    $pre_q = "UPDATE `hotel_images` SET `thumb`=? WHERE `hotel_id`=?";
    $pre_v = [0,$_POST['hotel_id']];
    $pre_res = update($pre_q,$pre_v,'ii');

    $q = "UPDATE `hotel_images` SET `thumb`=? WHERE `sr_no`=? AND `hotel_id`=?";
    $v = [1,$_POST['image_id'],$_POST['hotel_id']];
    $res = update($q,$v,'iii');

    echo $res;

  }

  if(isset($_POST['remove_hotel']) && isset($_POST['chain_id']))
  {


    $res1 = select("SELECT * FROM `hotel_images` WHERE `hotel_id`=?",[$_POST['hotel_id']],'i');

    while($row = mysqli_fetch_assoc($res1)){
      deleteImage($row['image'],HOTELS_FOLDER);
    }

    $res2 = delete("DELETE FROM `hotel_images` WHERE `hotel_id`=?",[$_POST['hotel_id']],'i');
    $res3 = delete("DELETE FROM `hotels` WHERE `hotel_id`=?",[$_POST['hotel_id']],'i');

    if($res2 || $res3){
      updateTotalHotelsForChains($_POST['chain_id']);
      echo 1;
    }
    else{
      echo 0;
    }

  }

  


?>