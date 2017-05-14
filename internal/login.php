<!DOCTYPE html>
<html>
	<head>
		   <!--
			  Edwins Grand Slam Landscaping 
			  Author: Doug Goldberg
			  Date:   3/30/2017

			  Internal Login 
				
			  Filename: login.php
			   -->

			    <meta charset="UTF-8" />
				<title>Grand Slam Internal</title> 
				<link href="login.css" rel="stylesheet" type="text/css"/>
				<link type="image/ico" rel="icon" href="favicon.ico"/>	
			
				
				<p class="head1">EDWINS GRAND SLAM LAWN CARE INTERNAL</p>
							
				
					
    </head>
	
	
	<body>
	
		<aside> 

			<p class="head2">This form allows you to log into the internal site for Edwins Grandslam Lawn Care</p>
			
			
			<form method="POST">
				<input class="fields" type="email" name="email" placeholder="Email" required><br>
				<input class="fields" type="password" name="pass" placeholder="Password" required><br> 
				<input class="submitButton" type="submit" name="submit" value="Submit" >
		
			</form>
				
			
				<?php
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		// POST DATA VARIABLE DECLARATION
		$user = $_POST["email"];
		$pass = $_POST["pass"];

		// Create Connection
		$con = mysqli_connect("localhost", "edwindsg_admin", "dg704852", "edwindsg_mainDB");


		// Test Connection
		if (!$con) {
  			echo "Error: Unable to connect to MySQL." . PHP_EOL;
   			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
   			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    			exit;
		}


		// Check user input credentials against the database
		$query = "SELECT * FROM Internal WHERE userEmail = '$user'";
		$result = mysqli_query($con, $query);

		if (mysqli_num_rows($result) > 0) {
	
			while($row = mysqli_fetch_assoc($result)){
	
				if($pass == $row["userPass"] ){
			
					header("Location: http://edwinsgrandslamlawncare.com/internal/survey.html");
					die();
			
				}
				
				else{
		
					echo "Password is Incorrect";
		
				}
	
			}

		}
	
	else {
		echo "User Name Not Found";
	
	
	}



	// Close Connection
	mysqli_close($con);
}
?>
	

		</aside>


	</body>
	
	<footer>
		<p><b>THIS PAGE IS FOR INTERNAL USE BY EDWINS GRAND SLAM LAWN CARE EMPLOYEES ONLY</p>	
	</footer>
	
</html>

