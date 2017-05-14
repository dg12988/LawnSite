<?php

//User Input Declaration

$e1 = $_POST['email1'];
$e2 = $_POST['email2'];
$e3 = $_POST['email3'];
$e4 = $_POST['email4'];
$e5 = $_POST['email5'];
$e6 = $_POST['email6'];
$e7 = $_POST['email7'];
$e8 = $_POST['email8'];
$e9 = $_POST['email9'];
$e10 = $_POST['email10'];


//Create Array for recipients

$recipients = array($e1, $e2, $e3, $e4, $e5, $e6, $e7, $e8, $e9, $e10);

//Initialize iterator

$x = 0;


//Send Email, Iterate through list of up to 10 Emails

while($x < sizeof($recipients)){

$to = $recipients[$x];

$subject = "Thank You for Your Business! Edwins Grand Slam Lawn Care";
$txt = "Dear Customer, Thank you for your business! We here at Edwins Grand Slam Lawn Care are always trying to provide the best service to our customers. If you would, please take a moment to take a very brief survey on our performance. Click this link: www.edwinsgrandslamlawncare.com/internal/customerSurvey.html. Once again, we appreciate you so much and thank you for contributing to making Edwins Grand Slam Lawn Care the best lawn care service around. www.edwinsgrandslamlawncare.com";
$headers = "From: Grand Slam Support" . "\r\n";

mail($to,$subject,$txt,$headers);


//Iterate counter

$x++;
}

echo " Page will Refresh in 5 Seconds.";

header("Refresh: 5; url= http://edwinsgrandslamlawncare.com/internal/survey.html");

die();

?>

