<?php
	date_default_timezone_set("Asia/Taipei");

	require_once("../../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	
	$user_ID = $_POST['user_ID'];
	
	if(!empty($_POST['add_dns'])){
		if ($_POST['add_dns'] == "新增"){
			$dns_num = $_POST['dns_num'];
			$dns_sub_num = $_POST['dns_sub_num'];
			$dns_host_num = $_POST['dns_host_num'];
			$dns_start_date = $_POST['dns_start_date'];
			$dns_end_date = $_POST['dns_end_date'];
			$dns_ID = $user_ID . "DNS";
			echo "hello";
			echo $user_ID;
			$sql_lang = 'INSERT INTO `baseRule_dns` (OwnerID,dns_ID,domains_num,subdomains_num,hosts_num,createdate,expiration)
				VALUES ("'.$user_ID.'","'.$dns_ID.'",'.(int)$dns_num.','.(int)$dns_sub_num.','.(int)$dns_host_num.',"'.$dns_start_date.'","'.$dns_end_date.'")';
	
		}
	}
	if(!empty($_POST['update_dns'])){
		if ($_POST['update_dns'] == "更新"){
			$dns_num = $_POST['dns_num'];
			$dns_sub_num = $_POST['dns_sub_num'];
			$dns_host_num = $_POST['dns_host_num'];
			$dns_start_date = $_POST['dns_start_date'];
			$dns_end_date = $_POST['dns_end_date'];
			$dns_ID = $user_ID . "DNS";
		
			echo "update";
			echo $user_ID;
			$sql_lang = 'UPDATE `baseRule_dns` SET domains_num = '.(int)$dns_num.',dns_ID = "'.$dns_ID.'",
			            subdomains_num = '.(int)$dns_sub_num.', hosts_num = '.(int)$dns_host_num.',
						createdate = "'.$dns_start_date.'", expiration = "'.$dns_end_date.'"
						WHERE OwnerID = "'.$user_ID.'"';
			//echo $sql_lang;
		}
	}
	if(!empty($_POST['delete_dns'])){
		if ($_POST['delete_dns'] == "刪除"){
			echo "delete";
			echo $user_ID;
			$sql_lang = 'DELETE from baseRule_dns WHERE OwnerID = "'.$user_ID.'"';
		}
	}
	
	
	$stmt = $db_conn->prepare($sql_lang);				
	$stmt->execute();
	
	
	header("Location:../rent_list.php" );
 ?>