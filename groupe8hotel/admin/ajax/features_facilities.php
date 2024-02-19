<?php 

  require('../inc/db_config.php');
  require('../inc/essentials.php');
  adminLogin();

  if(isset($_POST['add_feature']))
  {

    $q = "INSERT INTO `features`(`name`) VALUES (?)";
    $values = [$_POST['name']];
    $res = insert($q,$values,'s');
    echo $res;
  }

  if(isset($_POST['get_features']))
  {
    $res = selectAll('features');
    $i=1;

    while($row = mysqli_fetch_assoc($res))
    {
      echo <<<data
        <tr>
          <td>$i</td>
          <td>$row[name]</td>
          <td>
            <button type="button" onclick="rem_feature($row[id])" class="btn btn-danger btn-sm shadow-none">
              <i class="bi bi-trash"></i> Delete
            </button>
          </td>
        </tr>
      data;
      $i++;
    }
  }

  if(isset($_POST['rem_feature']))
  {
    $values = [$_POST['rem_feature']];
    $q = "DELETE FROM `features` WHERE `id`=?";
    $res = delete($q,$values,'i');
    echo $res;
  }


  if(isset($_POST['add_facility']))
  {
      $q = "INSERT INTO `facilities`(`name`) VALUES (?)";
      $values = [$_POST['name']];
      $res = insert($q,$values,'s');
      echo $res;
    }


  if(isset($_POST['get_facilities']))
  {
    $res = selectAll('facilities');
    $i=1;

    while($row = mysqli_fetch_assoc($res))
    {
      echo <<<data
        <tr class='align-middle'>
          <td>$i</td>
          <td>$row[name]</td>
          <td>
            <button type="button" onclick="rem_facility($row[id])" class="btn btn-danger btn-sm shadow-none">
              <i class="bi bi-trash"></i> Delete
            </button>
          </td>
        </tr>
      data;
      $i++;
    }
  }

  if(isset($_POST['rem_facility']))
  {
    $values = [$_POST['rem_facility']];
    $q = "DELETE FROM `facilities` WHERE `id`=?";
    $res = delete($q,$values,'i');
    echo $res;  
  }

?>