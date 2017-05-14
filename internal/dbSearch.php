<!DOCTYPE html>
<html>
	<head>
		   <!--
			  Edwins Grand Slam Landscaping 
			  Author: Doug Goldberg
			  Date:   3/28/2017

			  MainDB Query Utility
				
			  Filename: dbSearch.php
			   -->

			    <meta charset="UTF-8" />
				<title>Edwins Grand Slam Lawn Care</title> 
				<link href="dbSearch.css" rel="stylesheet" type="text/css"/>
				<link type="image/ico" rel="icon" href="favicon.ico"/>	
				
				
					
				
        </head>
	
	
	<body>

		
		<aside> 
		     <img class="flyer" src="http://www.edwinsgrandslamlawncare.com/main.jpg" alt="" />
		
		     <form method="post">
			<p class = "head"><b>Edwins Grand Slam Lawn Care Database Search Utility</b></p><hr>
			<p><b>Choose an option from the drop down menu to search the database</b></p>
			     
			<script type="text/javascript">
     				function configureDropDownLists(ddl1,ddl2) {
   				var contact = ['All Data', 'Names and Messages'];
    				var survey = ['All Data', 'Ratings', 'Names and Messages'];
   

    				switch (ddl1.value) {
        				case 'Contact':
            					ddl2.options.length = 0;
            					createOption(ddl2, 'Select an Option', 'NULL');
            				
            					for (i = 0; i < contact.length; i++) {
               						 createOption(ddl2, contact[i], contact[i]);
           					 }
           				 	break;
        
        				case 'Surveys':
            					ddl2.options.length = 0; 
            					createOption(ddl2, 'Select an Option', 'NULL');
           	
           					 for (i = 0; i < survey.length; i++) {
           						 createOption(ddl2, survey[i], survey[i]);
           					 }
           					 break;
 
    				}

			}

			    function createOption(ddl, text, value) {
        			var opt = document.createElement('option');
       				opt.value = value;
       				opt.text = text;
        			ddl.options.add(opt);
  			  }
			
			</script>


		<select id="ddl" name="tableSelect" class="fields" onchange="configureDropDownLists(this,document.getElementById('ddl2'))">

		<option value="NULL">Select a Table</option>
		<option value="Contact" name="contact">Contact Us DB</option>
		<option value="Surveys" name="surveys">Survey DB</option>
		</select>

		<select id="ddl2" class="fields" name="dbQuery" value = "NULL">
		</select>
				
		<input class="submitButton" type="submit" name="submit" value="Submit" >
				
		
		<?php
			
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			$tableSelect = $_POST['tableSelect'];
			
			
			if($tableSelect != 'NULL' && $_POST['dbQuery'] != 'NULL') {
		
				//Connect to DB and Print out All Data	
			
		        	// Create Connection
				$con = mysqli_connect("localhost", "edwindsg_admin", "dg704852", "edwindsg_mainDB");

	
				// Test Connection
				if (!$con) {
    					echo "Error: Unable to connect to MySQL." . PHP_EOL;
    					echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    					echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    					exit;
				}

					
				if($_POST['dbQuery'] == "All Data")
				{
				
					if($tableSelect == "Surveys"){
			
			
						$query = "SELECT * FROM surveys";
			
					}
			
					else if($tableSelect == "Contact"){
			
						$query = "SELECT * FROM contact";
			
					}
			
			
				$result = mysqli_query($con, $query);

				if (mysqli_num_rows($result) > 0) {
				
					echo "<br>" . "<br>";
	
					while($row = mysqli_fetch_assoc($result)){
	
						
						if($tableSelect == "Surveys"){
					
						echo "<b>First Name:</b>" . PHP_EOL . $row["first_name"] . PHP_EOL .
		 				"<b>Last Name:</b>" . PHP_EOL . $row["last_name"] . PHP_EOL . "<b>EMail:</b>" . PHP_EOL . $row["email"] . PHP_EOL .
						 "<b>Rating:</b>" . PHP_EOL . $row["rating"] . PHP_EOL . 
						 "<b>Message:</b>" . PHP_EOL . $row["message"] . "<br>" . "<br>" . "<br>";	
					
						}
						
						else if($tableSelect == "Contact"){
					
						
						echo "<b>First Name:</b>" . PHP_EOL . $row["first_name"] . PHP_EOL .
		 				"<b>Last Name:</b>" . PHP_EOL . $row["last_name"] . PHP_EOL . "<b>EMail:</b>" . PHP_EOL . $row["email"] . PHP_EOL .
						 "<b>Address:</b>" . PHP_EOL . $row["address"] . PHP_EOL . 
						 "<b>City:</b>" . PHP_EOL . $row["city"] . PHP_EOL . 
						 "<b>State:</b>" . PHP_EOL . $row["state"] . PHP_EOL . 
						 "<b>Zip:</b>" . PHP_EOL . $row["zip"] . PHP_EOL . 
						 "<b>Message:</b>" . PHP_EOL . $row["message"] . "<br>" . "<br>" . "<br>";
						}
						
					}

				}
			
			}
			
				else if($_POST['dbQuery'] == "Ratings")
				{
			
					$avg = 0;
					$count = 0;
			
					if($tableSelect == "Surveys"){
			
						$query = "SELECT rating FROM surveys";
				
					}
					
					else if($tableSelect == "Contact"){
			
						$query = "SELECT rating FROM contact";
			
					}
			
			
					$query = "SELECT rating FROM surveys";
					$result = mysqli_query($con, $query);

					if (mysqli_num_rows($result) > 0) {
				
						echo "<br>" . "<br>";
	
						while($row = mysqli_fetch_assoc($result)){
		
												
							echo "<b>Rating:</b>" . PHP_EOL . $row["rating"] . PHP_EOL . "<br>" . "<br>";
							$avg= $avg + $row["rating"];
						
							$count++;
						
						}
				
					$avg = round($avg/$count, 2);
					echo "<b>" ."Average Rating" . "</b>" . "<hr>";
					echo $avg;

					}
				
				}
			
				else if($_POST['dbQuery'] == "Names and Messages")
				{
			
					
					
					
					if($tableSelect == "Surveys"){	
					
						$query = "SELECT first_name, last_name, message FROM surveys";
					
					}
					
					else if($tableSelect == "Contact"){
			
						$query = "SELECT first_name, last_name, message FROM contact";
			
					}
					
					$result = mysqli_query($con, $query);

					if (mysqli_num_rows($result) > 0) {
				
						echo "<br>" . "<br>";
	
						while($row = mysqli_fetch_assoc($result)){
	
							echo "<b>Name:</b>" . PHP_EOL . $row["first_name"]
							. PHP_EOL .  $row["last_name"] . PHP_EOL .  "<b>Message:</b>" 
							. PHP_EOL . $row["message"] . PHP_EOL . "<br>" . "<br>";
						
					
						
						}
				
		
					}
			
				}
		
			
				else 
				{
					echo "No Results";
	
				}
			
			
			
			// Close Connection
			mysqli_close($con);
			
			}
			
		}
?>
			
			</form>
		</aside>
	</body>
</html>
