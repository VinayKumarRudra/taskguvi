<?php
session_start();

// initializing variables
$studentname = "";
$email    = "";
$studentid="";
$password="";
$dob="";
$age="";
$address="";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'student');

// REGISTER USER
  // receive all input values from the form
  $studentid = mysqli_real_escape_string($db, $_POST['studentid']);
  $studentname = mysqli_real_escape_string($db, $_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $age = mysqli_real_escape_string($db, $_POST['age']);
  $dob = mysqli_real_escape_string($db, $_POST['DOB']);
  
  

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($studentid)) { array_push($errors, "Id is required"); }
  if (empty($studentname)) { array_push($errors, "Studentname is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE studentname='$studentname' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    

    if ($user['email'] === $email) {
		echo "email already exist";
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database
	header("location:base.html");
  	$query = "INSERT INTO user (studentid, studentname,email, password,address,age,dob) VALUES('$studentid','$studentname', '$email', '$password','$address','$age','$dob')";
  	mysqli_query($db, $query);
  	$_SESSION['studentname'] = $studentname;
  	$_SESSION['success'] = "You are now logged in";
  }