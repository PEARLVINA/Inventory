<?php

include 'includes/db_connect.php';

session_start();

if(isset($_SESSION["user_id"])){
    header("Location: user");
    die();
}


if(isset($_POST['log'])){
  
    $email = $_POST['email'];
    $password = $_POST['password'];
    $error="";
    
    $sql = "SELECT * FROM user WHERE email ='". $email . "'" ;
    //echo $sql;
    $user = $conn->query($sql);
    $user = $user->fetch_assoc();
    if(!empty($user)){
  
      if($password == $user['password']){
      
        $_SESSION["user_id"] = $user['id'];
        
        // echo $_SESSION["user_id"];
        
        header("Location: user");
        die();
        
      }
      
      else{
        $error = "Invalid Password!";
      }
      
    }
    
    else{
      $error = "User not found!";
    }
    
  }

?>
<!-- *START* insert here all css links and page title -->


<!-- *END* insert here all css links and page title -->
<!doctype html>
<html lang="en">
  <head>
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?=$baseUrl?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=$baseUrl?>assets/css/login.css">

<title>Login</title>
<body class="body-forms" style="background-color:#9C9C9C  ;">

<nav class="navbar navbar-default fixed-top my-navbar">
  <div class="container">
    <div class="navbar-header" class="dropdown-menu" style="text-align: right;">
      <a href="#" class="navbar-brand" 
      style="text-align:left; color:white; font-family: arial black; font-size:15px;"> 
      INVENTORY SYSTEM </a>
    </div>
  </div>
</nav>

<br>
<br>
<br>
<form method="post" action="index.php">

    <div class="jumbotron" align="center" >
        <form class="register" autocomplete="off">
        <div class="form-group" autocomplete="off" >
        <?php if(!empty($error)) { ?>
          <p class="error"  style="color: #C0392B ;"><?php echo $error; ?></p>  
        <?php } ?>
    <div class="col-md-6-md-offset-3" id="register"> 
    </div>
        <div class="input-header">
          <label for="exampleInputEmail1">Email address</label>
          <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" autocomplete="off" required>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off" required>
        </div>

        <button name="log" type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</formmethod="POST">

<?php
include 'includes/footer.php';
?>