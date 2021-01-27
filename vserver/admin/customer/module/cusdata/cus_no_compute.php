<?php
	require_once("conf.php");
	
	
	$sql_lang = 'SELECT * FROM adminuser order by userID DESC limit 0,1';

	$stmt = $db_conn->prepare($sql_lang);
	
	$stmt->execute();
	
	while ($row = $stmt->fetch()){
		
		echo $row[0];
		//$userID = $row[0];
	}
	//$arr1=str_split($userID);
	
?>