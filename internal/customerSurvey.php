<?php


// Create Connection
$con = mysqli_connect("localhost", "edwindsg_admin", "dg704852", "edwindsg_mainDB");


// Test Connection
if (!$con) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


// Initialize variables to corresponding user input

$userFirst= $_POST['first_name'];
$userLast= $_POST['last_name'];
$userEmail= $_POST['email'];
$userRating= $_POST['rating-input-1'];
$userMessage= $_POST['message'];

//Enter User Input into Database Table

$query = "INSERT INTO surveys(first_name, last_name, email, rating, message) 
		VALUES('$userFirst', '$userLast', '$userEmail', '$userRating', '$userMessage');";


if(mysqli_query($con, $query)){
	
//Send Email
$to = "doug.goldberg@me.com";

$subject = "Edwins Grand Slam Lawn Care: A Customer Has Completed a Survey";
$txt = "A Survey Has Been Completed, View the Survey Database at www.edwinsgrandslamlawncare.com/internal/dbSearch.php";
$headers = "From: Grand Slam Support" . "\r\n";

mail($to,$subject,$txt,$headers);


 	header("Location: http://edwinsgrandslamlawncare.com/internal/endSurvey.html");
	die();
}

else {
    echo "Error: " . $query . "<br>" . mysqli_error($con);
    echo " Page will Refresh in 5 Seconds.";

    header("Refresh: 5; url= http://edwinsgrandslamlawncare.com/internal/customerSurvey.html");
    
}

// Close Connection
mysqli_close($con);

?>

