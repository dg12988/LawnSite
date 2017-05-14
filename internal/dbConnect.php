<?php

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
		
			echo "Password is Incorrect, Page will Refresh in 5 Seconds.";
			header("Refresh: 5; url= http://edwinsgrandslamlawncare.com/internal/login.html");
		}
	
	}

}
	
else {
	echo "User Name Not Found, Page will Refresh in 5 Seconds.";
	header("Refresh: 5; url= http://edwinsgrandslamlawncare.com/internal/login.html");
	
}



// Close Connection
mysqli_close($con);

?>

