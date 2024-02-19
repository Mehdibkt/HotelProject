<?php 

  require('../inc/db_config.php');
  require('../inc/essentials.php');
  adminLogin();

  if(isset($_POST['get_general']))
  {
    $q = "SELECT * FROM `settings` WHERE `sr_no`=?";
    $values = [1];
    $res = select($q,$values,"i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
  }

  if(isset($_POST['upd_general']))
  {

    $q = "UPDATE `settings` SET `site_title`=?, `site_about`=? WHERE `sr_no`=?";
    $values = [$_POST['site_title'],$_POST['site_about'],1];
    $res = update($q,$values,'ssi');
    echo $res;
  }

  if(isset($_POST['get_contacts']))
  {
    $q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [1];
    $res = select($q,$values,"i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
  }

  if(isset($_POST['upd_contacts']))
  {
    $q = "UPDATE `contact_details` SET `address`=?,`gmap`=?,`pn`=?,`email`=?,`fb`=?,`insta`=?,`tw`=?,`iframe`=? WHERE `sr_no`=?";
    $values = [$_POST['address'],$_POST['gmap'],$_POST['pn'],$_POST['email'],$_POST['fb'],$_POST['insta'],$_POST['tw'],$_POST['iframe'],1];
    $res = update($q,$values,'ssssssssi');
    echo $res;
  }

  if(isset($_POST['add_member']))
  {
    $img_r = uploadImage($_FILES['picture'], ABOUT_FOLDER);

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
      $q = "INSERT INTO `employee_cred`(`e_name`, `picture`, `e_nas`, `e_role`, `e_address`) VALUES (?,?,?,?,?)";
      $values = [$_POST['e_name'],$img_r,$_POST['e_nas'],$_POST['e_role'],$_POST['e_address']];
      $res = insert($q,$values,'ssiss');
      echo $res;
    }
  }
  if(isset($_POST['get_members']))
  {
    $res = selectAll('employee_cred');

    while($row = mysqli_fetch_assoc($res))
    {
      $path = ABOUT_IMG_PATH;
      echo <<<data
        <div class="col-md-2 mb-3">
          <div class="card bg-dark text-white">
            <img src="$path$row[picture]" class="card-img">
            <div class="card-img-overlay text-end">
              <button type="button" onclick="rem_member($row[e_id])" class="btn btn-danger btn-sm shadow-none">
                <i class="bi bi-trash"></i> Delete
              </button>
            </div>
            <p class="card-text text-center px-3 py-2">$row[e_name]</p>
          </div>
        </div>
      data;
    }
  }

  if(isset($_POST['rem_member']))
  {
    $values = [$_POST['rem_member']];

    $pre_q = "SELECT * FROM `employee_cred` WHERE `e_id`=?";
    $res = select($pre_q,$values,'i');
    $img = mysqli_fetch_assoc($res);

    if($_POST['rem_member']==1){
      
      echo 2;
    }

    else if(deleteImage($img['picture'],ABOUT_FOLDER)){
      $q = "DELETE FROM `employee_cred` WHERE `e_id`=?";
      $res = delete($q,$values,'i');
      echo $res;
    }
    else{
      echo 0;
    }

  }
?>