<?php
	require_once("../../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");
	
	$sql_lang1 = 'SELECT count(vhost) FROM vhosts WHERE userID = :user_ID';

	$stmt = $db_conn->prepare($sql_lang1);
	
	$stmt->execute(array("user_ID" => $_SESSION['manage_uid']));

	$row = $stmt->fetch();
	
	if (!is_null($row[0])){
		echo "已使用數量：".$row[0];
	} else {
		echo "已使用數量：0";
	}
	
	$sql_lang2 = 'SELECT * from adminuser WHERE userID = :user_ID';
	$stmt1 = $db_conn->prepare($sql_lang2);
	$stmt1->execute(array("user_ID" => $_SESSION['manage_uid']));
	$row2 = $stmt1->fetch();
	$main_path = $row2['dataPath'];
	echo "<br>主目錄：".$main_path;
	$db_conn = "";
?>