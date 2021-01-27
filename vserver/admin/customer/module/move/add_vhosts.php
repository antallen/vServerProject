<?php
	date_default_timezone_set("Asia/Taipei");

	require_once("../../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	
	$user_ID = $_POST['user_ID'];
	
	if(!empty($_POST['add_vhosts'])){
		if ($_POST['add_vhosts'] == "新增"){
			$vhost_num = $_POST['vhost_num'];
			$vhost_start_date = $_POST['vhost_start_date'];
			$vhost_end_date = $_POST['vhost_end_date'];
		
			echo "hello";
			echo $user_ID;
			$sql_lang = 'INSERT INTO `baseRule_vhosts` (OwnerID,vhosts_num,order_date,expiration)
				VALUES ("'.$user_ID.'","'.$vhost_num.'","'.$vhost_start_date.'","'.$vhost_end_date.'")';
	
		}
	}
	if(!empty($_POST['update_vhosts'])){
		if ($_POST['update_vhosts'] == "更新"){
			$vhost_num = $_POST['vhost_num'];
			$vhost_start_date = $_POST['vhost_start_date'];
			$vhost_end_date = $_POST['vhost_end_date'];
		
			echo "update";
			echo $user_ID;
			$sql_lang = 'UPDATE `baseRule_vhosts` SET vhosts_num = '.(int)$vhost_num.',
			            order_date = "'.$vhost_start_date.'", expiration = "'.$vhost_end_date.'"
						WHERE OwnerID = "'.$user_ID.'"';
			
		}
	}
	if(!empty($_POST['delete_vhosts'])){
		if ($_POST['delete_vhosts'] == "刪除"){
			echo "delete";
			echo $user_ID;
			$sql_lang = 'DELETE from baseRule_vhosts WHERE OwnerID = "'.$user_ID.'"';
		}
	}
	
	
	$stmt = $db_conn->prepare($sql_lang);				
	$stmt->execute();
	
	
	header("Location:../rent_list.php" );
 ?>