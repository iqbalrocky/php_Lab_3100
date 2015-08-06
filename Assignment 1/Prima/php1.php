<?php
$user_name=$_POST['user'];
$password=$_POST['pass'];
$strings = array($user_name, $password);
foreach ($strings as $testcase) {
    if (ctype_alnum($testcase)) {
        echo "The string $testcase consists of all letters or digits.\n";
		//echo "ACCEPTED!!";
    } else {
        echo $testcase." does not consist of all letters or digits.\n
		TRY AGAIN !!";
    }
}
?>

