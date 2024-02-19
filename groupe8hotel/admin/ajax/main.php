<?php

  require('../inc/db_config.php');
  require('../inc/essentials.php');
  adminLogin();

  if(isset($_POST['add_chain']))
  {

    $flag = 0;

    $q1 = "INSERT INTO `chains` (`name`, `nb_hotels`, `c_address`, `c_email`,`c_pn`) VALUES (?,?,?,?,?)";
    $values = [$_POST['name'],$_POST['nb_hotels'],$_POST['c_address'],$_POST['c_email'],$_POST['c_pn']];

    if(insert($q1,$values,'sisss')){
      $flag = 1;
    }
    $chain_id = mysqli_insert_id($con);
    if($flag){
      echo 1;
    }
    else{
      echo 0;
    }


  }


  if(isset($_POST['get_all_chains']))
  {
    $res = selectAll('chains');
    $i=1;

    $data = "";

    while($row = mysqli_fetch_assoc($res))
    {
      $data.="
        <tr class='align-middle'>
          <td>$i</td>
          <td>$row[name]</td>
          <td>$row[nb_hotels]</td>
          <td>$row[c_address]</td>
          <td>$row[c_email]</td>
          <td>$row[c_pn]</td>
          <td>
            <button type='button' onclick='edit_details($row[chain_id])' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-chain'>
              <i class='bi bi-pencil-square'></i>
            </button>
            <button type='button' onclick=\"chain_images($row[chain_id],'$row[name]')\" class='btn btn-info shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#chain-images'>
              <i class='bi bi-images'></i>
            </button>
            <button type='button' onclick='remove_chain($row[chain_id])' class='btn btn-danger shadow-none btn-sm'>
              <i class='bi bi-trash'></i>
            </button>
          </td>
        </tr>
      ";
      $i++;
    }

    echo $data;
  }

  if(isset($_POST['get_chain']))
  {

    $res1 = select("SELECT * FROM `chains` WHERE `chain_id`=?",[$_POST['get_chain']],'i');

    $chaindata = mysqli_fetch_assoc($res1);

    $data = ["chaindata" => $chaindata];

    $data = json_encode($data);

    echo $data;

  }

  if(isset($_POST['edit_chain']))
  {

    $flag = 0;

    $q1 = "UPDATE `chains` SET `name`=?,`nb_hotels`=?,`c_address`=?,`c_email`=?,`c_pn`=? WHERE `chain_id`=?";
    $values = [$_POST['name'],$_POST['nb_hotels'],$_POST['c_address'],$_POST['c_email'],$_POST['c_pn'],$_POST['chain_id']];

    if(update($q1,$values,'sisssi')){
      $flag = 1;
    }

    if($flag){
      echo 1;
    }
    else{
      echo 0;
    }

  }



  if(isset($_POST['add_image']))
  {

    $img_r = uploadImage($_FILES['image'],CHAINS_FOLDER);

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
      $q = "INSERT INTO `chain_images`(`chain_id`, `image`) VALUES (?,?)";
      $values = [$_POST['chain_id'],$img_r];
      $res = insert($q,$values,'is');
      echo $res;
    }
  }

  if(isset($_POST['get_chain_images']))
  {
    $res = select("SELECT * FROM `chain_images` WHERE `chain_id`=?",[$_POST['get_chain_images']],'i');

    $path = CHAINS_IMG_PATH;

    while($row = mysqli_fetch_assoc($res))
    {
      if($row['thumb']==1){
        $thumb_btn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
      }
      else{
        $thumb_btn = "<button onclick='thumb_image($row[sr_no],$row[chain_id])' class='btn btn-secondary shadow-none'>
          <i class='bi bi-check-lg'></i>
        </button>";
      }

      echo<<<data
        <tr class='align-middle'>
          <td><img src='$path$row[image]' class='img-fluid'></td>
          <td>$thumb_btn</td>
          <td>
            <button onclick='rem_image($row[sr_no],$row[chain_id])' class='btn btn-danger shadow-none'>
              <i class='bi bi-trash'></i>
            </button>
          </td>
        </tr>
      data;
    }

  }

  if(isset($_POST['rem_image']))
  {

    $values = [$_POST['image_id'],$_POST['chain_id']];

    $pre_q = "SELECT * FROM `chain_images` WHERE `sr_no`=? AND `chain_id`=?";
    $res = select($pre_q,$values,'ii');
    $img = mysqli_fetch_assoc($res);

    if(deleteImage($img['image'],CHAINS_FOLDER)){
      $q = "DELETE FROM `chain_images` WHERE `sr_no`=? AND `chain_id`=?";
      $res = delete($q,$values,'ii');
      echo $res;
    }
    else{
      echo 0;
    }

  }

  if(isset($_POST['thumb_image']))
  {

    $pre_q = "UPDATE `chain_images` SET `thumb`=? WHERE `chain_id`=?";
    $pre_v = [0,$_POST['chain_id']];
    $pre_res = update($pre_q,$pre_v,'ii');

    $q = "UPDATE `chain_images` SET `thumb`=? WHERE `sr_no`=? AND `chain_id`=?";
    $v = [1,$_POST['image_id'],$_POST['chain_id']];
    $res = update($q,$v,'iii');

    echo $res;

  }

  if(isset($_POST['remove_chain']))
  {


    $res1 = select("SELECT * FROM `chain_images` WHERE `chain_id`=?",[$_POST['chain_id']],'i');

    while($row = mysqli_fetch_assoc($res1)){
      deleteImage($row['image'],CHAINS_FOLDER);
    }

    $res2 = delete("DELETE FROM `chain_images` WHERE `chain_id`=?",[$_POST['chain_id']],'i');
    $res3 = delete("DELETE FROM `chains` WHERE `chain_id`=?",[$_POST['chain_id']],'i');

    if($res2 || $res3){
      echo 1;
    }
    else{
      echo 0;
    }

  }

  


?>