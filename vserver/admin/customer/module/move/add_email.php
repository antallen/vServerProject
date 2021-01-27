<?php
	date_default_timezone_set("Asia/Taipei");

	require_once("../../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	
	$user_ID = $_POST['user_ID'];
	
	if(!empty($_POST['add_email'])){
		if ($_POST['add_email'] == "新增"){
			$email_num = $_POST['email_num'];
			$email_quota = $_POST['email_quota'];
			$email_start_date = $_POST['email_start_date'];
			$email_end_date = $_POST['email_end_date'];
			$email_quota_num = (int)$email_quota * 1024 * 1024;
			echo "hello";
			echo $user_ID;
			$sql_lang = 'INSERT INTO `baseRule_email` (OwnerID,email_num,per_bytes,order_date,expiration)
				VALUES ("'.$user_ID.'","'.$email_num.'","'.$email_quota_num.'","'.$email_start_date.'","'.$email_end_date.'")';
	
		}
	}
	if(!empty($_POST['update_email'])){
		if ($_POST['update_email'] == "更新"){
			$email_num = $_POST['email_num'];
			$email_quota = $_POST['email_quota'];
			$email_start_date = $_POST['email_start_date'];
			$email_end_date = $_POST['email_end_date'];
			$email_quota_num = (int)$email_quota * 1024 * 1024;
		
			echo "update";
			echo $user_ID;
			$sql_lang = 'UPDATE `baseRule_email` SET email_num = '.(int)$email_num.',per_bytes = '.$email_quota_num.',
			            order_date = "'.$email_start_date.'", expiration = "'.$email_end_date.'"
						WHERE OwnerID = "'.$user_ID.'"';
			
		}
	}
	if(!empty($_POST['delete_email'])){
		if ($_POST['delete_email'] == "刪除"){
			echo "delete";
			echo $user_ID;
			$sql_lang = 'DELETE from baseRule_email WHERE OwnerID = "'.$user_ID.'"';
		}
	}
	
	
	$stmt = $db_conn->prepare($sql_lang);				
	$stmt->execute();
	
	
	header("Location:../rent_list.php" );
 ?>