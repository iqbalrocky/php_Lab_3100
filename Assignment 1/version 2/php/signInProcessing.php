<?php
	include('connection.php');
	
	if ($_SERVER["REQUEST_METHOD"] == 'POST') {
		$userName = mysqli_real_escape_string($dbc,trim($_REQUEST['name']));
		$userPassword = mysqli_real_escape_string($dbc,trim($_REQUEST['password']));
		
		//if (isset($userName,$userEmail,$userPassword)) {
		/*
			some time isset() does not working because of its can 
			not check set value of some field like password.
		*/
		if (!empty($userName)  && !empty($userPassword)) {
			
			/*
				table er name er jonno ` quote sign use kora lagbe -_-
			*/
			
			$query = mysqli_query($dbc, "SELECT * FROM `signup` WHERE (`UserName` Like '".$userName."' OR `UserEmail` Like '".$userName."')");
			
			/*
			$query = mysqli_query($dbc, "SELECT * FROM `signup` WHERE (`UserName` Like '$userName' OR `UserEmail` Like '$userName')");
			$query = mysqli_query($dbc, "SELECT * FROM `signup` WHERE (`UserName` Like '$userName' OR `UserEmail` Like '$userName') AND `UserPassword` Like '$userPassword'");
			$queryResult = mysqli_fetch_array($query);
			
			if (!empty($queryResult)) {
			//if (!empty($queryResult) && $queryResult['UserPassword'] == $userPassword) {
				echo "Welcome ".$queryResult['UserName']."<br>";
			} else {
				echo "SignIn Faild. Wrong password";
			}
			*/
			
			$numrows = mysqli_num_rows($query);
			if ($numrows != 0) {
				$queryResult = mysqli_fetch_array($query);
				$queryName = $queryResult['UserName'];
				$queryPassword = $queryResult['UserPassword'];
				if ($queryPassword == $userPassword) {
					echo "Welcome ".$queryName."<br>";
				}
				else {
					echo "SignIn Faild. Wrong password.<br>";
				}
			} else {
				echo "SignIn Faild. Wrong user name or email.<br>";
			}
			
			mysqli_close($dbc);
				
		} else {
			echo "please fill all values of the form";
		}
		
	} else {
		echo "Please SignUp first";
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