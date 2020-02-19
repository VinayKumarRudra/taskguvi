<?php
session_start();

// initializing variables
$email= "";
$studentname = "";
$password="";
$dob="";
$address="";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'student');

// REGISTER USER
  // receive all input values from the form
  $studentname = mysqli_real_escape_string($db, $_POST['name']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $dob = mysqli_real_escape_string($db, $_POST['DOB']);
  
  //$age = mysqli_real_escape_string($db, $_POST['age']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE studentname='$studentname' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  $e =$_SESSION["email"];
  if ($user) { // if user exists
    

    if ($user['email'] === $email) {
		
		header('Location: base.html');
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database
	header("location:base.html");
  	$query = mysqli_query($db,"update user set studentname='$studentname',password='$password', address='$address', dob='$dob' where email='$e'");
  	mysqli_query($db, $query);
  	$_SESSION['studentname'] = $studentname;
  	$_SESSION['success'] = "successfully updated";
  }