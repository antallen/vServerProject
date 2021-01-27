<?php
	include_once("conf.php");

	$sql_lang = 'SELECT * FROM adminuser WHERE userID = :user_ID';
	//$sql_lang = 'SELECT * FROM customerData LEFT JOIN adminuser ON customerData.userID = adminuser.userID WHERE customerData.userID = :user_ID';

	$stmt = $db_conn->prepare($sql_lang);
	
	$stmt->execute(array("user_ID" => $_SESSION['uid']));
	
	

?>