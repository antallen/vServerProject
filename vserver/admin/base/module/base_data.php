<?php
	include_once("conf.php");

	$sql_lang = 'SELECT * FROM customerData WHERE userID = :user_ID';
	//$sql_lang = 'SELECT * FROM customerData LEFT JOIN adminuser ON customerData.userID = adminuser.userID WHERE customerData.userID = :user_ID';

	$stmt = $db_conn->prepare($sql_lang);
	
	$uid = $_SESSION['uid'];
	//echo $_SESSION['uid'];
	//echo ($uid);
	$_SESSION['uid'] = trim($uid);
	//echo $_SESSION['uid'];
	$stmt->execute(array("user_ID" => $_SESSION['uid']));
	
	$row = $stmt->fetch();
	
?>