<?php 
require('inc/essentials.php');
require('inc/db_config.php'); 

// Si on est deja connecté et on veut revenir a la page d'accueil, le site nous redirige automatiquement à Employee Portal
session_start();
if((isset($_SESSION['e_Login']) && $_SESSION['e_Login'] == true)){
  
  redirect('main.php');
  
}
?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require('inc/links.php'); ?>
    <style>
        div.login-form{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 400px;
        }
    </style>
</head>
<body class="bg-light">
    
  <div class="login-form text-center rounded bg-white shadow overflow-hidden">
    <form method="POST">
      <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
      <div class="p-4">
        <div class="mb-3">
          <input name="e_name" required type="text" class="form-control shadow-none text-center" placeholder="Admin Name">
        </div>
        <div class="mb-4">
          <input name="e_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
        </div>
        <button name="login" type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
      </div>
    </form>
  </div>

  <?php 
    if(isset($_POST['login']))
    {
        $query = "SELECT * FROM `employee_cred` WHERE `e_name`=? AND `e_pass`=?";
        $values = [$_POST['e_name'],$_POST['e_pass']];
        $res = select($query,$values,"ss");
        if ($res->num_rows==1) {
          $row = mysqli_fetch_assoc($res);
          $_SESSION['e_Login'] = true;
          $_SESSION['eID'] = $row['e_id'];
          redirect('main.php');
          
        }
        else{
          alert('error', 'Login Failed! Please try again.') ;
          
        }
    }  
    
  
  ?>

    
    <?php require('inc/scripts.php') ?>
</body>
</html>