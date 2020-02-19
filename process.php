<?php
session_start();

$errors         = array();  	// array to hold validation errors
$data 			= array(); 		// array to pass back data

// validate the variables ======================================================
	// if any of these variables don't exist, add an error to our $errors array

	if (empty($_POST['email']))
		$errors['email'] = 'Email is required.';

	if (empty($_POST['password']))
		$errors['password'] = 'Password is required.';

	$email = $_POST['email'];
	$password = $_POST['password'];	
// return a response ===========================================================

	// if there are any errors in our errors array, return a success boolean of false
	if ( ! empty($errors)) {

		// if there are items in our errors array, return those errors
		$data['success'] = false;
		$data['errors']  = $errors;
	} else {

		// if there are no errors process our form, then return a message
		$conn = mysqli_connect("localhost", "root", "","student");
		 //Selecting Database
		 //sql query to fetch information of registerd user and finds user match.
		 if (!($conn -> connect_errno)) {
			 $query = mysqli_query($conn, "SELECT * FROM user WHERE password='$password' AND email='$email'");
			 
			 $rows = mysqli_num_rows($query);
			 if($rows == 1){
					$data['success'] = true;
					$data['message'] = 'Successss!';		
					$_SESSION["email"] = $email;
				}
			 else
			 {
					$data['success'] = false;
					$data['errors']['cred']  = 'Incorrect credentials';
			 }
			 mysqli_close($conn); // Closing connection
		 } 
		 else{
					$data['success'] = false;
					$data['errors']['conn']  = "DB connection failed";
		 }
		// DO ALL YOUR FORM PROCESSING HERE
		// THIS CAN BE WHATEVER YOU WANT TO DO (LOGIN, SAVE, UPDATE, WHATEVER)

		// show a message of success and provide a true success variable
		
	}

	// return all our data to an AJAX call
	echo json_encode($data);