<?php
	require_once("../../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");
	
	$sql_lang = 'SELECT * FROM baseRule_vhosts WHERE OwnerID = :user_ID';

	$stmt = $db_conn->prepare($sql_lang);
	
	$stmt->execute(array("user_ID" => $_SESSION['manage_uid']));

	$row = $stmt->fetch();
	
	if (!is_null($row[2])){
		echo "訂購主機數量：$row[2]";
	} else {
		echo "訂購主機數量：0";
	}
	
	$db_conn="";
?>