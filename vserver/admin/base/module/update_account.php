<?php
	date_default_timezone_set("Asia/Taipei");
	require_once("../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	$ad_id = $_POST['ad_id'];
	$loginname = $_POST["loginname"];
	$password = $_POST["password"];
	$pr1=explode("}",$password);
	$result=explode("{",$pr1[0]);
		
		if ($result[1] == "SHA"){
			echo "密碼已加密過了";
			$admin_sql = 'UPDATE `adminuser` SET loginname="'.$loginname.'" WHERE ad_id="'.$ad_id.'"';
		
		} else {
			$password_crypt = '{SHA}'.base64_encode(sha1($password,true));
			$admin_sql = 'UPDATE `adminuser` SET loginname="'.$loginname.'",password="'.$password_crypt.'" WHERE ad_id="'.$ad_id.'"';
		
		}
		
		echo $admin_sql;
		$stmt1 = $db_conn->prepare($admin_sql);
		$stmt1->execute();
		$db_conn = NULL;
		header("Location:../index.php" );
?>