<?php
	// error_reporting(0);
	// error report ignore korar jonno
	// see more : http://www.w3schools.com/php/func_error_reporting.asp
	
	// mysql_fetch_array($result, MYSQL_ASSOC)
	// database theke j array ta fetch kora hobe seta indexing kivabe kora hobe seta derive kore. ekhane associative array send korbe
	// see more : http://php.net/manual/en/function.mysql-fetch-array.php
	
	//check if user submitted form
	if($_SERVER['REQUEST_METHOD']=='POST') {
		// connect database
		include('connection.php');
		
		//Create an array for errors:
		$errors = array();
		
		// collect data from form
		$identity = mysqli_real_escape_string($dbc,trim($_POST['identity']));
		$oldPassword = mysqli_real_escape_string($dbc,trim($_POST['oldPassword']));
		$newPassword = mysqli_real_escape_string($dbc,trim($_POST['newPassword']));
		$confermNewPassword = mysqli_real_escape_string($dbc,trim($_POST['confermNewPassword']));
		
		//error reporting
		if (empty($identity)) $errors[] = 'You are not entered your user name or email';
		if (empty($oldPassword)) $errors[] = 'You are not entered your current password';
		if (empty($newPassword)) $errors[] = 'You are not entered your new password';
		else {
			if ($newPassword != $confermNewPassword) $errors[] = 'Your new password and conferm password are not same';
		}
		
		if(empty($errors)) {
			$query = "SELECT `SignUpId` FROM `signup` WHERE (`UserName` = '".$identity."' OR `UserEmail` = '".$identity."') AND `UserPassword` = '".$oldPassword."'";
			$result = mysqli_query($dbc,$query);
			$totalRowNumber = mysqli_num_rows($result);
			if ($totalRowNumber == 1) {
				$row = mysqli_fetch_array($result, MYSQL_ASSOC);
				$id = $row['SignUpId'];
				$query = "UPDATE `signup` SET `UserPassword` = '".$newPassword."' WHERE `SignUpId` = ".$id;
				$result = mysqli_query($dbc,$query);
				$affectedNumberOfRows = mysqli_affected_rows($dbc);
				if ($affectedNumberOfRows == 1) echo "Thanks! you have updated your password."."<br>";
				else $errors[] = "Chouse a different password with your old password."."<br>";
			} else $errors[] = "Wrong username or email or password"."<br>";
		}
		
	}
?>
<h1>Change Password</h1>
<form action='update.php' method='post'>
	<p>User Name or Email: <input type='text' name = 'identity' size = '20' maxlength='30' value='<?PHP if(isset($_POST['identity'])) echo $identity; ?>'/></p>
	<p>Current Password: <input type='Password' name = 'oldPassword' size = '20' maxlength='30' value='<?PHP if(isset($_POST['oldPassword'])) echo $oldPassword; ?>'/></p>
	<p>New Password: <input type='Password' name = 'newPassword' size = '20' maxlength='30' value=''/></p>
	<p>Conferm New Password: <input type='Password' name = 'confermNewPassword' size = '20' maxlength='30' value=''/></p>
	<p><input type='submit' name='submit' value='Change Password'/></p>
</form>
<span style='color:red;'>
<?PHP
	if (!empty($errors)) {
			echo "The flowing error(s) occure: "."<br>";
			foreach($errors as $e){
				echo $e."<br>";
			}
		}
?>
</span>
	
	