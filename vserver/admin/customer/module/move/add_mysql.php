<?php
	date_default_timezone_set("Asia/Taipei");

	require_once("../../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	
	$user_ID = $_POST['user_ID'];
	
	if(!empty($_POST['add_mysql'])){
		if ($_POST['add_mysql'] == "新增"){
			$mysql_num = $_POST['mysql_num'];
			$mysql_start_date = $_POST['mysql_start_date'];
			$mysql_end_date = $_POST['mysql_end_date'];
			$mysql_ID = $user_ID . "MySQL";
			echo "hello";
			echo $user_ID;
			$sql_lang = 'INSERT INTO `baseRule_mysql` (OwnerID,mysql_num,mysql_ID,order_date,expiration)
				VALUES ("'.$user_ID.'","'.$mysql_num.'","'.$mysql_ID.'","'.$mysql_start_date.'","'.$mysql_end_date.'")';
	
		}
	}
	if(!empty($_POST['update_mysql'])){
		if ($_POST['update_mysql'] == "更新"){
			$mysql_num = $_POST['mysql_num'];
			$mysql_start_date = $_POST['mysql_start_date'];
			$mysql_end_date = $_POST['mysql_end_date'];
			$mysql_ID = $user_ID . "MySQL";
		
			echo "update";
			echo $user_ID;
			$sql_lang = 'UPDATE `baseRule_mysql` SET mysql_num = '.(int)$mysql_num.',mysql_ID = "'.$mysql_ID.'",
			            order_date = "'.$mysql_start_date.'", expiration = "'.$mysql_end_date.'"
						WHERE OwnerID = "'.$user_ID.'"';
			//echo $sql_lang;
		}
	}
	if(!empty($_POST['delete_mysql'])){
		if ($_POST['delete_mysql'] == "刪除"){
			echo "delete";
			echo $user_ID;
			$sql_lang = 'DELETE from baseRule_mysql WHERE OwnerID = "'.$user_ID.'"';
		}
	}
	
	
	$stmt = $db_conn->prepare($sql_lang);				
	$stmt->execute();
	
	
	header("Location:../rent_list.php" );
 ?>