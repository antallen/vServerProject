<?php
	date_default_timezone_set("Asia/Taipei");

	require_once("../../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	
	$user_ID = $_POST['user_ID'];
	
	if(!empty($_POST['add_ftp'])){
		if ($_POST['add_ftp'] == "新增"){
			$ftp_num = $_POST['ftp_num'];
			$ftp_quota = $_POST['ftp_quota'];
			$ftp_start_date = $_POST['ftp_start_date'];
			$ftp_end_date = $_POST['ftp_end_date'];
			$ftp_quota_num = (int)$ftp_quota * 1024 * 1024;
			echo "hello";
			echo $user_ID;
			$sql_lang = 'INSERT INTO `baseRule_ftp` (OwnerID,ftp_num,total_bytes,order_date,expiration)
				VALUES ("'.$user_ID.'","'.$ftp_num.'","'.$ftp_quota_num.'","'.$ftp_start_date.'","'.$ftp_end_date.'")';
	
		}
	}
	if(!empty($_POST['update_ftp'])){
		if ($_POST['update_ftp'] == "更新"){
			$ftp_num = $_POST['ftp_num'];
			$ftp_quota = $_POST['ftp_quota'];
			$ftp_start_date = $_POST['ftp_start_date'];
			$ftp_end_date = $_POST['ftp_end_date'];
			$ftp_quota_num = (int)$ftp_quota * 1024 * 1024;
		
			echo "update";
			echo $user_ID;
			$sql_lang = 'UPDATE `baseRule_ftp` SET ftp_num = '.(int)$ftp_num.',total_bytes = '.$ftp_quota_num.',
			            order_date = "'.$ftp_start_date.'", expiration = "'.$ftp_end_date.'"
						WHERE OwnerID = "'.$user_ID.'"';
			
		}
	}
	if(!empty($_POST['delete_ftp'])){
		if ($_POST['delete_ftp'] == "刪除"){
			echo "delete";
			echo $user_ID;
			$sql_lang = 'DELETE from baseRule_ftp WHERE OwnerID = "'.$user_ID.'"';
		}
	}
	
	
	$stmt = $db_conn->prepare($sql_lang);				
	$stmt->execute();
	
	
	header("Location:../rent_list.php" );
 ?>