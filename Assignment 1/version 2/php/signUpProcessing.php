<?php
	if ($_SERVER["REQUEST_METHOD"] == 'POST') {
		
		include('connection.php');
		
		$userName = mysqli_real_escape_string($dbc,trim($_REQUEST['name']));
		$userEmail = mysqli_real_escape_string($dbc,trim($_REQUEST['email']));
		$userPassword = mysqli_real_escape_string($dbc,trim($_REQUEST['password']));
		
		//if (isset($userName,$userEmail,$userPassword)) {
		/*
			some time isset() does not working because of its can 
			not check set value of some field like password.
		*/
		if (!empty($userName) && !empty($userEmail) && !empty($userPassword)) {
			
			mysqli_query($dbc, "INSERT INTO `signup` (`UserName`, `UserEmail`, `UserPassword`) VALUES ('$userName','$userEmail','$userPassword')");
			$registered = mysqli_affected_rows($dbc);
			echo "<br>";
			echo $registered." row is affected, everything work fine.";
			
			mysqli_close($dbc);
					
		} else {
			echo "please fill all values of the form";
		}
		
	} else {
		echo "No form hass been submitted";
	}
	
	/*
		i can not add this bunch of code in home page because of 
		at least 2 post method a include in home page. i have no 
		idea how can i handle it :/.
	*/
	/*
		try and fail:
			make password field as unique.
	*/
	
?>