<?php
session_start();

if (isset($_POST['register'])) {
  // receive all input values from the form
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $contact = mysqli_real_escape_string($db, $_POST['contact']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT email FROM user WHERE email='$email'";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $query = "INSERT INTO user (fname, lname, contact, email, password) 
          VALUES('$fname', '$lname', '$contact', '$email' '$password')";
    header('location: user');
  }
}

// ...
// ... 

