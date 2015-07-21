<?php
	if ($_SERVER["REQUEST_METHOD"] == 'POST') {
		$userName = $_REQUEST['name'];
		$userPassword = $_REQUEST['password'];
		
		//if (isset($userName,$userEmail,$userPassword)) {
		/*
			some time isset() does not working because of its can 
			not check set value of some field like password.
		*/
		if (!empty($userName)  && !empty($userPassword)) {
			include('connection.php');
			
			$query = mysqli_query($dbc, "SELECT * FROM `signup` WHERE (`UserName` Like '$userName' OR `UserEmail` Like '$userName')");
			$queryResult = mysqli_fetch_array($query);
			if (!empty($queryResult) && $queryResult['UserPassword'] == $userPassword) {
				echo "Welcome ".$queryResult['UserName']."<br>";
			} else {
				echo "SignIn Faild. Wrong password";
			}		
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