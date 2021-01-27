<?php
	require_once("conf.php");

	//echo $_SESSION['uid'];
	
	$sql_lang = 'SELECT * FROM baseRule_mysql WHERE OwnerID = :user_ID';
	$stmt = $db_conn->prepare($sql_lang);
	$stmt->execute(array("user_ID" => $_SESSION['uid']));
	$row = $stmt->fetch();
	
	echo "MySQL 資料庫訂購數量：".$row[2]."&nbsp;&nbsp;&nbsp;";
	
	$sql_lang1 = 'SELECT count(*) FROM baseRule_mysql_detail WHERE mysql_ID = "'.$row[3].'"';
	$stmt2 = $db_conn->prepare($sql_lang1);
	$stmt2->execute();
	$row1 = $stmt2->fetch();
	
	echo "&nbsp;&nbsp;&nbsp;已使用數量：".$row1[0]."<Br>";
	echo "每個資料庫可使用空間：50MB";
	
	$database_reminder = (int)$row[2]-(int)$row1[0];
	$mysqlID = $row[3];
?>
