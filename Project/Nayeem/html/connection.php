<?php

	// to make connection need some variable decleration

	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'rapidlearning';

	//making the connection to mysql
	$dbc = mysqli_connect($hostname, $username, $password, $dbname) OR die("not possible to make connection".mysqli_connect_error());

	//set encoding
	mysqli_set_charset($dbc,'utf8');

	//massage for connected confermation
	//echo "U R connected to ".$dbname." Database.<br>";

?>
