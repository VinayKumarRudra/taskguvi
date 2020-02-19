<?php 
	session_start();
	$name=$_SESSION["name"];
	$password=$_SESSION["password"];
	$dob=$_SESSION["dob"];
	$address=$_SESSION["address"];
	
	?>
<html>
<head
	<title>update</title>
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> <!-- load bootstrap via CDN -->
	<link rel="stylesheet" type="text/css" href="signupcss.css">
</head>
<body>

<div class="loginbox">
		<img src="signupavatar.jpg" class="avatar">
	
	<h1>update field<h1>
<div class="col-sm-6 col-sm-offset-3">

	

	<!-- OUR FORM -->
	<form action="updatephp.php" method="POST">
	
		
		
		
		<div id="name-group" class="form-group">
			<label for="name">Name</label>
		<input type="text" class="form-control" name="name" value = '<?php echo "$name" ?>'>
		
		</div>

		
		
		<div id="password-group" class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" name="password" value = '<?php echo "$password" ?>'>
			<!-- errors will go here -->
		</div>
		
		
		<!-- NAME -->
		<div id="dob-group" class="form-group">
			<label for="DOB">DOB</label>
			<input type="date" class="form-control" name="DOB" value = '<?php echo "$dob" ?>'>
			<!-- errors will go here -->
		</div>
		

		<div id="address-group" class="form-group">
			<label for="address">address</label>
			<input type="text" class="form-control" name="address" value = '<?php echo "$address" ?>'>
			<!-- errors will go here -->
		</div>

		
		
		
		
		

		
		
		<input type="submit" class="btn btn-success" value="submit">

	</form>


</div>
</div>
</body>
</html>