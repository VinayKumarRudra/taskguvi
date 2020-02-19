
<?php
   
   session_start();
$connection = mysqli_connect("localhost", "root", "","student");

  $studentid=$_SESSION["email"];
   
   if(! $connection ) {
      die('Could not connect: ' . mysql_error());
   }
   
   $query = mysqli_query($connection,"select * from user where email='$studentid'");
  
   
   if(! $query ) {
      die('Could not get data: ' . mysqli_error());
   }
   
   while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
      
		  
	echo  "Details:";
	echo "<p>NAME : $row[1]</p>";
	echo "<p>dob : $row[6]</p>";
   echo "<p>address:$row[4]</p>";
   echo "<p>age:$row[5]</p>";
		 
         $_SESSION["name"] = $row[1];
		 $_SESSION["dob"] = $row[6];
		 $_SESSION["password"] = $row[3];
		 $_SESSION["address"] = $row[4];
		 
		 
   }
    
   
   mysqli_close($connection);
   
?>
<p><b>want to modify data click modify</b></p>
	<form action="update.php" method="post">
		 <input type="submit" value="click">
	</form>